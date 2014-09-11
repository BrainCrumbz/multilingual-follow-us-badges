<?php

namespace MultilingualFollowUs\Models;

class Constants
{

  private function __construct()
  {
		// Nothing to do
  }
	
	public static function init( $mainPluginFilePath )
	{
		self::$pluginSlug = dirname( $mainPluginFilePath );
		self::$pluginPath = plugin_dir_path( $mainPluginFilePath );
		self::$pluginUrl  = plugin_dir_url( $mainPluginFilePath );
		self::$textDomain = self::$pluginSlug;
	}
	
	// Plugin slug 
	public static $pluginSlug;
	
	// Plugin directory
	public static $pluginPath;
	
	// Plugin URL 
	public static $pluginUrl;
	
	// Plugin text domain
	public static $textDomain;
	
}
