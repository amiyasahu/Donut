<?php 
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

/**
 * Defines the base directory of the theme 
 */
if (!defined('DONUT_THEME_BASE_DIR')) {
	define('DONUT_THEME_BASE_DIR', dirname(__FILE__));
}
/**
 * define the directory name of the theme directory 
 */
if (!defined('DONUT_THEME_BASE_DIR_NAME')) {
	define('DONUT_THEME_BASE_DIR_NAME', basename(dirname(__FILE__)));
}

/**
 * define the theme root URL
 */
if (!defined('DONUT_THEME_ROOT_URL')) {
	define('DONUT_THEME_ROOT_URL', qa_opt('site_url').'qa-theme/'.DONUT_THEME_BASE_DIR_NAME);
}

/**
 * define the version of the theme that is installed 
 */
if (!defined('DONUT_THEME_VERSION')) {
	define('DONUT_THEME_VERSION', 1.0 );
}

/**
 * Please DO NOT Change the version Unique id . 
 * This will increase in each version , that helps you in adding new theme defaults 
 */
if (!defined('DONUT_THEME_VERSION_UID')) {
	define('DONUT_THEME_VERSION_UID', 1 );
}

/**
 * If this option is set to true , the theme will use advanced setups like CDN , 
 * caching to enhance the performance . 
 * If you using this on your local machine with out a internet connection then set it to false 
 */
if (!defined('DONUT_ACTIVATE_PROD_MODE')) {
	define('DONUT_ACTIVATE_PROD_MODE', FALSE );
}

if (!defined('DONUT_LANG_RTL')) {
	define('DONUT_LANG_RTL', FALSE );
}
/**
 * include the required files for the theme 
 */
require_once DONUT_THEME_BASE_DIR.'/utils/qa-donut-utils.php';
require_once DONUT_THEME_BASE_DIR.'/utils/donut-options.php';
require_once DONUT_THEME_BASE_DIR.'/qa-donut-layer.php';
