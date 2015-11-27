<?php  defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$styleObject = $pageTheme->getClassSettingsObject($b);

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
<div class="img-background" style=" <?php  if ($path) : ?>background-image:url(<?php  echo $path ?>)<?php  endif?>;">
</div>
