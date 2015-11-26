<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
$navItems = $controller->getNavItems();

echo '<div class="' . ( $o->auto_hidde_top_bar ? 'auto-hidde-top-bar' : ''). ' small-display-nav-bar-inner Fixed">';
Loader::PackageElement("navigation/mobile", 'theme_anitya', array('o' => $o));

		if (count($navItems) > 0) :
			echo '<nav class="nav-collapse">';
		  echo '<ul id="page-navigator-'.$bID.'">';
		    foreach ($navItems as $ni) :
		      echo '<li class="nav-item">'?>
		        <a href="#<?php echo $ni->ID?>"><?php echo $ni->name?></a>
		      <?php echo '</li>';
		    endforeach;
		  echo '</ul>';
			echo '</nav>';
		elseif (is_object($c) && $c->isEditMode()) : ?>
		    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Auto-Nav Block.')?></div>
		<?php endif;
echo '</div>';



if (count($navItems)) : ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#page-navigator-<?php echo $bID ?>').onePageNav({
      currentClass: 'active',
      scrollSpeed: 750,
      scrollThreshold: 0.5,
      easing: 'swing',
      offset: 120
  });
	var nav = responsiveNav(".nav-collapse",{
		customToggle:"#hamburger-icon",
		close: function(){
			console.log("close");
			$("#hamburger-icon").removeClass('active');
		}
	});
	$(".nav-collapse a").click(function(e){
		nav.close();
	})
})
</script>
<?php else : ?>
  <div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
    <p  style="line-height:30px; margin:0; color:#999 !important"><?php echo t('No Sections to display, please add a "Page Section" block on this page') ?></p>
	</div>
<?php endif ?>
