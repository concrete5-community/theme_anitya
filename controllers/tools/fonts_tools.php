<?php 
namespace Concrete\Package\ThemeAnitya\Controller\Tools;

use \Concrete\Core\Controller\Controller as RouteController;
use Fileset;
use Loader;

use \Concrete\Package\ThemeAnitya\Src\Models\AnityaFontList;

defined('C5_EXECUTE') or die(_("Access Denied."));

class FontsTools extends RouteController {		
	function getFontDetails () {
				
		if (!$fontList) {
			$fontList = Loader::helper('json')->decode(Loader::helper('file')->getContents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAsT5OzRSuWghytRLmwLagJ4BCl49qC1kM'));
		}

		if (is_object($fontList)) {
			foreach ($fontList->items as $key => $fontObj) {
				
				if (str_replace("+", " ", $_POST['font']) == $fontObj->family) {
					$variants = $fontObj->variants;
					$subsets = $fontObj->subsets;
				}
			}
		}
		// on force le 'regular' et le 'latin'
		$selected_variants[] = 'regular';
		$selected_subsets[] = 'latin';
		// Le nom des inputs
		$subsetName = $_POST['subsetName'];
		$variantName = $_POST['variantName'];

		Loader::packageElement('font_details','theme_anitya',array(
			// Le type d'input
			'variantType' => $_POST['variantType'],
			// LE nom de la police avec +
			'font' => $_POST['font'],
			// Les tableaux des options disponibles
			'variants' => $variants, 
			'subsets' => $subsets,
			// LE nom des inputs
			'subsetName' => $subsetName,
			'variantName' => $variantName, 
			// Les options selectionee
			'selected_variants' => $selected_variants,
			'selected_subsets' => $selected_subsets
		));

	}
	function getFontURLAjax () {
		echo $this->getFontsURL();
	}

	function getFontsURL ()	{

		$list = new AnityaFontList();
		$list->addFont('p');
		$list->addFont('h1');
		$list->addFont('h2');
		$list->addFont('h3');
		$list->addFont('h4');
		$list->addFont('h5');
		$list->addFont('alternate');
		$list->addFont('small');
		return $list->getCssUrlFromList();	
	}
}
