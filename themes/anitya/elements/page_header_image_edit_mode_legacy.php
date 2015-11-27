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

$header_content = new Area('Header Content');
$header_count = $header_content->getTotalBlocksInArea($c);
$display_header_content = $header_count > 0 || $c->isEditMode();

// Si il y a un block (image ou autre) dans l'intro, on laisse le block définir la hauteur
// Sinon elle est définie dans les CSS
$header_image = new Area('Header Image');
$header_image_count = $header_image->getTotalBlocksInArea($c);
?>
<article class="intro <?php  if ($path) : ?>with-image<?php  endif ?>" style="<?php  if ($path) : ?>background-image:url(<?php  echo $path ?>); background-size:cover; <?php  endif ?><?php  if($header_image_count): ?>height:auto; <?php  endif ?><?php  if($is_pattern): ?>background-size:initial; <?php  endif?>">
    <?php
        $a = new Area('Header Image');
        $a->display($c);
    ?>
</article>
<div class="<?php  if ($header_count == 0) echo 'container' ?>">
    <?php
        $header_content->enableGridContainer();
        $header_content->display($c);
    ?>
</div>
