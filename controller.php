<?php

namespace Concrete\Package\ThemeAnitya;

use PageTemplate;
use PageTheme;
use Asset;
use AssetList;
use Package;
use Page;
use BlockType;
use SinglePage;
use Loader;
use Route;
use Events;
use URL;
use Core;
use Concrete\Core\Editor\Plugin;
use PageType;
use FileImporter;
use Concrete\Core\Backup\ContentImporter;
use FileList;
use PageList;
use StackList;
use Config;
use Database;
use Concrete\Core\StyleCustomizer\Style\ValueList;
use Concrete\Core\Package\ContentSwapper;

use Concrete\Package\ThemeAnitya\Src\Helper\MclInstaller;
use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Concrete\Package\ThemeAnitya\Controller\Tools\PresetColors;


defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_anitya';
	protected $themeHandle = 'anitya';
	protected $appVersionRequired = '5.8';
	protected $pkgVersion = '2.2';
	protected $pkg;
	protected $pkgAllowsFullContentSwap = true;
	public $startingPoint;


	public function getPackageDescription() {
		return t("Anitya responsive suit any kind of website.");
	}

	public function getPackageName() {
		return t("Anitya Theme");
	}

	public function install($data = array()) {

		$this->startingPoint = $data['spHandle'];

    if ($data['pkgDoFullContentSwap'] === '1' && $this->startingPoint === '0')
        throw new \Exception(t('You must choose a Starting point to Swap all content'));

	// Get the package object
		$this->pkg = parent::install();

	// Theme options
		$o = new MclOptions($c);
		$o->install_db($data['spHandle']);

	// Setting up the editor clips
		$plugins = Config::get('concrete.editor.plugins.selected');
		$p = is_array($plugins) ? $plugins : array();
		$plugins = array_unique(array_merge(array('themefontcolor','themeclips'),$p));
		Config::save('concrete.editor.plugins.selected', $plugins);

	// Installing minimal config
		$this->installOrUpgrade();

	}
	public function upgrade () {
		parent::upgrade();
		$this->pkg = $this;
		$this->installOrUpgrade();

		// Theme options
		$o = new MclOptions($c);
		$o->update_db();
	}

	private function installOrUpgrade($data = array()) {

		$ci = new MclInstaller($this->pkg);
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/themes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/attributes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/blocktypes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/single_page.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/systemcontenteditorsnippets.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_templates.xml');

		if (!isset($data['pkgDoFullContentSwap']) || $data['pkgDoFullContentSwap'] === '0') :
			$ci->importContentFile($this->getPackagePath() . '/config/install/base/pages.xml');
			if (!is_object(PageType::getByHandle('ui_content')))
				$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_type_ui_content.xml');
			if (!is_object(PageType::getByHandle('mega_menu_content')))
				$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_type_mega_menu_content.xml');
		endif;
	}

	public function uninstall() {
	      parent::uninstall();
	      $db = Loader::db();
	      $db->execute("DROP TABLE AnityaOptions, AnityaOptionsPreset");
	}
	public function on_start() {
			$this->registerRoutes();
			$this->registerAssets();
			$this->registerEvents();
	}
	public function registerAssets () {
 		$al = AssetList::getInstance();
 		$al->register( 'javascript', 'masonry', 'js/build/jquery.masonry.min.js', array('version' => '2.1.08'), $this );
 		$al->register( 'javascript', 'imageloaded', 'js/build/imageloaded.js', array('version' => '3.1.8'), $this );
		$al->register( 'javascript', 'isotope', 'js/build/isotope.pkgd.min.js', array('version' => '2.1.1'), $this );
		$al->register( 'javascript', 'element-masonry', 'js/build/element-masonry.js', array('version' => '1'), $this );
 		$al->register( 'javascript', 'scrollmonitor', 'js/build/scrollmonitor.js', array('version' => '1.0.1'), $this );
 		$al->register( 'javascript', 'rcrumbs', 'js/build/jquery.rcrumbs.min.js', array('version' => '1.1'), $this );
 		$al->register( 'javascript', 'anitya.script', 'js/build/script.js', array('version' => '0.1'), $this );
 		$al->register( 'javascript', 'breakpoint', 'js/build/breakpoint.js', array('version' => '1.0'), $this );
 		$al->register( 'javascript', 'nprogress', 'js/build/nprogress.js', array('version' => '0.1.6'), $this );
 		$al->register( 'javascript', 'YTPlayer', 'js/build/jquery.mb.YTPlayer.min.js', array('version' => '2.7.5'), $this );
		$al->register( 'javascript', 'jquery-ui/accordion', 'js/build/jquery-ui-accordion.js', array('version' => '1.11.2'), $this );
		$al->register( 'javascript', 'slick', 'js/build/slick.min.js', array('version' => '1.3.15'), $this );
		$al->register( 'javascript', 'stellar', 'js/build/jquery.stellar.min.js', array('version' => '0.6.2'), $this );
		$al->register( 'javascript', 'autohidingnavbar', 'js/build/jquery.autohidingnavbar.js', array('version' => '0.1.6'), $this );
		$al->register( 'javascript', 'mmenu', 'js/build/jquery.mmenu.min.all.js', array('version' => '5.4.2'), $this );
		$al->register( 'javascript', 'wow', 'js/build/wow.js', array('version' => '1.1.2'), $this );
		$al->register( 'javascript', 'enquire', 'js/build/enquire.js', array('version' => '2.1.2'), $this );

 		$al->register( 'css', 'YTPlayer', 'themes/anitya/css/addons/YTPlayer.css', array('version' => '2.7.5'), $this );
		$al->register( 'css', 'slick', 'themes/anitya/css/addons/slick.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'slick-theme', 'themes/anitya/css/addons/slick-theme.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'bootsrap-custom', 'themes/anitya/css/addons/bootstrap.custom.min.css', array('version' => '3.3.4'), $this );
		$al->register( 'css', 'megamenu', 'themes/anitya/css/addons/mega-menu.css', array('version' => '1'), $this );
		$al->register( 'css', 'mmenu', 'themes/anitya/css/addons/jquery.mmenu.all.css', array('version' => '5.4.2'), $this );
		$al->register( 'css', 'animate', 'themes/anitya/css/addons/animate.css', array('version' => '1'), $this );


// -- Redactor Plugins -- \\

    $pluginManager = Core::make('editor')->getPluginManager();
// ThemeFont plugin
    $al->register('javascript', 'editor/plugin/themefontcolor', 'js/editor/themefontcolor.js', array(), $this);
    $al->register('css', 'editor/plugin/themefontcolor', 'css/editor/themefontcolor.css', array(), $this);
    $al->registerGroup('editor/plugin/themefontcolor', array(
        array('javascript', 'editor/plugin/themefontcolor'),
        array('css', 'editor/plugin/themefontcolor')
        ));

    $plugin = new Plugin();
    $plugin->setKey('themefontcolor');
    $plugin->setName('Font colors from Anitya');
    $plugin->requireAsset('editor/plugin/themefontcolor');

    $pluginManager->register($plugin);
// themClips plugin
    $al->register('javascript', 'editor/plugin/themeclips', 'js/editor/themeclips.js', array(), $this);
    $al->register( 'javascript', 'chosen-icon', 'js/chosenIcon.jquery.js',  array(), 'theme_anitya' );
    $al->register( 'javascript', 'chosen.jquery.min', 'js/chosen.jquery.min.js',  array(), 'theme_anitya' );
    $al->register( 'css', 'chosenicon', 'css/chosenicon.css',  array(), 'theme_anitya' );
    $al->register( 'css', 'chosen.min', 'css/chosen.min.css', array(), 'theme_anitya' );

    $al->registerGroup('editor/plugin/themeclips', array(
        array('javascript', 'editor/plugin/themeclips'),
        array('javascript', 'chosen-icon'),
        array('javascript', 'chosen.jquery.min'),
        array('css', 'chosen.min'),
        array('css', 'chosenicon')
        ));

    $plugin = new Plugin();
    $plugin->setKey('themeclips');
    $plugin->setName('Snippets from Anitya');
    $plugin->requireAsset('editor/plugin/themeclips');

    $pluginManager->register($plugin);
 	}
	function registerEvents () {
			Events::addListener(
					'on_before_render',
					function($e) {
							// First we chacjk if the Id of page that call the event is the current.
							// Otherwise it's probably a render that is called from a programmatically ->render()
							$a = $e->getArguments();
							$v = $a['view'];
							if (!method_exists($v,'getCollectionObject')) return;
							$_c = $v->getCollectionObject();
							$_cID = $_c->getCollectionID();

							$c = Page::getCurrentPage();
							if ($c->getCollectionID() != $_cID) return;

							$session = \Core::make('session');

							$db = Database::connection();
							$tableExist = $db->executeQuery("SHOW TABLES LIKE 'AnityaOptions'");
							if (!$tableExist->FetchRow()) return;
							$mcl = new MclOptions($c);
							// Register options into the session
							$options = $mcl->get_options_from_active_preset_ID();
							$session->set('anitya.options',$options);


							// Register colors from active or default preset in the session
							if (is_object($c)) :
									$colors = PresetColors::GetColorsFromPage();
									$session->set('anitya.colors',$colors);
							endif;
							if (!is_object($c)) return;
							if ($GLOBALS['anityaButtonInitialized']) return;
							$GLOBALS['anityaButtonInitialized'] = true;
							// Now we build the button
							$pt = $c->getCollectionThemeObject();

							if ($pt->getThemeHandle() != 'anitya') return;
							$status = t('Anitya Options');
							$icon = 'toggle-on';
							$ihm = Core::make('helper/concrete/ui/menu');

							$ihm->addPageHeaderMenuItem('theme_anitya', 'theme_anitya',
									array(
											'label' => $status,
											'icon' => $icon,
											'position' => 'right',
											'href' => URL::to('/dashboard/anitya_options/theme_options')
									));
					});
					Events::addListener(
								'on_page_version_approve',
								function($e) {
									$c = $e->getPageObject();
									$blocks = $c->getBlocks();
									if (count($blocks)) :
										$b = array();
										// On prend tous les blocks 'page_navigator'
										foreach ( $blocks as $key => $block) :
											if (is_object($block) && $block->getBlockTypeHandle() == 'page_navigator') :
												$b[] = $block;
											endif;
										endforeach;

										foreach ($b as $key => $block) :
											// Et pour chacun d'eux, on sauve la configuration actuelle de la page
											// Pour que le monde voient la dernière configuration
											$controller = $block->getController();
											$controller->refreshDB();
										endforeach;
									endif;
								});
	}
	public function registerRoutes() {
			// Route::register(
			// 		'/ThemeAnitya/tools/extend.js',
			// 		'\Concrete\Package\ThemeAnitya\Controller\Tools\ExtendJs::render'
			// );
			Route::register(
					'/ThemeAnitya/tools/get_preset_colors',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\PresetColors::getColors'
			);
			Route::register(
					'/ThemeAnitya/tools/get_preset_colors_only',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\PresetColors::getPrincipalColors'
			);
			Route::register(
					'/ThemeAnitya/tools/font_details',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\FontsTools::getFontDetails'
			);
			Route::register(
					'/ThemeAnitya/tools/font_url',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\FontsTools::getFontsURL'
			);
			Route::register(
					'/ThemeAnitya/tools/font_url_ajax',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\FontsTools::getFontURLAjax'
			);
			Route::register(
					'/ThemeAnitya/tools/override',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\OverrideCss::render'
			);
			Route::register(
					'/ThemeAnitya/tools/xml_preset',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\XmlPreset::render'
			);
			Route::register(
					'/ThemeAnitya/tools/get_awesome_icons',
					'\Concrete\Package\ThemeAnitya\Controller\Tools\AwesomeArray::getAwesomeArray'
			);
	}

	function compat_is_version_8() {
			return interface_exists('\Concrete\Core\Export\ExportableInterface');
	 }

	 public function getContentSwapper() {
		 return new MclContentSwapper();
	 }


}

class MclContentSwapper extends ContentSwapper {

 public function swapContent (Package $package, $options) {

		 if ($this->validateClearSiteContents($options)) {
				 \Core::make('cache/request')->disable();

				 $pl = new PageList();
				 $pages = $pl->getResults();
				 foreach ($pages as $c) $c->delete();

				 $fl = new FileList();
				 $files = $fl->getResults();
				 foreach ($files as $f) $f->delete();

				 // clear stacks
				 $sl = new StackList();
				 foreach ($sl->get() as $c) $c->delete();

				 $home = Page::getByID(HOME_CID);
				 $blocks = $home->getBlocks();
				 foreach ($blocks as $b) $b->deleteBlock();

				 $pageTypes = PageType::getList();
				 foreach ($pageTypes as $ct) $ct->delete();

				 $startingPointFolder = $package->getPackagePath() . '/starting_points/'. $package->startingPoint;

				 // Import Files
				 if (is_dir($startingPointFolder . '/content_files')) {
						 $ch = new ContentImporter();
						 $computeThumbnails = true;
						 if ($package->contentProvidesFileThumbnails()) $computeThumbnails = false;
						 $ch->importFiles($startingPointFolder . '/content_files', true );
				 }

				 // Install the starting point.
				 if (is_file($startingPointFolder . '/content.xml')) :
					 // var_dump($startingPointFolder); die(' TS ');
						 $ci = new ContentImporter();
						 $ci->importContentFile($startingPointFolder . '/content.xml');
				 endif;

				 // Set it as default for the page theme
				 $this->setPresetAsDefault($package);

				 // Restore Cache
				 \Core::make('cache/request')->enable();
		 }
 	}
	function setPresetAsDefault ($package) {
			$presetHandle = $package->startingPoint;
			$outputError = false;
			$baseExceptionText = t('The theme and the Starting point has been installed correctly but it\'s ');
			$pt = PageTheme::getByHandle('anitya');
			$preset = $pt->getThemeCustomizablePreset($presetHandle);
			if (!is_object($preset)) {
					if($outputError) throw new \Exception($baseExceptionText . t('impossible to retrieve the Preset selected : ' . $presetHandle));
					return;
			}
			$styleList = $pt->getThemeCustomizableStyleList();
			if (!is_object($styleList)) {
					if($outputError) throw new \Exception($baseExceptionText . t('impossible to retrieve the Style List from ' . $presetHandle));
					return;
			}
			$valueList = $preset->getStyleValueList();
			$vl = new ValueList();

			$sets = $styleList->getSets();
			if (!is_array($sets)) {
					if($outputError) throw new \Exception($baseExceptionText . t('impossible to retrieve the Style Set from ' . $presetHandle));
					return;
			}

			foreach ($sets as $set) :
			 foreach($set->getStyles() as $style)  :
					$valueObject = $style->getValueFromList($valueList);
					if (is_object($valueObject))
							$vl->addValue($valueObject);
			 endforeach;
			endforeach;

			$vl->save();
			$pt->setCustomStyleObject($vl, $preset);
	}

 }
