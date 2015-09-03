<?php  defined('C5_EXECUTE') or die("Access Denied.");

$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
	$classes = array();

	if ($ni->isCurrent || $ni->inPath) {
		//class for the page currently being viewed
		$classes[] = 'active';
	}



	if ($ni->hasSubmenu && $ni->level == 1) {
		//class for items that have dropdown sub-menus
		$classes[] = 'dropdown-toggle';
	}
	$ni->classes = implode(" ", $classes);
}


//*** Step 2 of 2: Output menu HTML ***/

echo '<ul class="hlist nav">'; //opens the top-level menu

foreach ($navItems as $ni) {

	echo '<li ' . ( $ni->hasSubmenu && $ni->level == 1 ? ' class="dropdown"' : '') . '>'; //opens a nav item
	$name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
	echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '" ' . ( $ni->hasSubmenu && $ni->level == 1 ? '' : '') . '>' . $name . '</a>';

	if ($ni->hasSubmenu) {
		echo '<ul class="' . ($ni->level == 1 ? 'dropdown-menu' : '') . '">'; //opens a dropdown sub-menu
	} else {
		echo '</li>'; //closes a nav item
		 echo str_repeat('</ul></li>', $ni->subDepth);
	}
}

 echo '</ul>'; //closes the top-level menu
