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
				$sub_nav=donut_qs_sub_navigation($sort, array());
				break;
			case 'unanswered':
				$categoryslugs=qa_request_parts(1);
				$by=qa_get('by');
				$sub_nav=donut_unanswered_sub_navigation($by, $categoryslugs);
				break;
			case 'users':
				$sub_nav=donut_users_sub_navigation();
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

if (!function_exists('donut_qs_sub_navigation')) {
	function donut_qs_sub_navigation($sort, $categoryslugs)
	{
		$request='questions';

		if (isset($categoryslugs))
			foreach ($categoryslugs as $slug)
				$request.='/'.$slug;

		$navigation=array(
			'recent' => array(
				'label' => qa_lang('main/nav_most_recent'),
				'url' => qa_path_html($request),
			),
			
			'hot' => array(
				'label' => qa_lang('main/nav_hot'),
				'url' => qa_path_html($request, array('sort' => 'hot')),
			),
			
			'votes' => array(
				'label' => qa_lang('main/nav_most_votes'),
				'url' => qa_path_html($request, array('sort' => 'votes')),
			),

			'answers' => array(
				'label' => qa_lang('main/nav_most_answers'),
				'url' => qa_path_html($request, array('sort' => 'answers')),
			),

			'views' => array(
				'label' => qa_lang('main/nav_most_views'),
				'url' => qa_path_html($request, array('sort' => 'views')),
			),
		);
		
		if (isset($navigation[$sort])){
			$navigation[$sort]['selected']=true;
		}else{
			$request_parts = qa_request_parts();
			if ( !empty($request_parts) && $request_parts[0] == 'questions' ) {
				$navigation['recent']['selected']=true;
			}
		}
		
		if (!qa_opt('do_count_q_views'))
			unset($navigation['views']);
		
		return $navigation;
	}
}

if (!function_exists('donut_unanswered_sub_navigation')) {
	function donut_unanswered_sub_navigation($by, $categoryslugs)
	{
		$request='unanswered';

		if (isset($categoryslugs))
			foreach ($categoryslugs as $slug)
				$request.='/'.$slug;
		
		$navigation=array(
			'by-answers' => array(
				'label' => qa_lang('main/nav_no_answer'),
				'url' => qa_path_html($request),
			),
			
			'by-selected' => array(
				'label' => qa_lang('main/nav_no_selected_answer'),
				'url' => qa_path_html($request, array('by' => 'selected')),
			),
			
			'by-upvotes' => array(
				'label' => qa_lang('main/nav_no_upvoted_answer'),
				'url' => qa_path_html($request, array('by' => 'upvotes')),
			),
		);
		
		if (isset($navigation['by-'.$by])){
			$navigation['by-'.$by]['selected']=true;
		}else{
			$request_parts = qa_request_parts();
			if ( !empty($request_parts) && $request_parts[0] == 'unanswered' ) {
				$navigation['by-answers']['selected']=true;
			}
		}
			
		if (!qa_opt('voting_on_as'))
			unset($navigation['by-upvotes']);

		return $navigation;
	}
}

if (!function_exists('donut_users_sub_navigation')) {
	function donut_users_sub_navigation()
	{
		if ((!QA_FINAL_EXTERNAL_USERS) && (qa_get_logged_in_level()>=QA_USER_LEVEL_MODERATOR)) {
			$navigation = array(
				'users$' => array(
					'url' => qa_path_html('users'),
					'label' => qa_lang_html('main/highest_users'),
				),
	
				'users/special' => array(
					'label' => qa_lang('users/special_users'),
					'url' => qa_path_html('users/special'),
				),
	
				'users/blocked' => array(
					'label' => qa_lang('users/blocked_users'),
					'url' => qa_path_html('users/blocked'),
				),
			);
			
			$request_parts = qa_request_parts();
			if ( !empty($request_parts) && $request_parts[0] == 'users') {
				if (count($request_parts) == 1) {
					$navigation['users$']['selected']=true;	
				}else if (count($request_parts) > 1 && $request_parts[1] == 'special') {
					$navigation['users/special']['selected']=true;	
				}else if (count($request_parts) > 1 && $request_parts[1] == 'blocked') {
					$navigation['users/blocked']['selected']=true;	
				}
			}

			return $navigation;

		} else
			return null;
	}
}

if (!defined('donut_get_user_data')) {
	function donut_get_user_data($handle){
		$userid = qa_handle_to_userid($handle);
		$identifier=QA_FINAL_EXTERNAL_USERS ? $userid : $handle;
		$user = array();
		if(defined('QA_WORDPRESS_INTEGRATE_PATH')){
			$u_rank = qa_db_select_with_pending(qa_db_user_rank_selectspec($userid,true));
			$u_points = qa_db_select_with_pending(qa_db_user_points_selectspec($userid,true));
			
			$userinfo = array();
			$user_info = get_userdata( $userid );
			$userinfo['userid'] = $userid;
			$userinfo['handle'] = $handle;
			$userinfo['email'] = $user_info->user_email;
			
			$user[0] = $userinfo;
			$user[1]['rank'] = $u_rank;
			$user[2] = $u_points;
			$user = ($user[0]+ $user[1]+ $user[2]);
		}else{
			$user['account'] = qa_db_select_with_pending( qa_db_user_account_selectspec($userid, true) );
			$user['rank'] = qa_db_select_with_pending( qa_db_user_rank_selectspec($handle) );
			$user['points'] = qa_db_select_with_pending( qa_db_user_points_selectspec($identifier) );
			
			$user['followers'] = qa_db_read_one_value( qa_db_query_sub('SELECT count(*) FROM ^userfavorites WHERE ^userfavorites.entityid = # and ^userfavorites.entitytype = "U" ', $userid), true );
			
			$user['following'] = qa_db_read_one_value( qa_db_query_sub('SELECT count(*) FROM ^userfavorites WHERE ^userfavorites.userid = # and ^userfavorites.entitytype = "U" ', $userid), true );
		}

		return $user;
	}	
}

		
function donut_user_profile($handle, $field =NULL){
	$userid = qa_handle_to_userid($handle);
	if(defined('QA_WORDPRESS_INTEGRATE_PATH')){
		return get_user_meta( $userid );
	}else{
		$query = qa_db_select_with_pending(qa_db_user_profile_selectspec($userid, true));
		
		if(!$field) return $query;
		if (isset($query[$field]))
			return $query[$field];
	}
	
	return false;
}	

function donut_user_badge($handle) {
	if(qa_opt('badge_active')){
	$userids = qa_handles_to_userids(array($handle));
	$userid = $userids[$handle];

	
	// displays small badge widget, suitable for meta
	
	$result = qa_db_read_all_values(
		qa_db_query_sub(
			'SELECT badge_slug FROM ^userbadges WHERE user_id=#',
			$userid
		)
	);

	if(count($result) == 0) return;
	
	$badges = qa_get_badge_list();
	foreach($result as $slug) {
		$bcount[$badges[$slug]['type']] = isset($bcount[$badges[$slug]['type']])?$bcount[$badges[$slug]['type']]+1:1; 
	}
	$output='<ul class="user-badge clearfix">';
	for($x = 2; $x >= 0; $x--) {
		if(!isset($bcount[$x])) continue;
		$count = $bcount[$x];
		if($count == 0) continue;

		$type = qa_get_badge_type($x);
		$types = $type['slug'];
		$typed = $type['name'];

		$output.='<li class="badge-medal '.$types.'"><i class="icon-badge" title="'.$count.' '.$typed.'"></i><span class="badge-pointer badge-'.$types.'-count" title="'.$count.' '.$typed.'"> '.$count.'</span></li>';
	}
	$output = substr($output,0,-1);  // lazy remove space
	$output.='</ul>';
	return($output);
	}
}
