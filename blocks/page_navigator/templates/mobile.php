<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
$navItems = $controller->getNavItems();
// Global Logo
if($o->display_logo_mobile_nav) $logo = Stack::getByName('Site Logo');
echo '<div class="small-display-nav-bar-inner Fixed">';
if ($logo):
	echo '<span class="nav-logo">';
	$logo->display();
	echo '</span>';
endif;
echo '<a id="hamburger-icon" href="#mmenu" title="Menu">
				<span class="line line-1"></span>
	  		<span class="line line-2"></span>
	  		<span class="line line-3"></span>
		</a>';
		if($o->display_searchbox && $o->display_responsive_searchbox) :
				$p = Page::getByID($o->display_searchbox);
				if (is_object($p)) :
					echo '<div class="searchbox">';
						echo '<form action="' . Loader::helper('navigation')->getCollectionURL($p) . '">';
							echo '<input type="search" class="vertical-align" name="query" placeholder="' . t('Search') . '"/>';
						echo '</form>';
					echo '</div>';
			endif;
		endif;
echo '</div>';

if (count($navItems) > 0) :
	echo '<nav>';
  echo '<ul class="nav-items" id="page-navigator-'.$bID.'">';
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
})
</script>
<?php else : ?>
  <div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
    <p  style="line-height:30px; margin:0; color:#999 !important"><?php echo t('No Sections to display, please add a "Page Section" block on this page') ?></p>
	</div>
<?php endif ?>
