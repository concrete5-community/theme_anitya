<?php defined('C5_EXECUTE') or die("Access Denied.");
$pageTheme = $c->getCollectionThemeObject();
$classes = $pageTheme->getClassSettingsString($b);
$image = $pageTheme->getCustomStyleImage($b);
?>

<div class="two_nogap <?php echo $classes?>" id="two-nogap-<?php echo $bID?>">
  <div class="container">
    <div class="row <?php echo $classes?>">
        <?php foreach ($columns as $column) echo $column->getColumnHtmlObject() ?>
    </div>
  </div>
</div>

<style media="screen">
  <?php if ($image) : ?>
  #two-nogap-<?php echo $bID?>::before {
    background-image: url('<?php echo $image->getURL() ?>');
  }
  <?php endif ?>
</style>
