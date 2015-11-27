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
        $ax->disableControls(); ?>
        <a href="#stack-all-popup-<?php echo $bID?>" class="btn btn-primary <?php echo $o->popup_button_type ?> <?php echo $o->popup_button_color ?> mpf-inline open-popup-link"><?php echo $stack->getStackName() ?></a>
        <div class='white-popup mfp-hide' id="stack-all-popup-<?php echo $bID?>">
		<?php echo $ax->display($stack) ?>
		</div>
		<?php
	}
}
