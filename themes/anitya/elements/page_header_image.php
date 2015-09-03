<?php  defined('C5_EXECUTE') or die("Access Denied.");

if ( $c->isEditMode()) :
	$this->inc('elements/page_header_image_edit_mode.php');
else :
	$this->inc('elements/page_header_image_view_mode.php');
endif;
