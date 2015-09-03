<?php

namespace Concrete\Package\ThemeAnitya;

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Page\Template as PageTemplate;
use Concrete\Core\Page\Theme\Theme as PageTheme;
use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;

use Concrete\Package\ThemeAnitya\Src\Helper\MclInstaller;


defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_anitya';
	protected $appVersionRequired = '5.7.3';
	protected $pkgVersion = '1.2.3';
	protected $pkg;


	public function getPackageDescription() {
		return t("Anitya responsive suit any kind of website.");
	}

	public function getPackageName() {
		return t("Anitya Theme");
	}
 	public function on_start() {
 		$al = AssetList::getInstance();
 		$al->register( 'javascript', 'masonry', 'themes/anitya/js/jquery.masonry.min.js', array('version' => '2.1.08', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'imagesloaded', 'themes/anitya/js/imagesloaded.pkgd.min.js', array('version' => '3.1.4', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'scrollmonitor', 'themes/anitya/js/scrollmonitor.js', array('version' => '1.0.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'rcrumbs', 'themes/anitya/js/jquery.rcrumbs.min.js', array('version' => '1.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'anitya.script', 'themes/anitya/js/script.js', array('version' => '0.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'breakpoint', 'themes/anitya/js/breakpoint.js', array('version' => '1.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'nprogress', 'themes/anitya/js/nprogress.js', array('version' => '0.1.6', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'YTPlayer', 'themes/anitya/js/jquery.mb.YTPlayer.min.js', array('version' => '2.7.5', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'javascript', 'jquery-ui/accordion', 'themes/anitya/js/jquery-ui-accordion.js', array('version' => '1.11.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'javascript', 'flickity', 'themes/anitya/js/flickity.pkgd.min.js', array('version' => '0.1.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'javascript', 'slick', 'themes/anitya/js/slick.min.js', array('version' => '1.3.15', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'javascript', 'stellar', 'themes/anitya/js/jquery.stellar.min.js', array('version' => '0.6.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );

 		$al->register( 'css', 'YTPlayer', 'themes/anitya/css/addons/YTPlayer.css', array('version' => '2.7.5', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'css', 'flickity', 'themes/anitya/css/addons/flickity.css', array('version' => '0.1.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'css', 'slick', 'themes/anitya/css/addons/slick.css', array('version' => '1.3.15', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'css', 'slick-theme', 'themes/anitya/css/addons/slick-theme.css', array('version' => '1.3.15', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'css', 'bootsrap-custom', 'themes/anitya/css/addons/bootstrap.custom.min.css', array('version' => '3.3.4', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );

 	}
	public function install($data) {

	// Get the package object
		$this->pkg = parent::install();

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
	}


}
