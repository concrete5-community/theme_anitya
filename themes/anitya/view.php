<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/head.php'); 
$this->inc('elements/top_bar.php'); 
$this->inc('elements/page_header_image.php'); 
$this->inc('elements/sub_header.php');  ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php  print $innerContent; ?>
            </div>
        </div>
    </div>
</main>

<?php  
$this->inc('elements/main_footer.php'); 

$this->inc('elements/footer.php');  ?>
