<?php 

/**
 * Defines the base directory of the theme 
 */
if (!defined('DONUT_THEME_BASE_DIR')) {
	define('DONUT_THEME_BASE_DIR', dirname(__FILE__));
}

if (!defined('DONUT_THEME_BASE_DIR_NAME')) {
	define('DONUT_THEME_BASE_DIR_NAME', basename(dirname(__FILE__)));
}

if (!defined('DONUT_THEME_ROOT_URL')) {
	define('DONUT_THEME_ROOT_URL', qa_opt('site_url').'qa-theme/'.DONUT_THEME_BASE_DIR_NAME);
}

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

// include the theme layer overrides 

require_once DONUT_THEME_BASE_DIR.'/utils/qa-donut-utils.php';
require_once DONUT_THEME_BASE_DIR.'/qa-donut-layer.php';

// qa_register_plugin_overrides(DONUT_THEME_BASE_DIR .'/utils/qa-donut-overrides.php') ;