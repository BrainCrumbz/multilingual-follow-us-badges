<?php

namespace MultilingualFollowUs\UIControls;

use MultilingualFollowUs\Models\WPsitePlugin as WPsitePlugin;

abstract class MultilingualFollowUsBaseChannelWidget
{

  function __construct( $localiser, $pattern, $channelConfig, $channelId ) 
  {
    $this->localiser = $localiser;
    $this->pattern = $pattern;
    $this->channelConfig = $channelConfig;
    $this->channelId = $channelId;
  }

  public function updateContent( $content )
  {
    if ( $this->channelConfig->hasLanguage() ) 
    {
      $translatedLanguage = $this->translateButtonLanguage();
      
      $replacement = $this->getReplacement( $translatedLanguage );
      
      $content = preg_replace( $this->pattern, $replacement, $content );
    }
    
    return $content;
  }

  protected function translateButtonLanguage()
  {
    $buttonLanguage = $this->channelConfig->getLanguage();
  
    $doTranslate = $this->channelConfig->doTranslate();
      
    if ( ! $doTranslate ) return $buttonLanguage;
    
    $currentLanguage = $this->getCurrentPageLanguage();
    
    if( $currentLanguage ) 
    {
      return $currentLanguage;
    }
    else
    {
      return $buttonLanguage;
    }
  }

  protected function getReplacement( $translatedLanguage )
  {
    // this replacement RegEx works well with a pattern RegEx shaped like the following: 
    // +(identifying text before)language to replace(identifying text after)+
    
    return "$1$translatedLanguage$2";
  }
  
  abstract protected function getCurrentPageLanguage();
  
  protected $localiser;
  protected $pattern;
  protected $channelConfig;
  protected $channelId;
  protected $content;

}

class MultilingualFollowUsTwitterWidget extends MultilingualFollowUsBaseChannelWidget
{

  function __construct( $localiser, $channelConfig ) 
  {
    $pattern = '+(<div class="wpsite_follow_us_div twitterbox"><a .*? data-lang=").*?(".*?><\/a>)+';
    
    parent::__construct( $localiser, $pattern, $channelConfig, 'twitter' );
  }
  
  protected function getCurrentPageLanguage()
  {
    $currentLanguage = $this->localiser->getPageTwoLetterLangCode();  // e.g. 'en'
    
    $currentTwitterLanguage = ( in_array( $currentLanguage, WPsitePlugin::getTwitterSupportedLanguages() ) ? $currentLanguage : false );
    
    return $currentTwitterLanguage;
  }

}

class MultilingualFollowUsFacebookWidget extends MultilingualFollowUsBaseChannelWidget
{

  function __construct( $localiser, $channelConfig ) 
  {
    $pattern = '+(//connect.facebook.net/).*?(/all.js)+';
    
    parent::__construct( $localiser, $pattern, $channelConfig, 'facebook' );
  }
  
  protected function getCurrentPageLanguage()
  {
    $currentLanguage = $this->localiser->getPageLocale();  // e.g. 'en_US'
    
    $currentFacebookLanguage = ( in_array( $currentLanguage, WPsitePlugin::getFacebookSupportedLanguages() ) ? $currentLanguage : false );
    
    return $currentFacebookLanguage;
 }

}

class MultilingualFollowUsGooglePlusWidget extends MultilingualFollowUsBaseChannelWidget
{

  function __construct( $localiser, $channelConfig ) 
  {
    $pattern = '+(window.___gcfg = {lang: ").*?("};)+';
    
    parent::__construct( $localiser, $pattern, $channelConfig, 'google' );
  }
  
  protected function getCurrentPageLanguage()
  {
    // try with full locale first
    $currentLanguage = $this->localiser->getPageLocale();  // e.g. 'en_US'
    
    if( in_array( $currentLanguage, WPsitePlugin::getGooglePlusSupportedLanguages() ) ) 
    {
      return $currentLanguage;
    }
    
    // if not found, then try with 2-letter code
    $currentLanguage = $this->localiser->getPageTwoLetterLangCode();  // e.g. 'en'

    $currentGoogleLanguage = ( in_array( $currentLanguage, WPsitePlugin::getGooglePlusSupportedLanguages() ) ? $currentLanguage : false );
    
    return $currentGoogleLanguage;
  }

}

class MultilingualFollowUsLinkedInWidget extends MultilingualFollowUsBaseChannelWidget
{

  function __construct( $localiser, $channelConfig ) 
  {
    $pattern = '+(<script src="//platform.linkedin.com/in.js" type="text/javascript">lang: ).*?(</script>)+';
    
    parent::__construct( $localiser, $pattern, $channelConfig, 'linkedin' );
  }
  
  protected function getCurrentPageLanguage()
  {
    $currentLanguage = $this->localiser->getPageLocale();  // e.g. 'en_US'
    
    $currentLinkedInLanguage = ( in_array( $currentLanguage, WPsitePlugin::getLinkedInSupportedLanguages() ) ? $currentLanguage : false );
    
    return $currentLinkedInLanguage;
  }

}