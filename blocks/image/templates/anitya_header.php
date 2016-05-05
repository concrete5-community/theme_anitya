<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$styleObject = $pageTheme->getClassSettingsObject($b);

if ($c->isEditMode()):
  // En Edit mode, si l'utilisateur n'a pas ajouté de classe de hauteur sur le bloc image (image-height-80)
  // Le bloc devient invisible car coincé dans sont parent de Concrete qui est bien petit.
  // Il faut donc lui donner une hauteur minimum (image-height-30)
  // ---
  // Quand il sera en View mode, il sera en position absolue, donc epousera la taille du conteneur (.intro) dont la hauuteur est définie dans les options quelque part :-)
  $pageTheme = $c->getCollectionThemeObject();
  $header_height = $pageTheme->getClassSettingsPrefixInt($b,'image-height');
endif;
if (is_object($f)) :
	$fv = $f->getVersion();
    $path = $fv->getRelativePath();
    if ($styleObject->displayTitle) :
	    $title = $title ? $title : $f->getTitle();
	    $desc = $altText ? $altText : $f->getDescription();
    else :
      $title = $desc = false;
	endif;
endif;
?>
<div class="ccm-intro-block image-wrapper <?php echo $header_height ? '' : 'image-height-30' ?>" style=" <?php  if ($path) : ?>background-image:url(<?php  echo $path ?>)<?php  endif?>;">
  <div class="container vertical-align">
		<?php if($title) : ?><h1 class="underline"><?php echo $title ?></h1><?php endif ?>
		<?php if($desc) : ?><h3><?php echo $desc ?></h3><?php endif ?>
	</div>
</div>
