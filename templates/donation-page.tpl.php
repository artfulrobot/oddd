<div class="odd-node-wrapper <?php print empty($field_test_mode[0]['value']) ? : 'test-mode';?>" style="<?php print $background;?>">
  <div class="odd-node" id="odd-id-<?php print $nid;?>" data-config="<?php print ($odd_config) ;?>">
    <noscript>This page needs Javascript</noscript>
    <?php if ($thanks):?>
      <h2>Thank you</h2>
      <div style="margin-top: 2rem;"><?php print $thanks_text; ?></div>
      <div class="odd-social-wrapper">

        <?php if (!empty($node->field_facebook['und'][0]['value'])):?>
          <div class="odd-social-company" >
            <a href="javascript: void(0)"
              onClick="window.open('https://www.facebook.com/sharer.php?u=<?php print urlencode($share_url) ?>','sharer','toolbar=0,status=0,width=548,height=325');" >
              <svg role="img" class="icon icon-facebook" viewBox="16 15 19 19" width="20px" height="20px">
                <title>Share on Facebook</title>
                <use xlink:href="#icon-facebook" class="icon-style"></use>
              </svg>
            </a>
          </div>
        <?php endif;?>

        <?php if (!empty($node->field_twitter_tweet_text['und'][0]['value'])):?>
          <div class="odd-social-company" >
          <a href="https://twitter.com/intent/tweet?text=<?php print urlencode($node->field_twitter_tweet_text['und'][0]['value']) ?>&url=<?php print urlencode($share_url); ?>"
              target="_blank" >
              <svg role="img" class="icon icon-twitter" viewBox="16 15 19 19" width="20px" height="20px">
                <title>Share on Twitter</title>
                <use xlink:href="#icon-twitter" class="icon-style"></use>
              </svg>
            </a>
          </div>
        <?php endif;?>

      </div>


      <p style="margin-top: 2rem;"><a href="<?php print htmlspecialchars($return_url) ?>">Return to <?php print str_replace('https://', '', htmlspecialchars($return_url));?></a></p>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var data = <?php print $json_encoded_analytics_data; ?>;
          if ((navigator.doNotTrack || false) != 1) {
            console.log("tracking donation with Google Analytics.", data);
            gtag('event', 'purchase', {
              value: data.amount,
              transaction_id: data.id,
              currency: data.currency,
              affiliation: data.affiliation
            });
          }
          else {
            console.log("openDemocracy respects your browser's Do Not Track setting, so will not track this donation in Google Analytics.");
          }
        });
      </script>
    <?php endif; /* ----------------end of thank you----------------------*/ ?>
  </div>
  <?php if (!$thanks):?>
  <script><?php print file_get_contents(__DIR__ . '/oddd/dist/oddd.js');?></script>
  <?php endif;?>
  <style><?php print file_get_contents(__DIR__ . '/oddd/dist/oddd.css');?></style>
</div>
<svg width="0" height="0" display="none">
    <defs>
        <g id="icon-audio" viewBox="0 0 50 50">
            <title>Audio available</title>
            <path d="M29.04,17.898c-0.6,0-1.105,0.505-1.105,1.105v11.994c0,0.6,0.505,1.105,1.105,1.105s1.105-0.505,1.105-1.105V19.003
                C30.145,18.403,29.671,17.898,29.04,17.898z"></path>
            <path d="M25,16.32c-0.6,0-1.105,0.505-1.105,1.105v15.15c0,0.6,0.505,1.105,1.105,1.105s1.105-0.505,1.105-1.105v-15.15
                C26.105,16.825,25.6,16.32,25,16.32z"></path>
            <path d="M20.96,20.108c-0.6,0-1.105,0.505-1.105,1.105v7.575c0,0.6,0.505,1.105,1.105,1.105c0.6,0,1.105-0.505,1.105-1.105v-7.575
                C22.065,20.613,21.56,20.108,20.96,20.108z"></path>
            <path d="M16.888,21.686c-0.6,0-1.105,0.505-1.105,1.105v4.419c0,0.6,0.505,1.105,1.105,1.105c0.6,0,1.105-0.505,1.105-1.105v-4.419
                C17.993,22.191,17.52,21.686,16.888,21.686z"></path>
            <path d="M33.112,21.686c-0.6,0-1.105,0.505-1.105,1.105v4.419c0,0.6,0.505,1.105,1.105,1.105c0.6,0,1.105-0.505,1.105-1.105v-4.419
                C34.216,22.191,33.711,21.686,33.112,21.686z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-bookmark" viewBox="0 0 50 50">
            <title>Bookmark</title>
            <style type="text/css">
                .st0{fill-rule:evenodd;clip-rule:evenodd;fill:none;stroke:#1A1A1A;stroke-linejoin:round;stroke-miterlimit:10;}
            </style>
            <polygon class="st0" points="18.5,15.5 31.5,15.5 31.5,34.5 24.5,27.5 18.5,34.5 "></polygon>
        </g>
    </defs>
    <defs>
        <g id="icon-check-mark" viewBox="0 0 50 50">
            <title>Check</title>
            <path d="M23.1,32.7c-0.1,0-0.3-0.1-0.4-0.2L17.5,27c-0.2-0.2-0.2-0.5,0-0.7s0.5-0.2,0.7,0l4.7,5.1l8.7-13.9c0.1-0.2,0.5-0.3,0.7-0.2
                s0.3,0.5,0.2,0.7l-9,14.4C23.4,32.6,23.3,32.7,23.1,32.7z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-globe" viewBox="0 0 50 50">
            <title>Language</title>
            <path d="M25.001,36.956c3.692-0.001,7.176-1.709,9.437-4.628c0.006-0.007,0.015-0.01,0.021-0.017
                c1.242-1.596,2.054-3.483,2.359-5.482c0.002-0.012,0.003-0.024,0.005-0.035c0.025-0.169,0.047-0.34,0.065-0.511
                c0.004-0.041,0.009-0.083,0.013-0.125c0.014-0.147,0.025-0.295,0.034-0.444c0.003-0.048,0.007-0.096,0.009-0.145
                c0.009-0.19,0.014-0.38,0.014-0.571c0-0.223-0.007-0.444-0.019-0.664c-0.005-0.09-0.014-0.179-0.021-0.269
                c-0.01-0.126-0.02-0.253-0.033-0.378c-0.012-0.112-0.027-0.223-0.043-0.334c-0.014-0.1-0.028-0.2-0.044-0.299
                c-0.02-0.122-0.042-0.243-0.065-0.363c-0.017-0.087-0.036-0.173-0.055-0.259c-0.028-0.125-0.055-0.251-0.087-0.375
                c-0.021-0.082-0.044-0.162-0.067-0.243c-0.049-0.178-0.102-0.355-0.16-0.531c-0.044-0.136-0.089-0.272-0.138-0.405
                c-0.031-0.085-0.067-0.169-0.1-0.254c-0.048-0.122-0.097-0.245-0.149-0.365c-0.035-0.081-0.072-0.161-0.109-0.241
                c-0.056-0.122-0.114-0.243-0.174-0.363c-0.022-0.045-0.042-0.09-0.065-0.135c-0.004-0.008-0.01-0.013-0.015-0.02
                c-0.552-1.061-1.259-2.034-2.098-2.886c-0.009-0.014-0.019-0.027-0.03-0.04c-0.065-0.065-0.135-0.124-0.202-0.187
                c-0.112-0.108-0.225-0.214-0.342-0.318c-0.096-0.085-0.192-0.169-0.29-0.251c-0.172-0.144-0.348-0.283-0.528-0.417
                c-0.084-0.063-0.171-0.122-0.257-0.183c-0.166-0.117-0.334-0.229-0.506-0.338c-0.057-0.036-0.112-0.073-0.169-0.108
                c-0.227-0.138-0.461-0.266-0.698-0.389c-0.034-0.018-0.066-0.039-0.101-0.056c-0.005-0.003-0.011-0.002-0.016-0.004
                c-0.802-0.406-1.648-0.72-2.521-0.935c-0.002-0.001-0.004-0.002-0.006-0.003c-0.027-0.007-0.055-0.011-0.083-0.018
                c-0.184-0.044-0.37-0.083-0.557-0.119c-0.048-0.009-0.097-0.018-0.146-0.026c-0.177-0.031-0.354-0.058-0.533-0.081
                c-0.054-0.007-0.108-0.014-0.162-0.021c-0.176-0.02-0.352-0.036-0.53-0.048c-0.053-0.004-0.106-0.009-0.16-0.012
                c-0.225-0.013-0.451-0.021-0.679-0.021c-0.037,0-0.073,0.001-0.11,0.003l-0.071,0.002l0,0c-0.668,0.01-1.334,0.076-1.991,0.197
                c-0.002,0-0.003,0-0.005,0c-0.011,0.002-0.021,0.005-0.032,0.007c-0.175,0.033-0.348,0.069-0.519,0.11
                c-0.026,0.006-0.053,0.012-0.08,0.018c-0.176,0.043-0.351,0.089-0.524,0.14c-0.019,0.006-0.039,0.011-0.058,0.017
                c-0.184,0.054-0.366,0.113-0.546,0.176c-0.008,0.003-0.016,0.005-0.025,0.008c-1.337,0.471-2.579,1.176-3.669,2.081
                c-0.042,0.035-0.083,0.072-0.125,0.108c-0.105,0.09-0.21,0.179-0.311,0.272c-0.074,0.067-0.145,0.138-0.217,0.207
                c-0.067,0.064-0.134,0.127-0.199,0.193c-0.085,0.085-0.166,0.173-0.249,0.261c-0.05,0.053-0.101,0.106-0.15,0.161
                c-0.086,0.096-0.17,0.194-0.253,0.293c-0.042,0.05-0.085,0.099-0.126,0.15c-0.083,0.102-0.164,0.206-0.244,0.31
                c-0.039,0.051-0.079,0.103-0.117,0.155c-0.077,0.104-0.152,0.21-0.226,0.317c-0.04,0.057-0.079,0.115-0.117,0.173
                c-0.035,0.052-0.072,0.103-0.106,0.156c-0.004,0.007-0.005,0.015-0.008,0.022c-3.551,5.561-1.921,12.948,3.64,16.499
                C20.485,36.307,22.719,36.958,25.001,36.956z M33.353,31.819c-0.302-0.101-0.547-0.324-0.676-0.614
                c-0.062-0.104-0.088-0.225-0.073-0.345c0.187-0.374,0.202-1.337,0.202-2.463c0-0.389,0.398-0.695,0.859-1.051
                c0.263-0.192,0.511-0.405,0.742-0.636c0.163-0.136,0.236-0.352,0.187-0.559c-0.097-0.315-0.479-0.398-0.883-0.485
                c-0.193-0.031-0.382-0.088-0.561-0.168c0.064-0.37-0.037-0.749-0.276-1.039c-0.291-0.324-0.714-0.497-1.149-0.471
                c-0.399,0-0.819-0.148-0.91-1.242c-0.015-0.385-0.264-0.723-0.627-0.852c-0.267-0.096-0.463-0.327-0.514-0.606
                c-0.153-0.576,0.207-0.786,1.065-1.127c0.118-0.047,0.236-0.094,0.348-0.142c0.362-0.157,1.394-0.17,2.759-0.036h0
                c0.387,0.039,0.777,0.039,1.164,0.002l0.185-0.018c0.009,0.018,0.018,0.035,0.027,0.053c0.067,0.137,0.13,0.276,0.191,0.415
                c0.028,0.064,0.057,0.128,0.084,0.193c0.067,0.16,0.131,0.322,0.19,0.484c0.04,0.109,0.076,0.22,0.112,0.33
                c0.025,0.076,0.051,0.152,0.075,0.228c0.037,0.12,0.07,0.241,0.103,0.362c0.019,0.069,0.038,0.139,0.055,0.208
                c0.031,0.123,0.059,0.246,0.086,0.371c0.016,0.072,0.03,0.145,0.044,0.218c0.023,0.121,0.046,0.242,0.065,0.364
                c0.013,0.084,0.025,0.168,0.036,0.252c0.015,0.112,0.031,0.224,0.043,0.337c0.012,0.11,0.02,0.221,0.028,0.332
                c0.007,0.09,0.016,0.179,0.021,0.269c0.011,0.205,0.017,0.41,0.017,0.617c0,0.181-0.005,0.361-0.014,0.54
                c-0.002,0.046-0.006,0.091-0.008,0.137c-0.008,0.142-0.019,0.283-0.032,0.424c-0.004,0.038-0.007,0.076-0.011,0.114
                c-0.018,0.172-0.039,0.344-0.066,0.514l0,0.001c-0.286,1.859-1.031,3.618-2.168,5.117C33.834,31.867,33.592,31.858,33.353,31.819z
                    M32.141,17.001c-0.196,0.333-0.545,0.547-0.93,0.572c-0.321,0.007-0.641,0.042-0.956,0.104c-0.27,0.061-0.548,0.084-0.824,0.07
                c-0.396-0.077-0.737-0.325-0.934-0.677c-0.032-0.08-0.026-0.372,0.717-1.364c0.294-0.328,0.649-0.595,1.046-0.785
                c0.026,0.013,0.052,0.026,0.077,0.04c0.163,0.087,0.324,0.178,0.482,0.272c0.099,0.059,0.197,0.122,0.295,0.184
                c0.101,0.064,0.201,0.129,0.3,0.196c0.104,0.071,0.206,0.144,0.307,0.218c0.063,0.046,0.124,0.093,0.186,0.14
                c0.276,0.211,0.541,0.434,0.796,0.669C32.306,16.77,32.193,16.87,32.141,17.001z M26.043,15.415
                c-0.09,0.096-0.219,0.147-0.351,0.137c-0.298-0.102-0.545-0.315-0.689-0.595c-0.085-0.128-0.117-0.55,0.053-1.329
                c0.085,0,0.169,0.004,0.253,0.006c0.103,0.003,0.206,0.004,0.31,0.01c0.061,0.003,0.121,0.01,0.182,0.014
                c0.138,0.01,0.275,0.019,0.413,0.034c0.03,0.003,0.06,0.008,0.09,0.011c0.165,0.019,0.331,0.04,0.495,0.067
                c0.02,0.003,0.04,0.007,0.06,0.011c0.171,0.028,0.341,0.06,0.51,0.095c0.006,0.001,0.011,0.003,0.017,0.004
                C27.009,14.45,26.557,14.966,26.043,15.415z M22.889,16.3c0.506,0.614,0.803,1.364,0.637,1.604
                c-0.215,0.375-0.599,0.622-1.029,0.664c-0.222-0.031-0.437-0.101-0.634-0.208c-0.349-0.158-0.744-0.337-0.975-0.013
                c-0.102,0.19-0.154,0.403-0.152,0.619c-0.026,0.265-0.065,0.664-0.218,0.715c-0.282,0.022-0.567,0.007-0.845-0.047
                c-0.768-0.098-1.64-0.21-1.814,0.417c-0.187,0.672,0.371,1.207,0.639,1.464c0.035,0.031,0.069,0.065,0.1,0.1
                c0.057,0.071,0.595,0.693,2.012,0.693c0.308,0,0.567-0.021,0.776-0.038c0.576-0.046,0.722-0.046,0.943,0.26
                c0.139,0.266,0.207,0.564,0.196,0.864c0.028,0.425,0.065,1.008,0.624,1.073c0.36-0.003,0.714-0.088,1.036-0.25
                c0.442-0.175,0.944-0.372,1.279-0.22c0.683,0.31,1.375,1.001,1.276,1.496c-0.024,0.118-0.042,0.24-0.06,0.365
                c-0.096,0.665-0.189,1.084-0.845,1.303c-1.154,0.385-1.425,0.975-1.502,1.864c-0.085,0.654-0.506,1.215-1.11,1.48
                c-0.788,0.394-0.851,0.947-0.924,1.587l-0.013,0.115c-0.029,0.278-0.01,0.558,0.056,0.83c0.05,0.239,0.055,0.304-0.006,0.391
                c-0.087,0.04-0.186,0.045-0.276,0.012c-0.252-0.041-0.462-0.217-0.546-0.458c-0.032-0.367-0.039-0.735-0.022-1.102
                c0.015-1.022,0.01-1.719-0.179-2.075c-0.127-0.327-0.219-0.667-0.276-1.014c-0.09-0.581-0.265-1.146-0.52-1.675
                c-0.255-0.343-0.577-0.63-0.948-0.842c-0.441-0.3-0.897-0.61-0.897-0.963c0-0.882,0-2.214-1.18-3.001
                c-1.022-0.681-2.079-1.386-2.079-2.934c0.002-0.182,0.016-0.363,0.043-0.543c0.028-0.043,0.054-0.086,0.082-0.128
                c0.033-0.049,0.067-0.098,0.1-0.147c0.072-0.104,0.145-0.208,0.22-0.309c0.033-0.045,0.067-0.088,0.101-0.133
                c0.077-0.101,0.156-0.202,0.236-0.301c0.037-0.045,0.075-0.089,0.112-0.134c0.079-0.094,0.159-0.187,0.241-0.278
                c0.045-0.05,0.092-0.099,0.138-0.149c0.076-0.082,0.153-0.163,0.231-0.243c0.058-0.059,0.118-0.116,0.178-0.174
                c0.069-0.066,0.137-0.133,0.208-0.198c0.076-0.07,0.154-0.138,0.231-0.205c0.057-0.049,0.113-0.099,0.171-0.148
                c0.097-0.081,0.196-0.159,0.295-0.237c0.041-0.032,0.082-0.065,0.123-0.097c0.119-0.091,0.24-0.179,0.363-0.264
                c0.024-0.017,0.048-0.034,0.072-0.051c0.141-0.097,0.283-0.191,0.428-0.281c0.008-0.005,0.016-0.01,0.023-0.015
                c0.941-0.585,1.962-1.03,3.031-1.319l0.006-0.002c0.174-0.047,0.35-0.09,0.527-0.128l0.014-0.003
                c-0.008,0.07-0.02,0.146-0.037,0.228C22.528,14.269,22.342,15.635,22.889,16.3z M14.863,19.855
                c0.203,1.532,1.359,2.307,2.325,2.952c0.899,0.599,0.899,1.654,0.899,2.502c0,0.662,0.613,1.079,1.153,1.446
                c0.297,0.17,0.56,0.394,0.776,0.66c0.219,0.475,0.37,0.979,0.45,1.496c0.063,0.401,0.175,0.793,0.332,1.167
                c0.133,0.249,0.12,1.178,0.11,1.792c-0.019,0.403-0.009,0.806,0.03,1.207c0.164,0.564,0.678,0.955,1.266,0.963
                c0.238,0.014,0.467-0.091,0.611-0.28c0.158-0.251,0.194-0.561,0.098-0.842c-0.053-0.21-0.069-0.428-0.048-0.644l0.013-0.117
                c0.069-0.603,0.1-0.879,0.605-1.131c0.793-0.346,1.339-1.091,1.43-1.951c0.063-0.721,0.23-1.07,1.106-1.362v0
                c1.031-0.343,1.15-1.169,1.237-1.772c0.017-0.114,0.032-0.226,0.054-0.334c0.168-0.84-0.702-1.73-1.606-2.141
                c-0.56-0.255-1.185-0.009-1.735,0.208c-0.241,0.122-0.504,0.193-0.774,0.209c-0.064-0.168-0.094-0.347-0.089-0.527
                c0.009-0.41-0.096-0.815-0.305-1.168c-0.422-0.584-0.882-0.548-1.464-0.5c-0.208,0.017-0.445,0.036-0.728,0.036
                c-1.145,0-1.553-0.469-1.557-0.474c-0.047-0.055-0.098-0.107-0.152-0.156c-0.278-0.267-0.567-0.577-0.48-0.89
                c0.099-0.13,0.855-0.034,1.178,0.007c0.363,0.079,0.737,0.086,1.103,0.022c0.513-0.171,0.571-0.773,0.614-1.212
                c0.007-0.076,0.017-0.176,0.028-0.249c0.083,0.029,0.195,0.08,0.279,0.118c0.271,0.146,0.568,0.235,0.875,0.26
                c0.624-0.034,1.19-0.377,1.509-0.915c0.445-0.642-0.21-1.753-0.666-2.307c-0.324-0.393-0.259-1.404-0.214-1.712
                c0.03-0.146,0.047-0.293,0.05-0.442c0.425-0.069,0.853-0.114,1.283-0.135c-0.158,0.791-0.139,1.342,0.06,1.64
                c0.342,0.513,0.711,0.799,1.098,0.85c0.039,0.005,0.078,0.008,0.118,0.008c0.259-0.005,0.507-0.107,0.695-0.286h0
                c0.423-0.374,1.253-1.229,1.539-1.831c0.568,0.154,1.123,0.352,1.659,0.592c-0.336,0.192-0.634,0.444-0.88,0.742
                c-0.613,0.817-0.982,1.458-0.793,1.93c0.276,0.548,0.795,0.933,1.399,1.038c0.079,0.01,0.158,0.015,0.237,0.015
                c0.256-0.008,0.511-0.038,0.762-0.088c0.283-0.056,0.57-0.088,0.858-0.096c0.597-0.023,1.141-0.351,1.439-0.87
                c0.171-0.075,0.348-0.134,0.53-0.177c0.667,0.691,1.244,1.463,1.718,2.298c-0.331,0.029-0.664,0.028-0.994-0.004
                c-1.064-0.105-2.457-0.177-3.049,0.081c-0.107,0.046-0.218,0.091-0.331,0.135c-0.724,0.288-1.717,0.683-1.413,1.82
                c0.093,0.442,0.399,0.808,0.817,0.977c0.214,0.107,0.287,0.143,0.306,0.378c0.098,1.179,0.6,1.777,1.491,1.777
                c0.262-0.02,0.52,0.077,0.703,0.265c0.133,0.168,0.185,0.386,0.141,0.596c-0.094,0.563,0.575,0.708,1.017,0.804
                c0.109,0.024,0.269,0.058,0.377,0.094c-0.205,0.2-0.424,0.385-0.655,0.554c-0.534,0.411-1.086,0.837-1.086,1.512
                c0,0.623,0,1.921-0.141,2.202c-0.106,0.274-0.085,0.581,0.059,0.837c0.201,0.457,0.591,0.803,1.068,0.948
                c0.128,0.029,0.259,0.044,0.39,0.047c-4.1,4.753-11.276,5.283-16.03,1.184C13.609,30.198,12.491,24.518,14.863,19.855
                L14.863,19.855z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-close" viewBox="0 0 50 50">
            <title>Close</title>
            <g>
                <path d="M25.7,25l6.3-6.3c0.2-0.2,0.2-0.5,0-0.7s-0.5-0.2-0.7,0L25,24.3L18.7,18c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7l6.3,6.3
                    L18,31.3c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l6.3-6.3l6.3,6.3c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1
                    c0.2-0.2,0.2-0.5,0-0.7L25.7,25z"></path>
            </g>
        </g>
    </defs>
    <defs>
        <g id="icon-comments" viewBox="0 0 50 50">
            <title>Comments</title>
            <style type="text/css">
                .st0{fill-rule:evenodd;clip-rule:evenodd;fill:none;stroke:#1A1A1A;stroke-miterlimit:10;}
            </style>
            <polygon class="st0" points="16,30 27.714,30 32,33 32,30 34,30 34,17 16,17 "></polygon>
        </g>
    </defs>
    <defs>
        <g id="icon-download" viewBox="0 0 50 50">
            <title>Download</title>
            <style type="text/css">
                .st0{fill:none;stroke:#1A1A1A;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
            </style>
            <polyline class="st0" points="17,28.25 17,34.25 33,34.25 33,28.25 "></polyline>
            <line class="st0" x1="25" y1="15.75" x2="25" y2="29.75"></line>
            <polyline class="st0" points="19,24.75 25,29.75 31,24.75 "></polyline>
        </g>
    </defs>
    <defs>
        <g id="icon-facebook" viewBox="0 0 50 50">
            <title>Facebook</title>
            <path d="M29.1,26.6V34H34c0.6,0,1-0.5,1-1V16c0-0.6-0.5-1-1-1H17c-0.6,0-1,0.5-1,1V33c0,0.6,0.5,1,1,1h9.1v-7.4h-2.5v-2.9h2.5v-2.1
    c0-2.5,1.5-3.8,3.7-3.8c1,0,2,0.1,2.2,0.1v2.6l-1.5,0c-1.2,0-1.4,0.6-1.4,1.4v1.8h2.8l-0.4,2.9L29.1,26.6L29.1,26.6z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-link" viewBox="0 0 50 50">
            <title>Link</title>
            <path d="M26.5,27.8c-0.9,0-1.8-0.3-2.4-1l-0.9-0.9c-0.1-0.1-0.2-0.2-0.3-0.4c-0.2-0.2-0.1-0.5,0.1-0.7s0.5-0.1,0.7,0.1
                c0.1,0.1,0.1,0.2,0.2,0.3l0.9,0.9c0.9,0.9,2.5,0.9,3.4,0l3.8-3.8c0.9-0.9,0.9-2.5,0-3.4L31.1,18c-0.9-0.9-2.5-0.9-3.4,0l-2.7,2.7
                c-0.2,0.2-0.5,0.2-0.7,0s-0.2-0.5,0-0.7l2.7-2.7c1.3-1.3,3.5-1.3,4.9,0l0.9,0.9c0.6,0.6,1,1.5,1,2.4c0,0.9-0.4,1.8-1,2.4l-3.8,3.8
                C28.3,27.5,27.4,27.8,26.5,27.8z"></path>
            <path d="M20.6,33.7c-0.9,0-1.8-0.3-2.4-1l-0.9-0.9c-1.3-1.3-1.3-3.5,0-4.9l3.8-3.8c1.3-1.3,3.5-1.3,4.9,0l0.9,0.9
                c0.1,0.1,0.2,0.2,0.3,0.4c0.2,0.2,0.1,0.5-0.1,0.7c-0.2,0.2-0.5,0.1-0.7-0.1c-0.1-0.1-0.1-0.2-0.2-0.3l-0.9-0.9
                c-0.9-0.9-2.5-0.9-3.4,0L18,27.6c-0.9,0.9-0.9,2.5,0,3.4l0.9,0.9c0.9,0.9,2.5,0.9,3.4,0l2.7-2.7c0.2-0.2,0.5-0.2,0.7,0
                s0.2,0.5,0,0.7l-2.7,2.7C22.4,33.4,21.5,33.7,20.6,33.7z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-email" viewBox="0 0 50 50">
            <title>Email</title>
            <polygon points="25,25.9 33.5,19.9 33.5,19.5 16.5,19.5 16.5,19.9 "></polygon>
            <polygon points="25,27.1 16.5,21.1 16.5,30.5 33.5,30.5 33.5,21.1 "></polygon>
        </g>
    </defs>
    <defs>
        <g id="icon-newsletter" viewBox="0 0 50 50">
            <title>Newsletter</title>
            <g>
                <path id="SVGID_1_" d="M28.8,20h-7c-0.1,0-0.2-0.1-0.2-0.2s0.1-0.2,0.2-0.2h7c0.1,0,0.2,0.1,0.2,0.2S28.9,20,28.8,20z M28.8,22h-7
                        c-0.1,0-0.2-0.1-0.2-0.2s0.1-0.2,0.2-0.2h7c0.1,0,0.2,0.1,0.2,0.2S28.9,22,28.8,22z M28.8,23.9h-7c-0.1,0-0.2-0.1-0.2-0.2
                        s0.1-0.2,0.2-0.2h7c0.1,0,0.2,0.1,0.2,0.2S28.9,23.9,28.8,23.9z M17.3,22.7l2,1.2V22L17.3,22.7z M30.8,22v2l2-1.2L30.8,22z
                            M19.8,24.3l5.3,3.3l5.3-3.3l0,0V18H19.8v3.8l0,0V24.3L19.8,24.3z M33.3,32.5H16.7c-0.1,0-0.2-0.1-0.2-0.2v-9.6l0,0v-0.1
                        c0,0,0,0,0.1-0.1l0,0l2.6-0.9v-3.8c0-0.1,0.1-0.2,0.2-0.2h11c0.1,0,0.2,0.1,0.2,0.2v3.8l2.5,0.9c0.1,0,0.2,0.1,0.2,0.2l0,0l0,0
                        v9.6C33.5,32.4,33.4,32.5,33.3,32.5z"></path>
            </g>
        </g>
    </defs>
    <defs>
        <g id="icon-newsletter-submit" viewBox="0 0 50 50">
            <title>Newsletter</title>
            <style type="text/css">
                .st0{fill:#1A1A1A;}
            </style>
            <path class="st0" d="M36.1,24.9c0-0.2-0.1-0.4-0.3-0.5l-9.2-8.6c-0.2-0.2-0.5-0.2-0.7,0c-0.2,0.2-0.2,0.5,0,0.7l8.4,7.8H14.4
                c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h19.9l-8.5,8.1c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.2,0.4,0.2c0.1,0,0.2,0,0.3-0.1
                l9.3-8.9C36,25.2,36.1,25.1,36.1,24.9C36.1,24.9,36.1,24.9,36.1,24.9C36.1,24.9,36.1,24.9,36.1,24.9z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-play" viewBox="0 0 50 50">
            <title>Play</title>
            <polygon points="20,17 20,34 32,25.5 "></polygon>
        </g>
    </defs>
    <defs>
        <g id="icon-print" viewBox="0 0 50 50">
            <title>Print</title>
            <path d="M19.684,32.379c-1.138,0-2.063-0.92-2.063-2.051V18.05c0-0.236,0.192-0.428,0.428-0.428h9.791
    c0.236,0,0.428,0.192,0.428,0.428v4.881h3.685c0.236,0,0.428,0.192,0.428,0.428v6.969c0,1.131-0.925,2.051-2.062,2.051H19.684z
     M28.267,30.174c0.012,0.747,0.622,1.342,1.361,1.342h0.031l0.078,0.015l0.579-0.008c0.665,0,1.206-0.536,1.206-1.194v-6.541h-3.256
    V30.174z M18.477,30.328c0,0.658,0.541,1.194,1.207,1.194h8.196c-0.301-0.383-0.47-0.859-0.47-1.356l0.001-11.688h-8.934V30.328z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-share" viewBox="0 0 50 50">
            <title>Share</title>
            <defs>
                <path id="SVGID_1_" d="M31.5,14.2c1.3,0,2.3,1,2.3,2.3s-1,2.3-2.3,2.3s-2.3-1-2.3-2.3S30.2,14.2,31.5,14.2z M18.5,27.5
                        c-1.3,0-2.3-1-2.3-2.3c0-1.3,1-2.3,2.3-2.3s2.3,1,2.3,2.3C20.8,26.5,19.8,27.5,18.5,27.5z M31.5,31.1c1.3,0,2.3,1,2.3,2.3
                        s-1,2.3-2.3,2.3s-2.3-1-2.3-2.3S30.2,31.1,31.5,31.1z M31.5,20.6c2.2,0,4-1.8,4-4.1s-1.8-4.1-4-4.1c-2.2,0-4,1.8-4,4.1
                        c0,0.6,0.1,1.2,0.3,1.7l-6.3,4.2c-0.8-0.8-1.8-1.3-2.9-1.3c-2.2,0-4,1.8-4,4.1c0,2.2,1.8,4.1,4,4.1c1.2,0,2.2-0.5,2.9-1.3
                        l6.1,4.1c-0.1,0.4-0.2,0.9-0.2,1.3c0,2.2,1.8,4.1,4,4.1c2.2,0,4-1.8,4-4.1s-1.8-4.1-4-4.1c-1.2,0-2.2,0.5-2.9,1.2l-6.1-4.2
                        c0.1-0.4,0.2-0.8,0.2-1.3c0-0.4-0.1-0.9-0.2-1.3l6.4-4.3C29.5,20.2,30.4,20.6,31.5,20.6z"></path>
                </defs>
                <use xlink:href="#SVGID_1_" style="overflow:visible;"></use>
                <clipPath id="SVGID_2_">
                <use xlink:href="#SVGID_1_" style="overflow:visible;"></use>
            </clipPath>
        </g>
    </defs>
    <defs>
        <g id="icon-twitter" viewBox="0 0 50 50">
            <title>Twitter</title>
            <path d="M15,31.2c1.7,1.1,3.8,1.8,6,1.8c7.2,0,11.1-6.2,11.1-11.5c0-0.2,0-0.3,0-0.5c0.8-0.6,1.4-1.3,1.9-2.1
            c-0.7,0.3-1.5,0.5-2.2,0.6c0.8-0.5,1.4-1.3,1.7-2.2c-0.8,0.5-1.6,0.8-2.5,1c-0.7-0.8-1.7-1.3-2.8-1.3c-2.2,0-3.9,1.8-3.9,4
            c0,0.3,0,0.6,0.1,0.9c-3.2-0.2-6.1-1.8-8-4.2c-0.3,0.6-0.5,1.3-0.5,2c0,1.4,0.7,2.6,1.7,3.4c-0.6,0-1.2-0.2-1.8-0.5c0,0,0,0,0,0.1
            c0,2,1.3,3.6,3.1,4c-0.3,0.1-0.7,0.1-1,0.1c-0.3,0-0.5,0-0.7-0.1c0.5,1.6,1.9,2.8,3.6,2.8c-1.3,1.1-3,1.7-4.8,1.7
            C15.6,31.2,15.3,31.2,15,31.2z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-youtube" viewBox="0 0 50 50">
            <title>Youtube</title>
            <path d="M33.7,17.5H16.3c-2.1,0-3.8,1.7-3.8,3.8v9.4c0,2.1,1.7,3.8,3.8,3.8h17.4c2.1,0,3.8-1.7,3.8-3.8v-9.4
    C37.5,19.2,35.8,17.5,33.7,17.5z M22,30v-8l8,4L22,30z"></path>
        </g>
    </defs>
    <defs>
        <g id="icon-search" viewBox="0 0 50 50">
            <title>Search</title>
            <g>
                <path d="M22.9,15.1c4,0,7.3,3.3,7.3,7.4c0,4.1-3.2,7.4-7.3,7.4s-7.3-3.3-7.3-7.4C15.6,18.4,18.9,15.1,22.9,15.1z M14.5,22.5
                        c0,4.7,3.8,8.5,8.4,8.5c2.1,0,4-0.8,5.5-2.1l6.1,7c0.2,0.2,0.6,0.2,0.8,0c0.2-0.2,0.2-0.6,0-0.8l-6.1-7c1.3-1.5,2.1-3.5,2.1-5.6
                        c0-4.7-3.8-8.5-8.4-8.5S14.5,17.8,14.5,22.5z"></path>
            </g>
        </g>
    </defs>

    <defs>
        <g id="icon-instagram" viewBox="0 0 50 50">
            <title>Instagram</title>
            <style type="text/css">
                .st0{fill:none;}
            </style>
            <path class="st0" d="M30.8,25c0,3.2-2.6,5.8-5.8,5.8c-3.2,0-5.8-2.6-5.8-5.8c0-0.5,0.1-1,0.2-1.4h-1.6v8c0,0.4,0.3,0.7,0.7,0.7h13
                c0.4,0,0.7-0.3,0.7-0.7v-8h-1.6C30.7,24,30.8,24.5,30.8,25z"></path>
            <path class="st0" d="M25,28.6c2,0,3.6-1.6,3.6-3.6c0-2-1.6-3.6-3.6-3.6c-2,0-3.6,1.6-3.6,3.6C21.4,27,23,28.6,25,28.6z"></path>
            <path class="st0" d="M31.5,17.8h-2.2c-0.4,0-0.7,0.3-0.7,0.7v2.2c0,0.4,0.3,0.7,0.7,0.7h2.2c0.4,0,0.7-0.3,0.7-0.7v-2.2
                C32.2,18.1,31.9,17.8,31.5,17.8z"></path>
            <path d="M32.2,15.6H17.8c-1.2,0-2.2,1-2.2,2.2v14.5c0,1.2,1,2.2,2.2,2.2h14.5c1.2,0,2.2-1,2.2-2.2V17.8
                C34.4,16.6,33.4,15.6,32.2,15.6z M25,21.4c2,0,3.6,1.6,3.6,3.6c0,2-1.6,3.6-3.6,3.6c-2,0-3.6-1.6-3.6-3.6C21.4,23,23,21.4,25,21.4z
                M32.2,31.5c0,0.4-0.3,0.7-0.7,0.7h-13c-0.4,0-0.7-0.3-0.7-0.7v-8h1.6c-0.1,0.5-0.2,0.9-0.2,1.4c0,3.2,2.6,5.8,5.8,5.8
                c3.2,0,5.8-2.6,5.8-5.8c0-0.5-0.1-1-0.2-1.4h1.6V31.5z M32.2,20.7c0,0.4-0.3,0.7-0.7,0.7h-2.2c-0.4,0-0.7-0.3-0.7-0.7v-2.2
                c0-0.4,0.3-0.7,0.7-0.7h2.2c0.4,0,0.7,0.3,0.7,0.7V20.7z"></path>
        </g>
    </defs>
</svg>
