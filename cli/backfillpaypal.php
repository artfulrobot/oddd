#!/usr/bin/php
<?php
exit;
use \ArtfulRobot\CsvParser;
if (php_sapi_name() !== 'cli') {
  // Fail with 404 if not called from CLI.
  if (isset($_SERVER['HTTP_PROTOCOL'])) {
    header("$_SERVER[HTTP_PROTOCOL] 404 Not Found");
  }
  exit;
}
// Note: options MUST be given before positional parameters.

function die_with_help($error=NULL) {
  global $argv;
  if ($error !== NULL) {
    fwrite(STDERR, "$error\n");
  }
  echo <<<TXT
Usage: php $argv[0] [-h]

TXT;
  exit(1);
}

$optind = null;
// getopt format:
//
// - single letter on its own is a boolean
// - follow with : for a required value
// - follow with :: for an optional value
//
// Test for an option with isset()
// @see http://php.net/getopt
$options = getopt('h');
$optind = 1 + count($options);
$pos_args = array_slice($argv, $optind);

/* Require 2 or 3 positional arguments.
if (count($pos_args) <2 || count($pos_args)>3) {
  die_with_help("Wrong arguments.");
}
 */
if (isset($options['h'])) {
  die_with_help();
}

// These things are typically needed.
$_SERVER["SCRIPT_FILENAME"] = __FILE__;
$_SERVER["REMOTE_ADDR"] = '127.0.0.1';
$_SERVER["SERVER_SOFTWARE"] = NULL;
$_SERVER["REQUEST_METHOD"] = 'GET';
$_SERVER["SCRIPT_NAME"] = __FILE__;

// Boostrap drupal
define('DRUPAL_ROOT', '/var/www/support.opendemocracy.net');
chdir(DRUPAL_ROOT); // This seems to be required.
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


// Bootstrap CiviCRM.
$GLOBALS['_CV'] = array ();
define("CIVICRM_SETTINGS_PATH", DRUPAL_ROOT . '/sites/default/civicrm.settings.php');
$error = @include_once CIVICRM_SETTINGS_PATH;
if ($error == FALSE) {
  throw new \Exception("Could not load the CiviCRM settings file: {$settings}");
}
require_once $GLOBALS["civicrm_root"] . "/CRM/Core/ClassLoader.php";
\CRM_Core_ClassLoader::singleton()->register();\CRM_Core_Config::singleton();\CRM_Utils_System::loadBootStrap(array(), FALSE);

if (!civicrm_initialize()) {
  die_with_help("Failed to initialise civi.");
  exit;
}


require_once dirname(__DIR__) . '/vendor/autoload.php';

echo "Ok, ready to start\n";
$csv = CsvParser::createFromFile('/home/rich/od-paypal-trans.csv');

/*

  Row types:
  1. One off button-driven entries:
     - Item ID: donate-button-\d+

  2. CiviCRM recurring payments.
     - Type: Subscription Payment
     - Subject: Online Contribution: .*

  3. Other recurring payments.

  4. CiviCRM stuff
     - Custom Number: {"module":"contribute"...}

 */
foreach ($csv as $row) {
  if (preg_match('/^{"module"/', $row->{'Custom Number'})) {
    $civi_details = json_decode($row->{'Custom Number'}, TRUE);
    if (!isset($civi_details['contributionID'])) {
      echo "No Contribution ID for row " . $row->key();
    }
    else {
      // OK we have a row that relates to a CiviCRM Contribution.
      //
      // Extract the key info from this.
      $paypal_info = [
        'total_amount'      => $row->Gross,
        'fee_amount'        => - $row->Fee,
        'net_amount'        => $row->Net,
        'original_currency' => $row->Currency,
        'date'              => "$row->Date $row->Time {$row->{'Time zone'}}",
        'from_email'        => $row->{'From Email Address'},
        'invoice_id'        => $row->{'Invoice Number'},
      ];
      echo 'Row: ' . $row->key() . ': ' . json_encode($paypal_info) . "\n";

      if ($row->Currency !== 'GBP') {
        $foreign_currency_calcs_failed = TRUE;
        // This Non GBP currency encountered.
        $csv->next();
        if ($row->{'Invoice Number'} == $paypal_info['invoice_id']
          && $row->Type === 'General Currency Conversion'
          && $row->Currency === $paypal_info['original_currency']
          && $row->Net == - $paypal_info['net_amount']
        ) {
          // Ok, this is as expected but we don't need data from this row, so
          // move to the next row...
          $csv->next();
          if ($row->{'Invoice Number'} == $paypal_info['invoice_id']
            && $row->Type === 'General Currency Conversion'
            && $row->Currency === 'GBP' ) {
            // OK, now we have the final GBP amount.
            $gbp_net = $row->Gross;
            // Now reconstruct the fee since that is taken in the foreign currency.
            $foreign_gross = $paypal_info['total_amount'];
            $foreign_fee = $paypal_info['fee_amount'];
            $foreign_net = $paypal_info['net_amount'];
            $exchange_rate = $gbp_net / $foreign_net;

            // Calc fee in GBP using same exchange rate:
            $paypal_info['fee_amount'] = round($foreign_fee * $exchange_rate, 2);
            // Calc original in GBP
            $paypal_info['total_amount'] = round($gbp_net + $paypal_info['fee_amount'], 2);
            $paypal_info['net_amount'] = $gbp_net;
            $foreign_currency_calcs_failed = FALSE;
            print "Deciphered currency stuff in row " . $row->key() . "\n" . json_encode($paypal_info, JSON_PRETTY_PRINT) . "\n";
          }
        }
        if ($foreign_currency_calcs_failed) {
          print "FAILED to decipher the foriegn currency details in " . json_encode($paypal_info) . "\n";
          continue;
        }
      }

      $contrib = civicrm_api3('Contribution', 'get', ['id' => $civi_details['contributionID'], 'sequential' => 1]);
      if ($contrib['count'] == 1) {
        $contrib_record = $contrib['values'][0];
        if ($contrib_record['contribution_status'] == 'Pending') {
          print "Row " . $row->getRowNumber() . " found incomplete contrib: $civi_details[contributionID] Total:"
            . json_encode([
              'total_amount'      => $contrib_record['total_amount'],
              'fee_amount'        => $contrib_record['fee_amount'],
              'net_amount'        => $contrib_record['net_amount'],
              'contribution_note' => $contrib_record['contribution_note'] ?? '(None)',
            ])
            ." \n";
          print "\n\n";
          // Correct record.
          $params = [
            'id'                     => $civi_details['contributionID'],
            'total_amount'           => $paypal_info['total_amount'],
            'fee_amount'             => $paypal_info['fee_amount'],
            'net_amount'             => $paypal_info['net_amount'],
            'contribution_status_id' => 'Completed',
            'receive_date'           => $paypal_info['date'],
            'is_email_receipt'       => 0, // Do not send email receipts.
          ];
          print "Contribution Update (contact " . $contrib['values'][0]['contact_id'] . "): " . json_encode($params) . "\n";
          civicrm_api3('Contribution', 'create', $params);
          print "\n";
        }
        else {
          print "Row " . $row->getRowNumber() . " found complete contrib: $civi_details[contributionID] \n";
          //print json_encode($contrib['values'][0], JSON_PRETTY_PRINT);
        }
      }
      else {
        print "Contribution not found for " . json_encode($civi_details) . " from row " . $row->key() . "\n";
      }
    }
    //print json_encode($row->getRowAsArray(), JSON_PRETTY_PRINT);
  }
}
