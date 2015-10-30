<?php
namespace Concrete\Package\ThemeAnitya\Src\Models;

defined('C5_EXECUTE') or die(_("Access Denied."));

use \Concrete\Core\Legacy\Model;
use \Concrete\Core\Foundation\Object;

use Loader;
use Config;
use Package;
use User;
use DOMDocument;
use Core;
use Page;
use stdClass;
use SimpleXMLElement;

use \Concrete\Package\ThemeAnitya\Src\Helper\ThemeFile as ThemeFileHelper;
use \Concrete\Package\ThemeAnitya\Src\Helper\SmArrayToXml;
use \Concrete\Package\ThemeAnitya\Src\Helper\SmXmlToArray ;

use \Symfony\Component\HttpFoundation\Session\Session as SymfonySession;


class MclOptions extends Object
 {

	var $cObj;

	function __construct ($c = null) {
		$this->init($c);
	}

	static function get () {
		$session = \Core::make('session');
		return $session->get('anitya.options');
	}

	function init ($c) {

		$this->pkg = Package::getByHandle("theme_anitya");
		$this->pID = $this->get_active_pID($c);

	}
	function set_collection_object($c) {
		$this->init($c);
	}
	function set_toggle_option_name($name) {
		$this->option_name = $name;
	}

	function get_presets_list() {
		$all = Loader::db()->getAll("SELECT pID, name FROM AnityaOptionsPreset");
		if(is_array($all)) return $all; else return false;
	}
	function get_preset_by_id ($pID) {
		$row = Loader::db()->getRow("SELECT pID, name FROM AnityaOptionsPreset WHERE pID=?", array($pID));
		if(is_array($row)) return $row; else return false;
	}
	function get_preset_id_from_handle ($pHandle) {
		$row = Loader::db()->getRow("SELECT pID FROM AnityaOptionsPreset WHERE name=?", array($pHandle));
		if(isset($row['pID'])) return (int)$row['pID']; else return false;
	}

	function output_presets_list ($echo = false, $selected=null, $name = 'preset_id', $before = array()) {

		$list = $this->get_presets_list ();

		if ($list) :
			$r[] = '<select name="' . $name . '" id="' . $name . '" class="form-control ' . $name . '">';
			if (count($before)) :
				foreach($before as $k=>$option ) :
					$r[] = '<option value="' . -($k) . '">' . $option . '</option>';
				endforeach;
			endif;
			$default_pID = $this->get_default_pID();
			foreach($list as $k=>$p) :

				$text = ($p['pID'] == $default_pID) ? t(' (default)') : '' ;
				$select = ($p['pID'] == $selected ) ? 'selected' : '';

				$r[] = "<option value='{$p['pID']}' $select >{$p['name']}$text</option>";

			endforeach;

			$r[] = '</select>';
			$r = implode("\r" , $r);

			if ($echo) 	echo $r;
			else return $r;

		else:
			return false;
		endif;

	}

	function update () {

	}

	function save_preset($name, $based_on = false, $active = false, $returnID = false) {

		Loader::db()->query("INSERT INTO AnityaOptionsPreset (name,active) VALUES (?,?)", array($name, $active ? 1 : 0));

		if ($returnID) return  Loader::db()->Insert_ID();
		if ($based_on) :
			// Recupere le nouvel ID
			$pID = Loader::db()->Insert_ID();
			// Duplique toutes les options qui ont comme presetID $based_on et leur donne un nouvel ID base sur celui qui vient d'etre cr��
			Loader::db()->query("INSERT INTO AnityaOptions (option_key, option_value, pID)
					  SELECT option_key, option_value, ?
					  FROM AnityaOptions
					  WHERE pID=?",
					  array($pID, $based_on ));
		endif;

	}
	function delete_preset ($pID) {
		/* Ne fonctione pas quand les options d'un preset sont vides
		Loader::db()->query("DELETE AnityaOptions, AnityaOptionsPreset
				  FROM AnityaOptions, AnityaOptionsPreset
				  WHERE AnityaOptions.pID = AnityaOptionsPreset.pID
				  AND AnityaOptionsPreset.pID = ?
				  ", array($pID));
		*/

		Loader::db()->query("DELETE AnityaOptions FROM AnityaOptions WHERE pID = ?", array($pID));
		Loader::db()->query("DELETE AnityaOptionsPreset FROM  AnityaOptionsPreset WHERE pID = ?", array($pID));

		if ($pID == $this->get_default_pID()) $this->set_default_pID(1);

	}

	function rename_preset ($name, $pID) {
		Loader::db()->query("UPDATE AnityaOptionsPreset
				 SET name = ?
				 WHERE pID = ?",
				 array( $name, $pID));

	}

	function set_default_pID ($pID) {
		Config::save('concrete.misc.default_anitya_preset_id', $pID);
	}
	function get_default_pID () {
    $pID = Config::get('concrete.misc.default_anitya_preset_id');
    if (!$pID) :
      self::set_default_pID(1);
      return 1;
    endif;
    return $pID;

	}
	function get_default_preset_title() {
		$p = $this->get_preset_by_id($this->get_default_pID());
		return $p['name'];
	}
	function get_preset_title($pID) {
		$p = $this->get_preset_by_id($pID);
		return $p['name'];
	}
	function get_active_pID ($c = null) {
		// On regarde quel objet page prendre
		$page = $c ? $c : Page::getCurrentPage();
		// On tente de re�cup�rer la valeur de l'attribut
		if (is_object($page)) :
			if (get_class($page) == 'Concrete\Core\Page\Page') {
				$cpID = $page->getAttribute('anitya_theme_preset_options');
			};
		endif;
		// On retourne la valeur de l'attribut, sinon le preset par d�fault
		return $cpID ? $cpID : self::get_default_pID();
	}

	/*******************************
	 * Options
	 * *****************************/

	static function get_options_from_preset_ID ($pID) {
		$all = Loader::db()->getAll("SELECT option_key, option_value FROM AnityaOptions WHERE pID=?", array($pID));
		if(is_array($all)) {
			$r = new stdClass();
			foreach($all as $o) {
				$r->{$o['option_key']} = $o['option_value'];
			}
			$r->pID = $pID;
			return $r;
		}
		return false;
	}
	function get_options_from_active_preset_ID () {
		return self::get_options_from_preset_ID(self::get_active_pID());
	}

	function save_options ($data, $pID, $updateOnly = false) {

		foreach ($data as $k => $v):
			if ($k == 'pID') continue;
			$test = Loader::db()->GetOne("SELECT * FROM AnityaOptions WHERE option_key = ? AND pID= ?", array($k, $pID));
			if ($test):
				if ($updateOnly === false) :
					Loader::db()->query("UPDATE AnityaOptions
							SET option_value=?
							WHERE option_key = ? AND pID= ?",
							array( $v, $k, $pID));
				endif;
			 else :
				Loader::db()->query("INSERT INTO AnityaOptions
						(option_key, option_value, pID)
						VALUES(?,?,?)
						", array( $k, $v, $pID));
			 endif;
		endforeach;
	}

	function getXML_from_pid ($pID){

		$pkg = Package::getByHandle('theme_anitya');
    $xml = new SimpleXMLElement('<mcl_preset></mcl_preset>');

    $config = $xml->addChild('config');
    $config->addChild('theme', $pkg->getPackageHandle());
    $config->addChild('version', $pkg->getPackageVersion());
    $config->addChild('name', $this->get_preset_title($pID));

    $options = $xml->addChild('options');
    foreach ((array)$this->get_options_from_preset_ID($pID) as $key => $value) :
      $new_child = $options->addChild($key);
      if ($new_child !== NULL) {
         $node = dom_import_simplexml($new_child);
         $no   = $node->ownerDocument;
         $node->appendChild($no->createCDATASection($value));
       }
      // $options->addChild($key,'<![CDATA[' . $value . ']]>');
    endforeach;

		return $xml->asXML();
	}

	function importXML_preset ($file, $pID = false, $updateOnly = false) {

	  $p = simplexml_load_file($file, null, LIBXML_NOCDATA);
			// On teste les different conteneurs
			if(isset($p->config) && isset($p->options)) :
				if ($this->pkg->getPackageHandle() != $p->config->theme) return array ('error' => true, 'message' => t('This preset in not compatible with this theme'));
				if (!$pID) :
					// On cree un nouveau preset et recup�re son ID
					$pID = $this->save_preset($p->config->name, false, false, true);
				endif;
				// Si on a pu avoir un ID
				if ($pID) :
					// On sauve les options pour cet ID
          $optionArray = $this->xml2array($p->options);
					if ($updateOnly)
						$this->save_options ($optionArray, $pID, true);
					else
						$this->save_options ($optionArray, $pID, false);

					return array ('error' => false, 'message' => t('Preset imported'));
				else :
					return array ('error' => true, 'message' => t('Can�t create new preset'));
				endif;
			else :
				return array ('error' => true, 'message' => t('This file seems to be not a mcl theme preset'));
			endif;

	}

  function xml2array ( $xmlObject, $out = array () )
  {
      foreach ( (array) $xmlObject as $index => $node )
          $out[$index] = ( is_object ( $node ) ) ? $this->xml2array ( $node ) : $node;
      return $out;
  }

	/*******************************
	 * Options Reset & install
	 * *****************************/

	function reset_options ($pID = 1) {

		$path = Package::getByHandle('theme_anitya')->getPackagePath();
		return $this->importXML_preset ($path . '/models/theme_presets/base.mcl',1);
	}

	function update_db () {
		$this->install_db(false,true);
	}

	function install_db ($pHandle = '', $updateOnly = false) {

		$path = Package::getByHandle('theme_anitya')->getPackagePath() . '/src/Models/theme_presets/';
		$presets_files = ThemeFileHelper::dir_walk($path , array('mcl'));

		if (is_array($presets_files) && count($presets_files)) :
			foreach ($presets_files as $p) :
				if($updateOnly) :
					$_pID = $this->get_preset_id_from_handle(str_replace('.mcl', '', $p));
					// On update les valeurs
					if ($_pID) $this->importXML_preset ($path . $p, $_pID, true);
					// On importe le xml
					else $this->importXML_preset ($path . $p);
				else :
					$this->importXML_preset ($path . $p);
				endif;
			endforeach;
		endif;

		// Set as default
		if ($pHandle) $pID = $this->get_preset_id_from_handle($pHandle);
	  else $pID = 1;

    // Si la function est appellé avec pHandle === false, on update, donc on ne change pas le pID actif
		if ($pID && !$updateOnly)
		  $this->set_default_pID($pID);
	}

}

?>
