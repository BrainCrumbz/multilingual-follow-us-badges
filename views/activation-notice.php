<?php
  require_once( Constants::$pluginPath . 'models/WPsitePlugin.php' );
  
  $settingsAnchorOpen = '<a href="' . WPsitePlugin::$settingsPageUrl . '">';
  $settingsAnchorClose = '</a>';
?>
<div class="updated">
  
  <p><?php
    _e( "Follow <em>Settings -> WPsite Follow Us</em> menu to $settingsAnchorOpen settings page $settingsAnchorClose and look for new <em>Translate</em> checkboxes at the bottom.", Constants::$textDomain );
  ?></p>
  
</div>