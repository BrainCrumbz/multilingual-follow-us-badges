<?php

namespace MultilingualFollowUs\Controllers;

use MultilingualFollowUs\Models\Constants as Constants;

class CoreController
{

  function __construct() 
  {
    require_once( Constants::$pluginPath . 'controllers/AdminController.php' );
    require_once( Constants::$pluginPath . 'controllers/FrontEndController.php' );
    
    new AdminController();
    new FrontEndController();
    
    $this->registerHooks();
  }
  
  protected function registerHooks()
  {
    // Load plugin textdomain
    add_action( 'init', $this->cb( 'loadTextdomain' ) );
  }
  
  public function loadTextdomain()
  {
    $domain = Constants::$textDomain;
    
    $locale = apply_filters( Constants::$pluginSlug, get_locale(), $domain );
    
    load_plugin_textdomain( $domain, FALSE, Constants::$pluginPath . 'lang/' );
  }
  
  protected function cb( $methodName )
  {
    return array( &$this, $methodName );
  }

}
