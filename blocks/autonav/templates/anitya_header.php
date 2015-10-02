<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

// Cette requete peut prendre plus d'une demi seconde !
$navItems = $controller->getNavItems();
$c = Page::getCurrentPage();
$time_start = microtime(true);
$prepare_start = microtime(true);
$i = 0;
// Les options
$o = \Concrete\Package\ThemeAnitya\Src\Models\MclOptions::get();
$pagetheme =  $c->getCollectionThemeObject();

$navigationStyle = 'regular-top-nav';

// Pour les stacks
$c = Page::getCurrentPage();
$cp = new Permissions($c);
$canViewVersion = $cp->canViewPageVersions() ? 'ACTIVE' : null;

foreach ($navItems as $navItem) {
	if ($navItem->level == 1) :
		$cIDinLevel1[] = $navItem->cID;
		$l1 = $navItem->cID;
		$navItem->childrens = $navItem->cObj->getCollectionChildrenArray();
	elseif ($navItem->level == 2 ) :
		$l2 = $navItem->cID;
		$n[$l1][$navItem->cID] = array();
		$navItem->childrens = $navItem->cObj->getCollectionChildrenArray();
		$subNavItems[$navItem->cID] = $navItem;
	elseif ($navItem->level == 3 ) :
		$n[$l1][$l2][$navItem->cID] = array();
		$subsubNavItems[$navItem->cID] = $navItem;
	endif;
	$nObj[$navItem->cID] = $navItem;
}

// On commence La recherche de classes et de stacks
foreach ($navItems as $niKey => $ni) :

	$classes = array();
	$style = array();
	$col_width = 230;

	if ($ni->cObj->getAttribute('main_page_color'))
		$style[] = 'border-bottom-color:' . $ni->cObj->getAttribute('main_page_color');

	if ($ni->isCurrent || $ni->inPath)
		$classes[] = 'active';

	$ni->icon = ($ni->cObj->getAttribute('icon') && $o->first_level_nav_icon) ? '<i class="fa ' . $ni->cObj->getAttribute('icon') . '"></i>' : '';

	if ($ni->hasSubmenu) {
		$classes[] = 'has-submenu';
	}

	/* ---- STACKS -------
	 * On teste si il y a un stack *
	 * Le stack doit etre nomé de la manière suivante *
	 * mega_menu_{cID} ou mega_menu_{page-handle}
	 */

	if ($ni->level == 1) :
		// Maintenant on va voir si il y a des bloc autorisé dans un stack relatif.
		// Si oui on les definis dans $ni->blocks
		// On essaie avec le nom
		$relatedStack = Stack::getByName('mega_menu_' . $ni->cObj->getCollectionHandle(), 'RECENT');
		if (!$relatedStack) $relatedStack = Stack::getByName('mega_menu_' . $ni->cObj->getCollectionID(), 'RECENT');
		if ($relatedStack) :
			$ax = Area::get($relatedStack, STACKS_AREA_NAME);
			$axp = new Permissions($ax);
			if ($axp->canRead()) {
		        $ax->disableControls();
				$ni->blocks  = $ax->getAreaBlocksArray();
			}
		endif;

		// Maintenant on va déterminer les classes pour le dropdown
		if($ni->cObj->getAttribute('display_multi_columns_drop') || count($ni->blocks))
			$classes[] = 'mgm-drop mgm-full-width';
		elseif ($ni->hasSubmenu)
			$classes[]  = 'mgm-drop mgm-levels';
		else
			$classes[] = 'mgm-drop';

		// Si le style de nav est large-top-nav on divise la largeur par le nombre d'items
		if ($navigationStyle == 'large-top-nav')
			$style[] = 'width:' . 100 / count($cIDinLevel1) . '%';

	endif;
	$ni->classes = implode(" ", $classes);
	$ni->style = implode(";", $style);
endforeach;

foreach ($navItems as $niKey => $ni) :
	// On regarde si un stack à été prévu en temps que sous menu.
	if ($ni->blocks) :
		ob_start();
		Loader::PackageElement("navigation/stack", 'theme_anitya', array(
			'ni' => $ni,
			'o' => $o,
			'classes' => 'absolute-container'
		));
		$ni->sub = ob_get_clean();
	// On charge le template 'drop'
	elseif ($ni->hasSubmenu && $ni->level == 1) :
		$options = array(
				'navItems'=> $navItems,
				'niKey' => $niKey,
				'o' => $o
				);
		ob_start();
		if(!$ni->cObj->getAttribute('display_multi_columns_drop'))
			Loader::PackageElement("navigation/drop", 'theme_anitya', $options);
		else
			Loader::PackageElement("navigation/dropMultiColumns", 'theme_anitya', $options);
		$ni->sub = ob_get_clean();
	endif;

endforeach;
?>
<div class="top_nav_mega-menu <?php echo $navigationStyle . ' ' . ($o->wide_navbar_fixed ? 'navbar-fixed' : '') . ($o->wide_navbar_colapse ? 'navbar-colapse' : '') ?>">
	<?php if ($o->wide_navbar_contained && $o->navigation_style == 'large-top-nav'): ?><div class="container"><?php endif ?>
	<ul class="mega-menu" >
<?php
foreach ($navItems as $k=>$ni) :

	if($ni->level != 1 ) continue;

	echo '<li class="' . $ni->classes . '" style="' . $ni->style . '">'; //opens a nav item
	echo '<a href="' .   $ni->url . '" target="' . $ni->target . '">' . $ni->icon . ' ' . $ni->name . '</a>';

	if($ni->sub) echo $ni->sub;

	echo '</li>';

	// Si le menu est selectionnŽ ou un de ses enfant
	if ($ni->isCurrent || $ni->inPath) {
		// On recupere lequel est selectionne ou enfant
		$selected_item_index = $i;
	}
	$i ++;

endforeach;

if($o->display_searchbox) :
	$p = Page::getByID($o->display_searchbox);
	if (is_object($p)) :

	echo '<li class="search-in-nav">';
	?>
	<form action="<?php  echo  Loader::helper('navigation')->getCollectionURL($p)?>" id="expand-search">
   	   <input type="search" class="vertical-align" id="search-keywords" name="query" placeholder="&#xf002"/>
	</form>
	</li>
	<?php endif ?>
<?php endif ?>
	</ul>
<?php if ($o->wide_navbar_contained && $o->navigation_style == 'large-top-nav'): ?></div><!-- container --><?php endif ?>
</div><!-- .top_nav_mega-menu -->
