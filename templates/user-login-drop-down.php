<?php
$print_or = false ;
?>
<li> <a class=""  href="<?php echo qa_path_html('register'); ?>" title="<?php echo qa_lang_html('users/register_title'); ?>"><span><?php echo qa_lang_html('users/register_button'); ?></span></a> </li>
<li class="dropdown login-dropdown"> <a class=""  href="#" title="<?php echo qa_lang_html('users/login_title'); ?>" data-toggle="dropdown"><?php echo qa_lang_html('users/login_button'); ?></a>
	<ul class="dropdown-menu" role="menu" id="login-dropdown-menu">
		<?php      
			if(!empty($this->content['navigation']['user'])){
				$this->output('<li class="open-login-buttons">');
				foreach ($this->content['navigation']['user'] as $k => $custom) {
					if (isset($custom) && (($k != 'login') && ($k != 'register'))) {
						preg_match('/class="([^"]+)"/', @$custom['label'], $class);
						
						if ($k == 'facebook')
							$icon = 'class="' . @$class[1] . ' fa fa-facebook"';
						elseif ($k == 'github')
							$icon = 'class="' . @$class[1] . ' fa fa-github"';
						elseif ($k == 'foursquare')
							$icon = 'class="' . @$class[1] . ' fa fa-foursquare"';
						elseif ($k == 'google')
							$icon = 'class="' . @$class[1] . ' fa fa-google"';
						elseif ($k == 'googleplus')
							$icon = 'class="' . @$class[1] . ' fa fa-google-plus"';
						elseif ($k == 'live')
							$icon = 'class="' . @$class[1] . ' fa fa-windows"';
						elseif ($k == 'tumblr')
							$icon = 'class="' . @$class[1] . ' fa fa-tumblr"';
						elseif ($k == 'yahoo')
							$icon = 'class="' . @$class[1] . ' fa fa-yahoo"';
						elseif ($k == 'twitter')
							$icon = 'class="' . @$class[1] . ' fa fa-twitter"';
						elseif ($k == 'linkedin')
							$icon = 'class="' . @$class[1] . ' fa fa-linkedin"';
						elseif ($k == 'vk')
							$icon = 'class="' . @$class[1] . ' fa fa-vk"';

						$pattern = "/_(?=[^>]*<)/";

						$custom['label'] = preg_replace($pattern,$icon ,$custom['label']);
						$this->output(str_replace(@$class[0], @$icon, @$custom['label']));
						$print_or = true ;
					}
				}	
				$this->output('</li>');
			}
		?>
		<?php if ($print_or): ?>
			<li>
				<div class="login-or">
		            <hr class="hr-or colorgraph">
		            <span class="span-or">or</span>
		        </div>
			</li>
		<?php endif ?>
		<form role="form" action="<?php echo $this->content['navigation']['user']['login']['url']; ?>" method="post">
			<li>
				<input type="text" class="form-control" id="qa-userid" name="emailhandle" placeholder="<?php echo trim(qa_lang_html('users/email_handle_label'), ':'); ?>" />
			</li>
			
			<li> 
				<input type="password" class="form-control" id="qa-password" name="password" placeholder="<?php echo trim(qa_lang_html('users/password_label'), ':'); ?>" />
			</li>
			<li>
				<label class="checkbox inline">
					<input type="checkbox" name="remember" id="qa-rememberme" value="1"> <?php echo qa_lang_html('users/remember'); ?>
				</label>
			</li>
			<li class="hidden">				
				<input type="hidden" name="code" value="<?php echo qa_html(qa_get_form_security_code('login')); ?>"/>
			</li>
			<li>
				<input type="submit" value="<?php echo $this->content['navigation']['user']['login']['label']; ?>" id="qa-login" name="dologin" class="btn btn-primary btn-block" />
			</li>
			<li class="forgot-password">
				<a href="<?php echo qa_path_html('forgot'); ?>"><?php echo qa_lang_html('users/forgot_link') ?></a>
			</li>
		</form>
	</ul>
</li>
<?php
unset($this->content['navigation']['user']['login']);
unset($this->content['navigation']['user']['register']);
$this->output(ob_get_clean());
