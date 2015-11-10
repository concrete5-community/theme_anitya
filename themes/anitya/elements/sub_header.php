<?php  defined('C5_EXECUTE') or die("Access Denied.");

$page_header = $c->getArea('Page Header');
$sub_header = new Area('Sub Header');
$display_page_header = (is_object($page_header) ? ($page_header->getTotalBlocksInAreaEditMode() > 0) : 0) || $c->isEditMode();
$display_sub_header = $sub_header->getTotalBlocksInArea($c) > 0 || $c->isEditMode();

$page_header = is_object($page_header) ? $page_header : new Area('Page Header');
?>
<?php  if ($display_page_header) : ?>
<section id="sub-header-1" class="area-space-s">
    <?php
    $page_header->enableGridContainer();
    $page_header->display($c);
    ?>
</section>
<?php  endif ?>
<?php  if ($display_sub_header) : ?>
<section id="sub-header-2" class="area-primary">
    <?php
    $sub_header->enableGridContainer();
    $sub_header->display($c);
    ?>
</section>
<?php  endif ?>
