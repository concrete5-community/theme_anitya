<?php
defined('C5_EXECUTE') or die("Access Denied.");

// -- Create some Area where blocks need to be counted -- \\

$intro = new Area('Intro');
$display_intro = $intro->getTotalBlocksInArea($c) > 0 || $c->isEditMode();

// -- Include different elements of the page -- \\

$this->inc('elements/head.php');
$this->inc('elements/top_bar.php');
$this->inc('elements/page_header_image.php');
$this->inc('elements/sub_header.php');
?>
<main class="container main-container">
    <div class="row">
        <div class="col-md-8">
            <?php  if ($display_intro) : ?>
            <div id="main-lead">
                <?php
                $intro->setAreaGridMaximumColumns(12);
                $intro->display($c);
                ?>
            </div>
            <?php  endif ?>
            <?php $this->inc('elements/multiple_area.php',array('c'=>$c,'area_name'=>'Main','AreaGridMaximumColumns' => 12, 'attribute_handle'=>'number_of_main_areas'));  ?>
        </div>
        <div class="col-md-4 right-sidebar" id="sidebar">
            <div id="sb-header">
                <?php
                $a = new Area('Sidebar');
                $a->display($c);
                ?>

            </div>
            <div class="sb-footer">
                <?php
                $a = new Area('Sidebar Footer');
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</main>
<?php   $this->inc('elements/main_footer.php'); ?>
<?php   $this->inc('elements/footer.php'); ?>
