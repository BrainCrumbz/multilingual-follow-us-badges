<?php

namespace MultilingualFollowUs\UIControls;

use MultilingualFollowUs\Models\Constants as Constants;

abstract class MultilingualFollowUsBaseSettingsTab
{

  function __construct( $channelId, $divId, $channelConfig,
    $partialFilename = 'admin-settings-translate-option.php' ) 
  {
    $this->channelId = $channelId;
    $this->divId = $divId;
    $this->channelConfig = $channelConfig;
    $this->partialPath = Constants::$pluginPath . 'views/' . $partialFilename;
  }
  
  public function processOutput( $doc, $xPath )
  {
    $this->replaceLanguageLabel( $xPath );
    
    $this->insertTranslateOption( $doc, $xPath );
  }
  
  protected function replaceLanguageLabel( $xPath )
  {
    $languageLabel = $this->getLanguageLabel( $xPath );
    
    $languageLabel->firstChild->nodeValue = __( 'Default Language', Constants::$textDomain );
  }
  
  protected function insertTranslateOption( $doc, $xPath )
  {
    $viewBag = array(
      'fieldId' => $this->channelConfig->getFieldId(),
      'doTranslate' => $this->channelConfig->doTranslate(),
    );
    
    ob_start();
    
    require( $this->partialPath );
    $viewBuffer = ob_get_contents();
    
    ob_end_clean();

    $viewDoc = new DOMDocument();
    @$viewDoc->loadHtml( $viewBuffer );

    $viewTableRow = $viewDoc->getElementsByTagName( 'tr' )->item( 0 );
    
    unset( $viewDoc );
    
    $translateOptRow = $doc->importNode( $viewTableRow, true );
    
    $languageLabel = $this->getLanguageLabel( $xPath );
    $languageRow = $xPath->query( 'ancestor::tr', $languageLabel )->item( 0 );
    
    $languageRow->parentNode->appendChild( $translateOptRow );
  }
  
  protected function getLanguageLabel( $xPath )
  {
    $advancedHeading = $xPath
      ->query( '//div[ @id="' . $this->divId . '" ]//h3' )
      ->item( self::$advancedHeadingIndex );
    
    $advancedTable = $advancedHeading->nextSibling->nextSibling;  // account for unwanted text node in between

    $languageLabel = $xPath->query( './/label', $advancedTable )->item( self::$languageLabelIndex );
    
    return $languageLabel;
  }
  
  protected $channelId;
  protected $divId;
  protected $partialPath;
  protected $channelConfig;

  protected static $advancedHeadingIndex = 2;
  protected static $languageLabelIndex = 0;
  
}

class MultilingualFollowUsTwitterSettingsTab extends MultilingualFollowUsBaseSettingsTab
{

  function __construct( $channelConfig ) 
  {
    parent::__construct( 'twitter', 'wpsite_div_twitter', $channelConfig );
  }

}

class MultilingualFollowUsFacebookSettingsTab extends MultilingualFollowUsBaseSettingsTab
{

  function __construct( $channelConfig ) 
  {
    parent::__construct( 'facebook', 'wpsite_div_facebook', $channelConfig );
  }

}

class MultilingualFollowUsGooglePlusSettingsTab extends MultilingualFollowUsBaseSettingsTab
{

  function __construct( $channelConfig ) 
  {
    parent::__construct( 'google', 'wpsite_div_google', $channelConfig );
  }

}

class MultilingualFollowUsLinkedInSettingsTab extends MultilingualFollowUsBaseSettingsTab
{

  function __construct( $channelConfig ) 
  {
    parent::__construct( 'linkedin', 'wpsite_div_linkedin', $channelConfig );
  }

}