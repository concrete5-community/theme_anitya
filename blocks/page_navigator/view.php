<?php defined('C5_EXECUTE') or die(_("Access Denied."));
if (count($navItems)) : ?>
<div class="regular-top-nav">
  <?php
  echo '<ul class="nav-items" id="page-navigator-'.$bID.'">';
    foreach ($navItems as $ni) :
      echo '<li class="nav-item">'?>
        <a href="#<?php echo $ni->ID?>"><?php echo $ni->name?></a>
      <?php echo '</li>';
    endforeach;
  echo '</ul>';
  ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#page-navigator-<?php echo $bID ?>').onePageNav({
      currentClass: 'active',
      scrollSpeed: 750,
      scrollThreshold: 0.5,
      easing: 'swing',
      offset: 120,
  });
})
</script>
<?php else : ?>
  <div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
    <p  style="line-height:30px; margin:0; color:#999 !important"><?php echo t('No Sections to display, please add a "Page Section" block on this page') ?></p>
	</div>
<?php endif ?>
