<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// -- Create some Area where blocks need to be counted -- \\

$main = new Area('Main');
$main_count = $main->getTotalBlocksInArea($c);

// -- Include different elements of the page -- \\

$this->inc('elements/head.php'); 
$this->inc('elements/top_bar.php'); 
$this->inc('elements/page_header_image.php'); 
$this->inc('elements/sub_header.php'); 

?>

<?php  if ($c->isEditMode() || $main_count ) :?>
<main class="container full-wrapped main-container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php  
				$main->setAreaGridMaximumColumns(12);
				$main->display($c);
			?>			
		</div>
	</div>
</main>
<?php  endif ?>


<?php  
$this->inc('elements/main_footer.php'); 

$this->inc('elements/footer.php'); 
?>
