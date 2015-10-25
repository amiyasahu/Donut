<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}
require_once QA_INCLUDE_DIR.'qa-filter-basic.php';
require_once QA_INCLUDE_DIR.'qa-app-upload.php';
require_once QA_PLUGIN_DIR.'extra-question-field/qa-eqf.php';

$qa_extra_question_fields;

class qa_eqf_filter {
	function filter_question(&$question, &$errors, $oldquestion) {
		global $qa_extra_question_fields;
		$qa_extra_question_fields = array();
		$fb = new qa_filter_basic();
		for($key=1; $key<=qa_eqf::FIELD_COUNT_MAX; $key++) {
			if(qa_opt(qa_eqf::FIELD_ACTIVE.$key)) {
				$name = qa_eqf::FIELD_BASE_NAME.$key;
				$extradata = '';
				$checkvalue = '';
				if(qa_opt(qa_eqf::FIELD_TYPE.$key) != qa_eqf::FIELD_TYPE_FILE) {
					$extradata = qa_post_text($name);
					$checkvalue = $extradata;
				} else {
					$extradata = $this->file_info($name);
					if(!empty($extradata))
						$checkvalue = $extradata['name'];
					else {
						$oldextradata = qa_post_text($name.'-old');
						if(!empty($oldextradata))
							$checkvalue = $oldextradata;
					}
				}
				if(qa_opt(qa_eqf::FIELD_REQUIRED.$key)) {
					$fb->validate_length($errors, $name, $checkvalue, 1, QA_DB_MAX_CONTENT_LENGTH);
					if(array_key_exists($name, $errors))
						$qa_extra_question_fields[$name]['error'] = qa_lang_sub(qa_eqf::PLUGIN.'/'.qa_eqf::FIELD_REQUIRED.'_message',qa_opt(qa_eqf::FIELD_PROMPT.$key));
				}
				if(qa_opt(qa_eqf::FIELD_TYPE.$key) == qa_eqf::FIELD_TYPE_FILE) {
					if(!empty($extradata)) {
						$file_info = $this->file_info($name);
						if(is_array($file_info)) {
							$result = qa_upload_file(
								$file_info['tmp_name'],
								$file_info['name'],
								qa_opt(qa_eqf::MAXFILE_SIZE),
								qa_opt(qa_eqf::ONLY_IMAGE),
								qa_opt(qa_eqf::IMAGE_MAXWIDTH),
								qa_opt(qa_eqf::IMAGE_MAXHEIGHT)
								);
							if(isset($result['error']))
								$qa_extra_question_fields[$name]['error'] = $result['error'];
							else
								$extradata = $result['blobid'];
						}
					} else {
						$oldextradata = qa_post_text($name.'-old');
						if(!empty($oldextradata)) {
							if(qa_post_text($name.'-remove'))
								$extradata = '';
							else
								$extradata = $oldextradata;
						}
					}
				}
				if(isset($qa_extra_question_fields[$name]['error']))
					$errors[$name] = $qa_extra_question_fields[$name]['error'];
				else
					$qa_extra_question_fields[$name]['value'] = $extradata;
			}
		}
	}
	function file_info($name) {
		if(array_key_exists($name, $_FILES) && $_FILES[$name]['name'] != '')
			return $_FILES[$name];
		else
			return '';
	}
}
/*
	Omit PHP closing tag to help avoid accidental output
*/