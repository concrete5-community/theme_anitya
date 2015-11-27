<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
?>
<article class="intro <?php // echo $header_height ? 'image-height-' . $header_height : '' ?>">
    <?php
				$header_image = new Area('Header Image');
        $header_image->display($c);
    ?>
</article>
<div class="<?php  if ($header_count == 0) echo 'container' ?>">
    <?php
				$header_content = new Area('Header Content');
        $header_content->enableGridContainer();
        $header_content->display($c);
    ?>
</div>
