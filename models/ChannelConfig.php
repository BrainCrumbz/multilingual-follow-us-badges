<?php

namespace MultilingualFollowUs\Models;

abstract class MultilingualFollowUsBaseChannelConfig
{

  function __construct( $wpsiteSettings, $channelId ) 
  {
    require_once( Constants::$pluginPath . 'models/WPsitePlugin.php' );
    
    $this->wpsiteSettings = $wpsiteSettings;
    $this->channelId = $channelId;
    
    $this->postSettingsId = 'wpsite_follow_us_settings_' . $this->channelId . '_args_translate';
  }
  
  public function overrideDefaults()
  {
    $defaults = array(
      $this->channelId => array(
        'args' => array(
          'translate' => false,
        ),
      ),
    );
    
    WPsitePlugin::overrideDefaults($defaults);
  }
  
  public function setSettings( $wpsiteSettings )
  {
    $this->wpsiteSettings = $wpsiteSettings;
  }
  
  public function updateFromRequest()
  {
    $requestedValue = ! empty( $_POST[$this->postSettingsId] );
    
    $this->wpsiteSettings[$this->channelId]['args']['translate'] = $requestedValue;
  
    return $this->wpsiteSettings;
  }
  
  public function hasLanguage()
  {
    return ( isset( $this->wpsiteSettings[$this->channelId]['active'] ) 
      && $this->wpsiteSettings[$this->channelId]['active'] 
      && isset( $this->wpsiteSettings[$this->channelId]['args']['language'] ) );
  }
  
  public function getLanguage()
  {
    return $this->wpsiteSettings[$this->channelId]['args']['language'];
  }
  
  public function doTranslate()
  {
    return ( isset( $this->wpsiteSettings[$this->channelId]['args']['translate'] ) 
      ? $this->wpsiteSettings[$this->channelId]['args']['translate'] 
      : false );
  }
  
  public function getFieldId()
  {
    return $this->postSettingsId;
  }
  
  protected $wpsiteSettings;
  protected $channelId;
  protected $postSettingsId;

}

class MultilingualFollowUsTwitterConfig extends MultilingualFollowUsBaseChannelConfig
{

  function __construct( $wpsiteSettings ) 
  {
    parent::__construct( $wpsiteSettings, 'twitter' );
  }

}

class MultilingualFollowUsFacebookConfig extends MultilingualFollowUsBaseChannelConfig
{

  function __construct( $wpsiteSettings ) 
  {
    parent::__construct( $wpsiteSettings, 'facebook' );
  }

}

class MultilingualFollowUsGooglePlusConfig extends MultilingualFollowUsBaseChannelConfig
{

  function __construct( $wpsiteSettings ) 
  {
    parent::__construct( $wpsiteSettings, 'google' );
  }

}

class MultilingualFollowUsLinkedInConfig extends MultilingualFollowUsBaseChannelConfig
{

  function __construct( $wpsiteSettings ) 
  {
    parent::__construct( $wpsiteSettings, 'linkedin' );
  }

}