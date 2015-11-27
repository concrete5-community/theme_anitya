<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
	</div><!-- .an -->
</div><!-- ccm-wrapper -->
<?php  $this->inc('elements/backstretch.php') ?>
<?php  Loader::element('footer_required');
$c = Page::getCurrentPage();
$pagetheme =  $c->getCollectionThemeObject();
$o = $pagetheme->getoptions();

?>
<script type="text/javascript">
var mmenuSettings = {
	<?php if($o->display_searchbox && false) :	$searchPage = Page::getByID($o->display_searchbox);	if (is_object($searchPage)) : $searchURL = URL::to($searchPage); ?>
	searchfield:{
			add: true,
			search: false
	},
	<?php endif; endif ?>
	 extensions: <?php echo '["theme-' . ($o->mmenu_theme ? $o->mmenu_theme : 'light') .'"';
							 echo $o->mmenu_shadow ? ',"pageshadow"' : '';
							 echo $o->mmenu_iconbar ? ',"iconbar"' : '';
							 echo '],'
							 ?>offCanvas: {position:"<?php echo $o->mmenu_position ? $o->mmenu_position : 'left'?>"}
							<?php echo ($o->mmenu_position == 'bottom' OR $o->mmenu_position == 'top') ? ',autoHeight: true' : ''?>
	};
var themeConfig = {autoHiddeTopBar:<?php echo $o->auto_hidde_top_bar ? 'true' : 'false'; ?>}
var THEME_PATH = '<?php  echo $this->getThemePath()?>';
var FONT_DETAILS_TOOLS_URL = "<?php echo URL::to('/ThemeAnitya/tools/font_details'); ?>";
</script>
</body>
</html>
