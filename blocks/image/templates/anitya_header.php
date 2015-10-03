<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
if ($c->isEditMode()):
  // En Edit mode, si l'utilisateur n'a pas ajouté de classe de hauteur sur le bloc image (image-height-80)
  // Le bloc devient invisible car coincé dans sont parent de Concrete qui est bein petit.
  // Il faut donc lui donner une hauteur minimum (image-height-30)
  // ---
  // Quand il sera en View mode, il sera en position absolue, donc epousera la taille du conteneur (.intro) dont la hauuteur est définie dans les options quelque part :-)
  $pageTheme = $c->getCollectionThemeObject();
  $header_height = $pageTheme->getClassSettings($b,'image-height');
endif;
if (is_object($f)) $url = $f->getVersion()->getUrl();
?>
<div class="ccm-intro-block  <?php echo $header_height ? '' : 'image-height-30' ?>" style=" <?php  if ($url) : ?>background-image:url(<?php  echo $url ?>)<?php  endif?>;"></div>
