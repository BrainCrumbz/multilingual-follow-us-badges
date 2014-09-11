<?php

namespace MultilingualFollowUs\Models;

use \WPsiteFollowUs as WPsiteFollowUs;

class WPsitePlugin
{

  private function __construct()
  {
    // Nothing to do
  }
  
  public static function init()
  {
    require_once( dirname( Constants::$pluginPath ) . '/' . self::$pluginPath );
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    
    self::$settingsPageUrl = admin_url( 'options-general.php?page=wpsite-follow-us-badges-settings' );
  }
  
  public static function isActive()
  {
    return is_plugin_active( self::$pluginPath );
  }
  
  public static function overrideDefaults( $defaults )
  {
    WPsiteFollowUs::overrideDefaults( $defaults );
  }
  
  public static function getTwitterSupportedLanguages()
  {
    return WPsiteFollowUs::getSupportedLanguages( 'twitter' );
  }
  
  public static function getFacebookSupportedLanguages()
  {
    return WPsiteFollowUs::getSupportedLanguages( 'facebook' );
  }
  
  public static function getGooglePlusSupportedLanguages()
  {
    return WPsiteFollowUs::getSupportedLanguages( 'google' );
  }
  
  public static function getLinkedInSupportedLanguages()
  {
    return WPsiteFollowUs::getSupportedLanguages( 'linkedin' );
  }
  
  public static function getOptions()
  {
    $options = get_option( 'wpsite_follow_us_settings' );
    
    return $options;
  }

  public static $settingsPageName = 'settings_page_wpsite-follow-us-badges-settings';
  
  public static $settingsPageUrl;
  
  protected static $pluginPath = 'wpsite-follow-us-badges/wpsite-follow-us-badges.php';
  
}

WPsitePlugin::init();
