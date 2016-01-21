<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getCurrentPage();
$pageTheme =  $c->getCollectionThemeObject();


echo "\n<!-- Start Multi columns dropdown -->\n";?>
<?php

$layout = $pageTheme->createLayout($navItems, $niKey, true,20);//$o->break_columns_on_child, $o->nav_multicolumns_item_per_column);

$width =  100 / (count($layout)); // Heritage des particularité des colonnes bootstrap // avec une largeur spécifique
?>
<div class="multicolumn-pane absolute-container" style="padding:20px;">
	<div class="row">
<?php
foreach ($layout as $key => $element) :
	echo '<div class="col-sm-1 stack-column" style="width:' . $width . '%">';
	echo '<ul class="mgm-multi-c-column">';
	foreach ($element as $nikey => $ni) :
		echo '<li class="' . $ni->classes . ( $ni->hasSubmenu ? ' mgm-multi-c-title' : '' ) . '">';
		echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">'  . $ni->icon . ' ' . $ni->name . '</a>';
		echo '</li>'; //closes a nav item
	endforeach;
	echo '</ul></div> <!-- .mgm-multi-c-column -->';
endforeach?>
	</div><!-- row -->
</div><!-- stack-pane -->
<?php
 ?>
