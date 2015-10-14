<?php
defined('C5_EXECUTE') or die("Access Denied.");
if (!$c->isPopup) :
	$this->inc('elements/head.php');
endif;
//$this->inc('elements/top_bar.php');
//$this->inc('elements/page_header_image.php');
//$this->inc('elements/sub_header.php');
?>

<main class="full <?php echo !$c->isPopup ? 'no-script' : ''?>">
	<?php
	$a = new Area('Main');
	if (!$c->isPopup) $a->enableGridContainer();
	$a->display($c);
	 ?>
	<?php  // $this->inc('elements/multiple_area.php',array('c'=>$c,'area_name'=>'Main','attribute_handle'=>'number_of_main_areas'));  ?>
</main>


<?php
if (!$c->isPopup) :
	$this->inc('elements/footer_bottom.php');
endif;
