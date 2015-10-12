<?php
namespace Concrete\Package\ThemeAnitya\Block\PageNavigator;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Concrete\Core\Block\BlockController;
use Concrete\Core\Form\Service\Widget\Color;
use Loader;
use StdClass;
use Page;
use Permissions;
use Events;

class Controller extends BlockController {

	protected $btTable = "btPageNavigator";
	protected $btInterfaceWidth = "600";
	protected $btInterfaceHeight = "500";
  protected $btDefaultSet = 'navigation';
	protected $btSupportsInlineEdit = true;
	protected $btSupportsInlineAdd = true;


	public function getBlockTypeName() {
		return t('Page Navigator');
	}

	public function getBlockTypeDescription() {
		return t('Full navigation management into a one page layout. ');
	}

	public function on_start() {
		Events::addListener(
					'on_page_version_approve',
					function($e) {
						$c = $e->getPageObject();
						var_dump($this);
						die();
					});
	}
	public function add () {
		$this->setAssetEdit();
		$this->set('navItems', $this->updateAndGetNavItems());
	}
	public function edit () {
		$o = $this->getOptionsObject();
		$this->set('navItems', $this->updateAndGetNavItems());
	}
	public function view () {

		$time_start = microtime(true);
		// En gros so l'utilisateur est administrateur, on update a chaque fois les $ni
		// Sinon on prend ceux de la DB
		$c = Page::getCurrentPage();
		$cp = new Permissions($c);
		if ($cp->canViewToolbar())
			$this->set('navItems', $this->updateAndGetNavItems());
		else
			$this->set('navItems', $this->getNavItems());

		$o = $this->getOptionsObject();
		$this->set('options', $o);

		$time_end = microtime(true);
		// echo "Time : " . ($time_end - $time_start);

	}
  function getOptionsObject ()  {
      // Cette fonction retourne un objet option
      // SI le block n'existe pas encore, ces options sont préréglées
      // Si il existe on transfome la chaine de charactère en json
      if (!$this->bID) :
      	$options = new StdClass();
				$options->value = 75;
      else:
          $options = json_decode($this->options);
          if (is_object($options->options))
      		$options = $options->options;
      endif;
    return $options ;

  }

  public function setAssetEdit () {
		$this->set('options', $this->getOptionsObject());
  }

	public function getBlockNavFromPage ($c = null) {
		if (is_numeric($c))	$c = Page::getByID($c);
		if (!is_object($c)) $c = Page::getCurrentPage();
		$b = array();
		$blocks = $c->getBlocks();
		if (count($blocks)) :
			foreach ( $blocks as $key => $block) :
				if ($block->getBlockTypeHandle() == 'page_section') :
					$b[] = $block;
				endif;
			endforeach;
		endif;
		return count($b) ? $b : false;
	}

	// On va recupérer toutes les sections avec leurs infos
	function getNavItemsFromBlocks ($blocks) {
		$navItems = array();
		foreach ($blocks as $block) {
			$ni = $block->getController()->getNavItemFromBlock();
			$navItems[$ni->ID] = $ni;
		}
		return $navItems;
	}

	// Retourne les elements en DB.
	function getNavItems () {
		if (!$this->bID) :
			$navItems = new StdClass();
		else:
			$navItems = json_decode($this->navItems);
			if (is_object($navItems->navItems))
			$navItems = $navItems->navItems;
		endif;
		return $navItems ;
	}

	// Melange les section sauvée et les compare avec celles présente sur la page.
	// La version de la page ecrasera toujours celle de la DB
	function updateAndGetNavItems ($IDs = array(),$c = null) {
		if (count($IDs)) :
			 // On est dans le cas de la sauvegarde du bloc
			 // Ou on envoie un tableau des ID ordonné
			 $savedID = array_flip($IDs);
		else :
			// On prend les ID des elements sauve.
			$ni = $this->getNavItems();
			if (is_object($ni))
				$savedID = get_object_vars($this->getNavItems()); // TODO : Pas sûr que ça resiste à toutes les situations
				else
				$savedID = array();
		endif;

		$blocks = $this->getBlockNavFromPage($c);
		// echo "toto";
		// var_dump($blocks); die();
		$realNi = $blocks ? $this->getNavItemsFromBlocks($blocks) : array();
		if (count($savedID) && count($realNi)):
			// On cree un tableau dans l'ordre des sauvgardes
			foreach ($savedID as $key => $value) {
				$savedNi[$key] = $realNi[$key];
			}
			return array_merge($savedNi, $realNi)	;

		else :
			return $realNi;
		endif;
	}

	public function refreshDB	($c = null) {
		// Cette function est apellée par un Event.
		$this->save($this->updateAndGetNavItems(array(),$c));
	}

  public function registerViewAssets() {
      $this->requireAsset('css', 'font-awesome');
  }

	public function save($data) {
    $options = $data;
    unset($options['bID']);
		unset($options['ID']);
		$navItems = $this->updateAndGetNavItems($data['ID']);
    $data['options'] = json_encode($options);
		$data['navItems'] = json_encode($navItems);
		parent::save($data);

	}
  public function getImportData($blockNode, $page)
  {
      $options = json_decode(stripslashes(str_replace(
      	array('"{','}"'),
      	array('{','}'),
      	$blockNode->data->record->options)));
      if (is_object($options->options))
      	$options = $options->options;

      $args = array('options' => $options);

      return $args;
  }
}
