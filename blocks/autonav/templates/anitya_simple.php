<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

$c = Page::getCurrentPage();
$navItems = $controller->getNavItems();
$pageTheme = $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();

foreach ($navItems as $ni) {
	$classes = array();

	if ($ni->isCurrent || $ni->inPath) {
		$classes[] = 'active';
	}
	$ni->icon = $ni->cObj->getAttribute('icon') ? '<i class="fa ' . $ni->cObj->getAttribute('icon') . '"></i>' : '<i class="fa ' . $o->default_nav_block_icon . '"></i> ';
	$ni->classes = implode(" ", $classes);
}
echo '<ul class="nav simple">';
foreach ($navItems as $ni) {
	echo '<li class="' . $ni->classes . '">';
	echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">' . $ni->icon . '&nbsp;&nbsp;' . $ni->name . '</a>';
	if ($ni->hasSubmenu) {
		echo '<ul>';
	} else {
		echo '</li>';
		echo str_repeat('</ul></li>', $ni->subDepth);
	}
}
echo '</ul>';
