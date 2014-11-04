<?php

$userid = qa_get_logged_in_userid();
$useraccount=qa_db_select_with_pending(qa_db_user_account_selectspec($userid, true) );

$logged_in_user_avatar = qa_get_user_avatar_html($useraccount['flags'], $useraccount['email'], null ,
			$useraccount['avatarblobid'], $useraccount['avatarwidth'], $useraccount['avatarheight'], 40);

if (empty($logged_in_user_avatar)) {
	// if the default avatar is not set by the admin , then take the default 
	$logged_in_user_avatar = '<img src="'.DONUT_THEME_ROOT_URL.'/images/default-profile-pic.png" width="40" height="40" class="qa-avatar-image" alt="">';
}

if (isset($this->content['navigation']['user']['updates'])) {
	$this->content['navigation']['user']['updates']['icon'] = 'bell-o' ;
}	

?>

<li class="user-name active">
	<a href="<?php echo qa_path_html('user/' . qa_get_logged_in_handle()); ?>"><?php echo qa_get_logged_in_handle(); ?></a>
</li>
<li class="dropdown user-dropdown"> 
	<a href="#" class="navbar-user-img dropdown-toggle" data-toggle="dropdown">
		<?php echo $logged_in_user_avatar ; ?>
	</a>
	
	<ul class="dropdown-menu" role="menu" id="user-dropdown-menu">
		<?php if (qa_get_logged_in_level() >= QA_USER_LEVEL_ADMIN): ?>
			<li>
				<a href="<?php echo qa_path_html('admin') ?>">
					<span class="fa fa-cog"></span>	
					<?php echo qa_lang_html('main/nav_admin'); ?>
				</a>
			</li>
		<?php endif ?>
		<li>
			<a href="<?php echo qa_path_html('user/' . qa_get_logged_in_handle()); ?>">
				<span class="fa fa-user"></span>	
				<?php echo qa_get_logged_in_handle(); ?>
			</a>
		</li>
		<li>
			<a href="<?php echo qa_path_html('user/' . qa_get_logged_in_handle()); ?>">
				<span class="fa fa-money"></span>	
				<?php echo qa_get_logged_in_points().' '.qa_lang_html('admin/points_title') ?>
			</a>
		</li>
		<?php foreach ($this->content['navigation']['user'] as $key => $user_nav): ?>
			<?php if ($key !== 'logout'): ?>
				<li>
					<a href="<?php echo @$user_nav['url']; ?>">
						<?php if (!empty($user_nav['icon'])): ?>
							<span class="fa fa-<?php echo $user_nav['icon'] ;?>"></span>
						<?php endif ?>
						<?php echo @$user_nav['label']; ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
		<li>
			<a href="<?php echo @$this->content['navigation']['user']['logout']['url'] ?>">
				<span class="fa fa-power-off"></span>	
				<?php echo @$this->content['navigation']['user']['logout']['label'] ?>
			</a>
		</li>
	</ul>
</li>