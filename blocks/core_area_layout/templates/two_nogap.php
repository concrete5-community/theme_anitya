<?php defined('C5_EXECUTE') or die("Access Denied.");
$pageTheme = $c->getCollectionThemeObject();
$classes = $pageTheme->getClassSettingsString($b);
$classesArray = explode(' ',$classes);
$imageSide = in_array('image-on-right',$classesArray) ? 'right' : 'left';
$image = $pageTheme->getCustomStyleImage($b);
$columnPercent = $pageTheme->getClassSettingsPrefixInt($b,'left-column');
$columnPercent = $columnPercent ? $columnPercent : 50;
?>
<div class="two_nogap <?php echo $classes?>" id="two-nogap-<?php echo $bID?>">
  <div class="container">
    <div class="row <?php echo $classes?>">
        <?php foreach ($columns as $column) echo $column->getColumnHtmlObject() ?>
    </div>
  </div>
</div>

<style media="screen">
  #two-nogap-<?php echo $bID?>::before {
    right:<?php echo 100 - $columnPercent ?>%;
    <?php if ($image && $imageSide == 'left') : ?>
    background-image: url('<?php echo $image->getURL() ?>');
    <?php endif ?>
  }
  #two-nogap-<?php echo $bID?>::after {
    left:<?php echo $columnPercent ?>%;
    <?php if ($image && $imageSide == 'right') : ?>
    background-image: url('<?php echo $image->getURL() ?>');
    <?php endif ?>
  }
@media (max-width: 768px) {
  #two-nogap-<?php echo $bID?> [class*='col-']:first-child  {
    <?php if ($image && $imageSide == 'left') : ?>
    background-image: url('<?php echo $image->getURL() ?>');
    <?php endif ?>
  }
  #two-nogap-<?php echo $bID?> [class*='col-']:last-child  {
    <?php if ($image && $imageSide == 'right') : ?>
    background-image: url('<?php echo $image->getURL() ?>');
    <?php endif ?>
  }
}
</style>
