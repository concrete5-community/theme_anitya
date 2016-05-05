<?php
namespace Concrete\Package\ThemeAnitya\Attribute\MclPresetList;

defined('C5_EXECUTE') or die(_("Access Denied."));

use \Concrete\Core\Attribute\DefaultController;
use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use View;

class Controller extends DefaultController  {

	public function form() {

		$name = $this->field('value');
		$poh = new MclOptions();


		if (is_object($this->attributeValue)) {
			$selected = $this->getAttributeValue()->getValue();
		} else {
			$selected = 0;
		}

		 $poh->output_presets_list(true, $selected, $name);
	}

}
