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
use Concrete\Core\StyleCustomizer\Style\ValueList;

use Concrete\Package\ThemeAnitya\Src\Helper\MclInstaller;
use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Concrete\Package\ThemeAnitya\Controller\Tools\PresetColors;


defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_anitya';
	protected $appVersionRequired = '5.7.3';
	protected $pkgVersion = '1.2.3.8';
	protected $pkg;


	public function getPackageDescription() {
		return t("Anitya responsive suit any kind of website.");
	}

	public function getPackageName() {
		return t("Anitya Theme");
	}

	public function install($data) {

	// Get the package object
		$this->pkg = parent::install();

	// Theme options
		$o = new \Concrete\Package\ThemeAnitya\Src\Models\MclOptions($c);
		$o->install_db();

	// Setting up the editor clips
		$plugins = Config::get('concrete.editor.plugins.selected');
		$p = is_array($plugins) ? $plugins : array();
		$plugins = array_unique(array_merge(array('themefontcolor','themeclips'),$p));
		Config::save('concrete.editor.plugins.selected', $plugins);

	// Installing minimal config
		$this->installOrUpgrade();

	}
	public function upgrade () {
		$this->pkg = $this;
		$this->installOrUpgrade();
	}

	private function installOrUpgrade() {

		$ci = new MclInstaller($this->pkg);
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/themes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_templates.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/attributes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/blocktypes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/single_page.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/systemcontenteditorsnippets.xml');
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
		// $al->register( 'javascript', 'onepagenav', 'js/build/jquery.onepagenav.js', array('version' => '3.0'), $this );

 		$al->register( 'css', 'YTPlayer', 'themes/anitya/css/addons/YTPlayer.css', array('version' => '2.7.5'), $this );
		$al->register( 'css', 'slick', 'themes/anitya/css/addons/slick.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'slick-theme', 'themes/anitya/css/addons/slick-theme.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'bootsrap-custom', 'themes/anitya/css/addons/bootstrap.custom.min.css', array('version' => '3.3.4'), $this );
		$al->register( 'css', 'megamenu', 'themes/anitya/css/addons/mega-menu.css', array('version' => '1'), $this );

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
							$session = \Core::make('session');
							$c = Page::getCurrentPage();
							// Register options into the session
							$options = MclOptions::get_options_from_active_preset_ID();
							$session->set('anitya.options',$options);

							// Register colors from active or default preset in the session
							if (is_object($c)) :
									$colors = PresetColors::GetColorsFromPage();
									$session->set('anitya.colors',$colors);
							endif;

							if (!is_object($c)) return;
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
											if ($block->getBlockTypeHandle() == 'page_navigator') :
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
					'/ThemeAnitya/tools/override.css',
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
}
