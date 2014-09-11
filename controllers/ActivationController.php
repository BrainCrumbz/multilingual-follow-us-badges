<?php

namespace MultilingualFollowUs\Controllers;

use MultilingualFollowUs\Models\Constants as Constants;
use MultilingualFollowUs\Models\WPsitePlugin as WPsitePlugin;
use MultilingualFollowUs\Models\Config as Config;

class ActivationController
{

  function __construct( $mainPluginFilePath ) 
  {
    require_once( Constants::$pluginPath . 'models/WPsitePlugin.php' );
    require_once( Constants::$pluginPath . 'models/Config.php' );
    require_once( Constants::$pluginPath . 'controllers/CoreController.php' );
    
    if ( $this->requirementsMet() )
    {
      register_activation_hook( $mainPluginFilePath, $this->cb( 'activate' ) );
      register_deactivation_hook ( $mainPluginFilePath, $this->cb( 'deactivate' ) );

      new CoreController();
    }
    else 
    {
      add_action( 'admin_notices', $this->cb( 'showRequirementsError' ) );
    }
  }
  
  protected function requirementsMet()
  {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    
    if ( ! WPsitePlugin::isActive() ) {
      return false;
    }
    
    if ( ! is_plugin_active( 'polylang/polylang.php' ) ) {
      return false;
    }
    
    return true;
  }
  
  public function activate()
  {
    $config = new Config();
    
    $config->setJustActivated();
  }
  
  public function deactivate()
  {
    $config = new Config();
    
    $config->removeAll();
  }
  
  public function showRequirementsError()
  {
    require_once( Constants::$pluginPath . '/views/requirements-error.php' );
  }
  
  protected function cb( $methodName )
  {
    return array( &$this, $methodName );
  }
  
  /*
  protected static function scb( $methodName )
  {
    return array( __CLASS__, $methodName );
  }
  */
  
}