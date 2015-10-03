<?php  defined('C5_EXECUTE') or die("Access Denied.");
// The attribute handle of the image used for header

$page_header_image_attribute = 'thumbnail';
$img = $c->getAttribute($page_header_image_attribute);
if (is_object($img)) :
	$iv = $img->getVersion();
	$path = $iv->getRelativePath();
	$img_width = $iv->getAttribute('width');
	// We iagine that a image pattern (repeatable) is small than 150px
	$is_pattern = $img_width < 150;
endif;

$video_background = $c->getAttribute('anitya_youtube_backround_url');
$full_height = $c->getAttribute('anitya_full_height_header');


$header_content = new Area('Header Content');
$header_count = $header_content->getTotalBlocksInArea($c);
$display_header_content = $header_count > 0 || $c->isEditMode();

// Si il y a un block (image ou autre) dans l'intro, on laisse le block définir la hauteur
// Sinon elle est définie dans les CSS
$header_image = new Area('Header Image');
$header_image_count = $header_image->getTotalBlocksInArea($c);

/*
Si 		- Un block est ajouté 							=> Style > height:auto
			- Un attribut est rempli 						=> Class > "with-image"
																					=> Style > background-image:url($path); background-size:cover
																					&& image < 150px 	=> Style > background-size:initial;
			- L'attribut full-height est coché 	=> Class > "full-height"
			- Default 													=> Style > background-size:auto;
*/
?>

<article class="intro <?php  if ($path) : ?>with-image<?php  endif ?> <?php if ($full_height): ?>full-height<?php endif ?>" style="<?php  if ($path) : ?>background-image:url(<?php  echo $path ?>); background-size:cover; <?php  endif ?><?php  if($header_image_count): ?>height:auto; <?php  endif ?><?php  if($is_pattern): ?>background-size:initial; <?php  endif?>">
	<a href="#" class="gotobottom"><i class="fa fa-arrow-circle-o-down"></i></a>
	<?php if ($video_background) : ?><div id="video_header_bg" class="elementPlayer" ><?php endif ?>
    <div id="intro-content" class="<?php  if ($header_count == 0 && $c->isEditMode()) echo 'container' ?>">
        <?php
           	$header_content->enableGridContainer();
            $header_content->display($c);
        ?>
    </div>
    <?php $header_image->display($c) ?>
    <?php if ($video_background) : ?></div><?php endif ?>
</article>
<?php if ($video_background) : ?>
	<a id="mb_YTPlayer" class="player" data-property="{videoURL:'<?php echo $video_background ?>',containment:'#video_header_bg',startAt:0,mute:false,autoPlay:true,loop:true,opacity:1}"></a>
	<?php endif ?>
