<?php

namespace MultilingualFollowUs\UIControls;

use MultilingualFollowUs\Models\Constants as Constants;

class SettingsPage
{

  function __construct() 
  {
    require_once( Constants::$pluginPath . 'uicontrols/ChannelSettingsTab.php' );
  }
  
  public function before()
  {
    ob_start();
  }
  
  public function after( $config )
  {
    $buffer = ob_get_contents();
    
    ob_end_clean();
    
    $output = $this->processOutput( $buffer, $config );
    
    echo $output;
  }
  
  public function processOutput( $buffer, $config )
  {
    $this->channelTabs = array(
      'twitter' => new MultilingualFollowUsTwitterSettingsTab( $config->twitter() ),
      'facebook' => new MultilingualFollowUsFacebookSettingsTab( $config->facebook() ),
      'googlePlus' => new MultilingualFollowUsGooglePlusSettingsTab( $config->googlePlus() ),
      'linkedIn' => new MultilingualFollowUsLinkedInSettingsTab( $config->linkedIn() ),
    );
    
    $doc = new DOMDocument();
    @$doc->loadHtml( $buffer );  // prefix with '@' to suppress warnings from original plugin HTML
    $xPath = new DOMXPath( $doc );
    
    $this->customiseHeader( $doc, $xPath );
    
    foreach ( $this->channelTabs as $channelTab )
    {
      $channelTab->processOutput( $doc, $xPath, $config );
    }
    
    $output = $doc->saveHtml();
    
    unset( $doc );

    return $output;
  }
  
  protected function customiseHeader( $doc, $xPath )
  {
    $pluginInfo = $xPath
      ->query( '//*[ @class="wpsite_plugin_header" ]//*[ @class="headercontent" ]//*[ @class="plugin-info" ]' )
      ->item( 0 );
    
    $customName = $doc->createElement( 'span', __( ' Multilingual', Constants::$textDomain ) );
    $customName->setAttribute( 'class', 'bcz-multilingual-plugin-name' );
    
    $pluginInfo->appendChild( $customName );
  }
  
  protected $channelTabs;

}