<?php   defined('C5_EXECUTE') or die("Access Denied.");
$f = \File::getByID($fID);
if( is_object($f))
    $img = Core::make('html/image', array($f, true));
?>
<div class="curtain">
  <figure>
    <?php  if (is_object($img)): ?>
        <?php echo $img->getTag() ?>
      <?php else: ?>
        <div class="placeholder"></div>
    <?php  endif; ?>
  <figcaption>
    <h5><?php  echo $name?></h5>
    <?php  if ($paragraph): ?>
        <h6 class="box-arrow framed desc"><?php  echo $paragraph?></h6>
    <?php  endif; ?>
    <?php  if ($position && $company && $companyURL): ?>
        <div class="position">
            <?php  echo t('<p>%s</p><p><a href="%s">%s</a></p>', $position, $companyURL, $company)?>
        </div>
    <?php  endif; ?>

    <?php  if ($position && $company && !$companyURL): ?>
        <div class="position">
            <?php  echo t('<p>%s</p><p>%s</p>', $position, $company)?>
        </div>
    <?php  endif; ?>

    <?php  if ($position && !$company && !$companyURL): ?>
        <div class="position">
            <p><?php  echo $position?></p>
        </div>
    <?php  endif; ?>
  </figcaption>
</figure>
</div>
