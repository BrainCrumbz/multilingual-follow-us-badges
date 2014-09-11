<?php

namespace MultilingualFollowUs\Models;

class Localiser
{
  
  function __construct()
  {
    // Nothing to do
  }
  
  public function getPageLocale()
  {
    $currentPageLanguage = pll_current_language( 'locale' );  // e.g. 'en_US'
    
    return $currentPageLanguage;
  }
  
  public function getPageTwoLetterLangCode()
  {
    $currentPageLanguage = pll_current_language( 'slug' );  // e.g. 'en'
    
    return $currentPageLanguage;
  }
  
}
