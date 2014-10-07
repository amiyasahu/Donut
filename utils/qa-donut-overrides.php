<?php

	function qa_category_navigation_sub($parentcategories, $parentid, $selecteds, $pathprefix, $showqcount, $pathparams, $favoritemap=null)
/*
	Recursion function used by qa_category_navigation(...) to build hierarchical category menu.
*/
	{
		if (qa_to_override(__FUNCTION__)) { $args=func_get_args(); return qa_call_override(__FUNCTION__, $args); }
		
		$navigation=array();
		
		if (!isset($parentid))
			$navigation['all']=array(
				'url' => qa_path_html($pathprefix, $pathparams),
				'label' => qa_lang_html('main/all_categories'),
				'selected' => !count($selecteds),
				'categoryid' => null,
			);
		
		if (isset($parentcategories[$parentid]))
			foreach ($parentcategories[$parentid] as $category)
				$navigation[qa_html($category['tags'])]=array(
					'url' => qa_path_html($pathprefix.$category['tags'], $pathparams),
					'label' => qa_html($category['title']),
					'popup' => qa_html(@$category['content']),
					'selected' => isset($selecteds[$category['categoryid']]),
					'note' => $showqcount ? (qa_html(number_format($category['qcount']))) : null,
					'subnav' => qa_category_navigation_sub($parentcategories, $category['categoryid'], $selecteds,
						$pathprefix.$category['tags'].'/', $showqcount, $pathparams, $favoritemap),
					'categoryid' => $category['categoryid'],
					'favorited' => @$favoritemap['category'][$category['backpath']],
				);
		
		return $navigation;
	}