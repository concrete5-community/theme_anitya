<?php   defined('C5_EXECUTE') or die("Access Denied.");
$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');
$f = \File::getByID($fID);
if($type != NULL && is_object($f))
    $thumbnailUrl = $f->getThumbnailURL($type->getBaseVersion());
?>
<div class="tm-wrapper tm-small">
    <?php  if ($paragraph): ?>
        <div class="box-arrow framed desc"><?php  echo $paragraph?></div>
    <?php  endif; ?>



    <div class="details clearfix">
        <?php  if ($thumbnailUrl): ?>
            <div class="image" style="background-image:url('<?php echo $thumbnailUrl ?>')"></div>
        <?php  endif; ?>
        <div class="infos">
            <h5><?php  echo $name?></h5>
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
        </div>
    </div>
</div>
