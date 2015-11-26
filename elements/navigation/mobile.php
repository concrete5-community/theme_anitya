<?php defined('C5_EXECUTE') or die("Access Denied.");


if($o->display_logo_mobile_nav) $logo = Stack::getByName('Site Logo');
if ($logo):
	echo '<span class="nav-logo">';
	$logo->display();
	echo '</span>';
endif;
echo '<a id="hamburger-icon" href="#mmenu" title="Menu">
				<span class="line line-1"></span>
	  		<span class="line line-2"></span>
	  		<span class="line line-3"></span>
		</a>';
		if($o->display_searchbox && $o->display_responsive_searchbox) :
				$p = Page::getByID($o->display_searchbox);
				if (is_object($p)) :
					echo '<div class="searchbox">';
						echo '<form action="' . Loader::helper('navigation')->getCollectionURL($p) . '">';
							echo '<input type="search" class="vertical-align" name="query" placeholder="' . t('Search') . '"/>';
						echo '</form>';
					echo '</div>';
			endif;
		endif;
