<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
	$classes = array();

	if ($ni->isCurrent) {
		//class for the page currently being viewed
		$classes[] = 'Selected';
	}

	if ($ni->inPath) {
		//class for parent items of the page currently being viewed
		$classes[] = 'Selected';
	}

	$ni->icon = ($ni->cObj->getAttribute('icon') && $o->mmenu_display_icon) ? '<i class="fa ' . $ni->cObj->getAttribute('icon') . '"></i>' : '';

	$ni->classes = implode(" ", $classes);
}
// Global Logo
echo '<div class="' . ( $o->auto_hidde_top_bar ? 'auto-hidde-top-bar' : '') . ' small-display-nav-bar-inner Fixed">';
Loader::PackageElement("navigation/mobile", 'theme_anitya', array('o' => $o));
echo '</div>';

if (count($navItems) > 0) :
	echo '<nav id="mmenu">';
    echo '<ul class="">'; //opens the top-level menu

    foreach ($navItems as $ni) {

        echo '<li class="' . $ni->classes . '">'; //opens a nav item
        echo '<a href="' . $ni->url . '" target="' . $ni->target . '">' .  $ni->icon . ' ' . $ni->name . '</a>';

        if ($ni->hasSubmenu) {
            echo '<ul>'; //opens a dropdown sub-menu
        } else {
            echo '</li>'; //closes a nav item
            echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
        }
    }

    echo '</ul>';
	echo '</nav>';
elseif (is_object($c) && $c->isEditMode()) : ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Auto-Nav Block.')?></div>
<?php endif;
