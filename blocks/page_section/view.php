<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getCurrentPage();
if( $c->isEditMode()) :
?>
<div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
  <p  style="line-height:30px; margin:0; color:#999 !important"><?php echo t('Sections name : ') . '<strong>' .  $options->name ?></strong></p>
</div>
<?php else : ?>
<div id="<?php echo $options->ID ?>"></div>
<?php endif ?>
