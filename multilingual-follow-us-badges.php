<?php
/*
Plugin Name: Multilingual Follow Us Badges
Plugin URI: http://www.braincrumbz.com/
Description: Extends <em>WPsite Follow Us Badges</em> plugin to support localisation in multilingual sites enabled by <em>Polylang</em> plugin. <strong>Credits:</strong> <em>WPsite Follow Us Badges</em> plugin created by WPsite; <em>Polylang</em> plugin created by Frédéric Demarle.
Author: BrainCrumbz
Author URI: http://www.braincrumbz.com/
Version: 1.0
Text Domain: multilingual-follow-us-badges
*/

error_reporting( E_ALL );

// Prevent directly calling this file, by aborting execution
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

// Define shared constants
require_once( 'models/Constants.php' );

use MultilingualFollowUs\Models\Constants as Constants;

Constants::init( __FILE__ );

// Include the core class responsible for loading all necessary components of the plugin
require_once( Constants::$pluginPath . 'controllers/ActivationController.php' );

use MultilingualFollowUs\Controllers\ActivationController;

new ActivationController( __FILE__ );
