<?php

namespace MultilingualFollowUs\Models;

class Config
{
  
  function __construct( $wpsiteSettings = array() )
  {
    require_once( Constants::$pluginPath . 'models/ChannelConfig.php' );
    
    $this->channelConfigs = array(
      'twitter' => new MultilingualFollowUsTwitterConfig( $wpsiteSettings ),
      'facebook' => new MultilingualFollowUsFacebookConfig( $wpsiteSettings ),
      'googlePlus' => new MultilingualFollowUsGooglePlusConfig( $wpsiteSettings ),
      'linkedIn' => new MultilingualFollowUsLinkedInConfig( $wpsiteSettings ),
    );
    
    $this->wpsiteSettings = $wpsiteSettings;
    
    $this->options = array_merge(
      self::$defaultOptions,
      get_option( self::$optionId, array() ) );

    $this->overrideDefaults();
  }
  
  protected function overrideDefaults()
  {
    foreach ( $this->channelConfigs as $channelConfig )
    {
      $channelConfig->overrideDefaults();
    }
  }
  
  public function updateFromRequest()
  {
    foreach ( $this->channelConfigs as $channelConfig )
    {
      $channelConfig->setSettings( $this->wpsiteSettings );
      
      $this->wpsiteSettings = $channelConfig->updateFromRequest();
    }
  
    return $this->wpsiteSettings;
  }
  
  public function twitter()
  {
    return $this->channelConfigs['twitter'];
  }
  
  public function facebook()
  {
    return $this->channelConfigs['facebook'];
  }
  
  public function googlePlus()
  {
    return $this->channelConfigs['googlePlus'];
  }
  
  public function linkedIn()
  {
    return $this->channelConfigs['linkedIn'];
  }
  
  public function setJustActivated()
  {
    $this->options['justActivated'] = true;
    
    update_option( self::$optionId, $this->options );
  }
  
  public function isJustActivated()
  {
    return $this->options['justActivated'];
  }
  
  public function clearJustActivated()
  {
    $this->options['justActivated'] = false;
    
    update_option( self::$optionId, $this->options );
  }
  
  public function removeAll()
  {
    delete_option( self::$optionId );
  }
  
  protected $options;
  protected $wpsiteSettings;
  protected $channelConfigs;
  
  protected static $optionId = 'multilingual-follow-us-badges-options';

  protected static $defaultOptions = array(
    'justActivated' => false,
  );
  
}
