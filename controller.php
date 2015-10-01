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
	protected $pkgVersion = '1.2.3.2';
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
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/single_page.xml');
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
 		$al->register( 'javascript', 'masonry', 'themes/anitya/js/jquery.masonry.min.js', array('version' => '2.1.08'), $this );
 		$al->register( 'javascript', 'imagesloaded', 'themes/anitya/js/imagesloaded.pkgd.min.js', array('version' => '3.1.4'), $this );
 		$al->register( 'javascript', 'scrollmonitor', 'themes/anitya/js/scrollmonitor.js', array('version' => '1.0.1'), $this );
 		$al->register( 'javascript', 'rcrumbs', 'themes/anitya/js/jquery.rcrumbs.min.js', array('version' => '1.1'), $this );
 		$al->register( 'javascript', 'anitya.script', 'themes/anitya/js/script.js', array('version' => '0.1'), $this );
 		$al->register( 'javascript', 'breakpoint', 'themes/anitya/js/breakpoint.js', array('version' => '1.0'), $this );
 		$al->register( 'javascript', 'nprogress', 'themes/anitya/js/nprogress.js', array('version' => '0.1.6'), $this );
 		$al->register( 'javascript', 'YTPlayer', 'themes/anitya/js/jquery.mb.YTPlayer.min.js', array('version' => '2.7.5'), $this );
		$al->register( 'javascript', 'jquery-ui/accordion', 'themes/anitya/js/jquery-ui-accordion.js', array('version' => '1.11.2'), $this );
		$al->register( 'javascript', 'flickity', 'themes/anitya/js/flickity.pkgd.min.js', array('version' => '0.1.0'), $this );
		$al->register( 'javascript', 'slick', 'themes/anitya/js/slick.min.js', array('version' => '1.3.15'), $this );
		$al->register( 'javascript', 'stellar', 'themes/anitya/js/jquery.stellar.min.js', array('version' => '0.6.2'), $this );

 		$al->register( 'css', 'YTPlayer', 'themes/anitya/css/addons/YTPlayer.css', array('version' => '2.7.5'), $this );
		$al->register( 'css', 'flickity', 'themes/anitya/css/addons/flickity.css', array('version' => '0.1.0'), $this );
		$al->register( 'css', 'slick', 'themes/anitya/css/addons/slick.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'slick-theme', 'themes/anitya/css/addons/slick-theme.css', array('version' => '1.3.15'), $this );
		$al->register( 'css', 'bootsrap-custom', 'themes/anitya/css/addons/bootstrap.custom.min.css', array('version' => '3.3.4'), $this );

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
	}
	public function registerRoutes() {
			// Route::register(
			// 		'/ThemeAnitya/tools/extend.js',
			// 		'\Concrete\Package\ThemeAnitya\Controller\Tools\ExtendJs::render'
			// );
			// Route::register(
			// 		'/ThemeAnitya/tools/get_preset_colors',
			// 		'\Concrete\Package\ThemeAnitya\Controller\Tools\PresetColors::getColors'
			// );
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
