<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
$pageTheme =  $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
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
		$blocks = $ax->getAreaBlocksArray();
	}
}
if (is_array($blocks) && count($blocks)): ?>
<div class="sm-stack-popup">
	<?php foreach ($blocks as $key => $block) :
	$bv = new Concrete\Core\Block\View\BlockView($block); ?>
	<a href="#stack-popup-<?php echo $key?>" class="btn btn-primary <?php echo $o->popup_button_type . ' ' . $o->popup_button_color ?> mpf-inline open-popup-link"><?php echo $block->getBlockName() ? $block->getBlockName() : t('Title ') . $key ?></a>
	<div class='white-popup mfp-hide' id="stack-popup-<?php echo $key?>"><?php echo $bv->render('view') ?></div>
	<?php endforeach ?>
</div>
<?php endif ?>
