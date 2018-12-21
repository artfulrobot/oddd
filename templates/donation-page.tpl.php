<div class="odd-node-wrapper" style="<?php print $background;?>">
  <div class="odd-node" id="odd-id-<?php print $nid;?>" data-config="<?php print ($odd_config) ;?>">
    <noscript>This page needs Javascript</noscript>
    <?php if ($thanks):?>
      <h2>Thank you</h2>
      <p>You should be returned to where you were on our website in a moment.</p>
      <p><a href="<?php print htmlspecialchars($return_url)?>"><?php print htmlspecialchars($return_url);?></a></p>
    <?php endif;?>
  </div>
  <?php if (!$thanks):?>
  <script><?php print file_get_contents(__DIR__ . '/oddd/public/vendor.js');?></script>
  <script><?php print file_get_contents(__DIR__ . '/oddd/public/app.js');?></script>
  <script>require('initialize')</script>
  <style><?php print file_get_contents(__DIR__ . '/oddd/public/app.css');?></style>
  <?php endif;?>
</div>
