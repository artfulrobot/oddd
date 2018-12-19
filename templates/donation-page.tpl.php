<div class="odd-node" id="odd-id-<?php print $nid;?>" data-config="<?php print ($odd_config) ;?>">
  <noscript>This page needs Javascript</noscript>
</div>
<script><?php print file_get_contents(__DIR__ . '/oddd/public/vendor.js');?></script>
<script><?php print file_get_contents(__DIR__ . '/oddd/public/app.js');?></script>
<script>require('initialize')</script>
<style><?php print file_get_contents(__DIR__ . '/oddd/public/app.css');?></style>
