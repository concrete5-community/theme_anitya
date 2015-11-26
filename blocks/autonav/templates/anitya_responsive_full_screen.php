<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
	$classes = array();

	if ($ni->isCurrent || $ni->inPath) {
		$classes[] = 'active';
	}
	if ($ni->hasSubmenu) {
		$classes[] = 'has-submenu';
	}
	$ni->classes = implode(" ", $classes);
}

echo '<div class="' . ( $o->auto_hidde_top_bar ? 'auto-hidde-top-bar' : ''). ' small-display-nav-bar-inner Fixed">';
Loader::PackageElement("navigation/mobile", 'theme_anitya', array('o' => $o));
foreach ($navItems as $ni) {

	echo '<li class="' . $ni->classes . '">'; //opens a nav item
	$name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
	echo '<a href="' . $ni->url . '" target="' . $ni->target . '" ' .'>' . $name . '</a>';

	if ($ni->hasSubmenu) {
		echo '<ul class="submenu">'; //opens a dropdown sub-menu
	} else {
		echo '</li>'; //closes a nav item
		 echo str_repeat('</ul></li>', $ni->subDepth);
	}
}

 echo '</ul></nav></div></div>'; //closes the top-level menu
