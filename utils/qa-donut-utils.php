<?php 
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

if (!function_exists('donut_base_url')) {
	function donut_base_url()
	{
		/* First we need to get the protocol the website is using */
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
					$_SERVER['SERVER_PORT'] == 443 || 
					(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') || 
					(!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) ? "https://" : "http://";

		$root = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']);
		
		if(substr($root, -1) == '/')$root = substr($root, 0, -1);
		$base = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, rtrim(QA_BASE_DIR, '/'));

		/* Returns localhost OR mysite.com */
		$host = $_SERVER['HTTP_HOST'];

		$url = $protocol . $host . '/' . str_replace($root, '', $base );
		
		return (substr($url, -1) == '/') ? substr($url, 0, -1) : $url;
	}
}

if (!function_exists('donut_get_sub_navigation')) {
	function donut_get_sub_navigation($page_type , $template = '')
	{
		require_once QA_INCLUDE_DIR.'qa-app-q-list.php';
		require_once QA_INCLUDE_DIR.'qa-app-format.php';
		require_once QA_INCLUDE_DIR.'qa-app-admin.php';
		$sub_nav = array();
		switch ($page_type) {
			case 'questions':
				$sort = qa_get('sort');
				$sub_nav=qa_qs_sub_navigation($sort, array());
				break;
			case 'unanswered':
				$categoryslugs=qa_request_parts(1);
				$by=qa_get('by');
				$sub_nav=qa_unanswered_sub_navigation($by, $categoryslugs);
				break;
			case 'users':
				$sub_nav=qa_users_sub_navigation();
				break;
			case 'admin':
				$sub_nav=qa_admin_sub_navigation();
				break;
			default:
				break;
		}
		return $sub_nav;
	}
}

if (!function_exists('donut_get_glyph_icon')) {
	function donut_get_glyph_icon($icon)
	{
		if (!empty($icon)) {
			return '<span class="glyphicon glyphicon-'.$icon.'"></span> ';
		}else {
			return '' ;
		}
	}
}

if (!function_exists('donut_get_fa_icon')) {
	function donut_get_fa_icon($icon)
	{
		if (!empty($icon)) {
			return '<span class="fa fa-'.$icon.'"></span> ';
		}else {
			return '' ;
		}
	}
}

if (!function_exists('donut_get_voting_icon')) {
	function donut_get_voting_icon($tags){
		$icon = '' ;
		switch ($tags) {
			case 'vote_up_tags':
				$icon = 'chevron-up' ;
				break;
			case 'vote_down_tags':
				$icon = 'chevron-down' ;
				break;
			case 'unselect_tags':
			case 'select_tags':
				$icon = 'check' ;
				break;
			default:
				break;
		}
		return donut_get_fa_icon($icon);
	}
}

if (!function_exists('starts_with')) {
	function starts_with($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
}

if (!function_exists('ends_with')) {
	function ends_with($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}

if (!function_exists('donut_remove_brackets')) {
	function donut_remove_brackets(&$nav_cat){
		if (is_array($nav_cat) && count($nav_cat)) {
			foreach ($nav_cat as $key => &$nav_cat_item) {
				if (!empty($nav_cat_item['note'])) {
					$nav_cat_item['note'] = str_replace(array('(',')'), '',$nav_cat_item['note']);
				}
				if (!empty($nav_cat_item['subnav'])) {
					donut_remove_brackets($nav_cat_item['subnav']);
				}
			}
		}
	}
}

