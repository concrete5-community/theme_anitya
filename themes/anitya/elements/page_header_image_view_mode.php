<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$header_height = $pageTheme->getClassSettings($b,'image-height');


// $header_count = $header_content->getTotalBlocksInArea($c);
// $display_header_content = $header_count > 0 || $c->isEditMode();
//
//
// $header_image_count = $header_image->getTotalBlocksInArea($c);
// $display_header_image = $header_image_count > 0 || $c->isEditMode();
?>

<article class="intro <?php  // echo $header_height ? 'image-height-' . $header_height : '' ?> area-primary">
	<a href="#" class="gotobottom"><i class="fa fa-arrow-circle-o-down"></i></a>
	<div id="video_header_bg" class="elementPlayer" ></div>
    <div id="intro-content" class="<?php  if ($header_count == 0 && $c->isEditMode()) echo 'container' ?>  vertical-align">
        <?php
						$header_content = new Area('Header Content');
           	$header_content->enableGridContainer();
            $header_content->display($c);
        ?>
    </div>
    <?php
			$header_image = new Area('Header Image');
			$header_image->display($c)
			?>
</article>
