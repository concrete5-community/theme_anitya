<?php  defined('C5_EXECUTE') or die("Access Denied.");

if (is_object($f)) :
    $path = $f->getVersion()->getRelativePath();
endif;
$height = $this->controller->maxHeight;
?>
<div class="ccm-intro-block" style=" <?php  if ($path) : ?>background-image:url(<?php  echo $path ?>)<?php  endif?>;<?php  if ($height) : ?>height:<?php  echo $height ?>px<?php  endif ?>"></div>