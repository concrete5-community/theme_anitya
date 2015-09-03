<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// -- Include different elements of the page -- \\

$this->inc('elements/head.php'); 
$this->inc('elements/top_bar.php'); 
$this->inc('elements/page_header_image.php'); 
$this->inc('elements/sub_header.php'); 

?>

<main class="full main-container">
	<?php  $this->inc('elements/multiple_area.php',array('c'=>$c,'area_name'=>'Main','attribute_handle'=>'number_of_main_areas'));  ?>		
</main>


<?php  
//$this->inc('elements/main_footer.php'); 

$this->inc('elements/footer.php'); 