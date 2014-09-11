<?php

namespace MultilingualFollowUs\UIControls;

use MultilingualFollowUs\Models\Constants as Constants;
use MultilingualFollowUs\Models\Config as Config;

class MainWidget
{

  function __construct( $pageLocaliser, $content, $wpsiteSettings )
  {
    require_once( Constants::$pluginPath . 'models/Config.php' );
    require_once( Constants::$pluginPath . 'uicontrols/ChannelWidget.php' );

    $this->config = new Config( $wpsiteSettings );
    
    $this->channelWidgets = array(
      'twitter' => new MultilingualFollowUsTwitterWidget( $pageLocaliser, $this->config->twitter() ),
      'facebook' => new MultilingualFollowUsFacebookWidget( $pageLocaliser, $this->config->facebook() ),
      'googlePlus' => new MultilingualFollowUsGooglePlusWidget( $pageLocaliser, $this->config->googlePlus() ),
      'linkedIn' => new MultilingualFollowUsLinkedInWidget( $pageLocaliser, $this->config->linkedIn() ),
    );
    
    $this->content = $content;
  }
  
  public function render()
  {
    foreach ( $this->channelWidgets as $channelWidget )
    {
      $this->content = $channelWidget->updateContent( $this->content );
    }
    
    return $this->content;
  }
  
  protected $content;
  protected $config;

}
