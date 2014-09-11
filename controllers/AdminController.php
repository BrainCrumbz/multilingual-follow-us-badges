<?php

namespace MultilingualFollowUs\Controllers;

use MultilingualFollowUs\Models\Constants as Constants;
use MultilingualFollowUs\Models\WPsitePlugin as WPsitePlugin;
use MultilingualFollowUs\Models\Config as Config;
use MultilingualFollowUs\UIControls\SettingsPage as SettingsPage;

class AdminController
{

  function __construct() 
  {
    require_once( Constants::$pluginPath . 'models/Config.php' );
    require_once( Constants::$pluginPath . 'uicontrols/SettingsPage.php' );
    
    $this->settingsPage = new SettingsPage();
    
    $this->registerHooks();
  }
  
  protected function registerHooks()
  {
    $defaultPrio = 10;
    $nrOfInputArgs = 1;
    
    add_action( 'admin_enqueue_scripts', $this->cb( 'addStylesheets' ) );

    add_action( 'admin_notices', $this->cb( 'showAdminControllerNotices' ) );

    add_action( 'wpsite_follow_us_before_admin_settings_page', $this->cb( 'beforeSettingsPage' ), $defaultPrio, $nrOfInputArgs );
    add_action( 'wpsite_follow_us_after_admin_settings_page', $this->cb( 'afterSettingsPage' ), $defaultPrio, $nrOfInputArgs );
    
    add_filter( 'wpsite_follow_us_save_settings', $this->cb( 'saveSettings' ) );
  }
  
  public function addStylesheets( $page )
  {
    if ( WPsitePlugin::$settingsPageName == $page )
    {
      wp_enqueue_style( 'prefix-style', Constants::$pluginUrl . 'css/style-admin.css' );
    }
  }
  
  public function showAdminControllerNotices()
  {
    $config = new Config();
    
    if ( $config->isJustActivated() )
    {
      $config->clearJustActivated();
      
      require_once( Constants::$pluginPath . '/views/activation-notice.php' );
    }
  }
  
  public function beforeSettingsPage( $wpsiteSettings )
  {
    $this->settingsPage->before();
  }
  
  public function afterSettingsPage( $wpsiteSettings )
  {
    $config = new Config( $wpsiteSettings );
    
    $this->settingsPage->after( $config );
  }
  
  public function saveSettings( $wpsiteSettings )
  {
    $config = new Config( $wpsiteSettings );
    
    return $config->updateFromRequest();
  }
  
  protected function cb( $methodName )
  {
    return array( &$this, $methodName );
  }
  
  protected $settingsPage;

}