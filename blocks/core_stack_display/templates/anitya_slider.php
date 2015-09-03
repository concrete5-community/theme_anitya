<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Block\View\BlockView;

$c = Page::getCurrentPage();
$cp = new Permissions($c);
if ($cp->canViewPageVersions()) {
	$stack = Stack::getByID($stID);	
} else {
	$stack = Stack::getByID($stID, 'ACTIVE');
}
if (is_object($stack)) { 
	$ax = Area::get($stack, STACKS_AREA_NAME);
	$axp = new Permissions($ax);
	if ($axp->canRead()) {
        $ax->disableControls();
		//$ax->display($stack);
		$blocks = $ax->getAreaBlocksArray();
	}
}
if (is_array($blocks) && count($blocks)):

// Flickity options :
	$flickity = new StdClass();
	$flickity->accessibility = true;
	$flickity->autoPlay = 4000;
	// $flickity->freeScrollFriction = 0.075, friction when free-scrollin;
	// $flickity->friction = 0.28, friction when selectin;
	$flickity->cellAlign = 'center';
	// $flickity->cellSelector = undefined;
	// $flickity->contain = false;
	$flickity->draggable = true;
	// $flickity->initialIndex = 0;
	// $flickity->imagesLoaded = false;
	$flickity->percentPosition = true;
	$flickity->pageDots = true;
	$flickity->prevNextButtons = false;
	$flickity->resizeBound = true;
	// $flickity->watcCSS = false;
	$flickity->wrapAround = true;
	$flickity->selectedAttraction = 0.025;
	$flickity->leftArrowText = '<';
	$flickity->rightArrowText = '>';	
?>

<div class="gallery js-flickity stack-1-slide" id="flickity-<?php echo $bID ?>"  data-flickity-options='<?php echo json_encode($flickity) ?>' >
	<?php foreach ($blocks as $key => $block) :
			$bv = new BlockView($block);
			?>
		<div class="gallery-cell">
			<?php echo $bv->render('view') ?>
		</div>
	<?php endforeach ?>
</div>
<?php endif ?>
