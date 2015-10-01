<?php 
namespace Concrete\Package\ThemeAnitya\Controller\Tools;

use \Concrete\Core\Controller\Controller as RouteController;
use \Concrete\Package\ThemeAnitya\Src\Models\AnityaFont;
use \Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Page;
use Loader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class OverrideCss extends RouteController {
		
	function render () {
		// var_dump($_GET['pID']); die();
		$time_start = microtime(true);
		$c = Page::getByID($_GET['cID']); // Juste pour pouvoir afficher le nom de la page dans le fichier css
		if ($_GET['pID']) $o = MclOptions::get_options_from_preset_ID($_GET['pID']);
		else $o = MclOptions::get();
		$option_object = new MclOptions();
		$t =  $c->getCollectionThemeObject();

		// CSS things
		$bodypattern = $o->bg_body_custom ? $o->bg_body_custom : $o->bg_body_pattern;
		
		// On capte le code CSS dans le tampon
		ob_start();
	    Loader::packageElement('override.css', 'theme_anitya', array('o' => $o, 
	    																 'option_object' => $option_object,
	    																 'h' => $h, 
	    																 'bodypattern' => $bodypattern,
	    																 'c' => $c
	    																));	
		$style = ob_get_clean();

		header("Content-Type: text/css");

		$time_end = microtime(true);
		$time = $time_end - $time_start;

		echo $style;
		echo '/* Generated Time ' . $info . ' : ' . $time . ' ms ' . "*/ \n\n";
	
	}
}