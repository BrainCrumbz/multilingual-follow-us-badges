<?php

namespace MultilingualFollowUs\Controllers;

use MultilingualFollowUs\Models\Constants as Constants;
use MultilingualFollowUs\Models\Localiser as Localiser;
use MultilingualFollowUs\Models\WPsitePlugin as WPsitePlugin;
use MultilingualFollowUs\UIControls\MainWidget as MainWidget;

class FrontEndController
{

  function __construct() 
  {
    require_once( Constants::$pluginPath . 'models/WPsitePlugin.php' );
    require_once( Constants::$pluginPath . 'models/Localiser.php' );
    require_once( Constants::$pluginPath . 'uicontrols/MainWidget.php' );
    
    $this->registerHooks();
  }
  
  protected function registerHooks()
  {
    add_filter( 'wpsite_follow_us_render_widget', $this->cb( 'renderWidget' ) );
  }
  
  public function renderWidget( $content )
  {
    $pageLocaliser = new Localiser();
    
    $wpsiteSettings = WPsitePlugin::getOptions();
    
    $widget = new MainWidget( $pageLocaliser, $content, $wpsiteSettings );
    
    return $widget->render();
  }
  
  protected function cb( $methodName )
  {
    return array( &$this, $methodName );
  }

}