<?php
defined('C5_EXECUTE') or die("Access Denied.");
if (!$c->isPopup) :
	$this->inc('elements/head.php',array('noNavigation'=>true));
endif;
?>

<main class="full <?php echo !$c->isPopup ? 'no-script' : ''?>">
	<?php
	$a = new Area('Simple Content');
	if (!$c->isPopup) $a->enableGridContainer();
	$a->display($c);
	 ?>

</main>
<?php if (!$c->isPopup)	: $this->inc('elements/footer_bottom.php'); ?>
	<style media="screen">
		div.an {overflow: visible}
	</style>
<?php endif?>
