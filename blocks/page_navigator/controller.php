<?php
namespace Concrete\Package\ThemeAnitya\Block\PageNavigator;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Concrete\Core\Block\BlockController;
use Concrete\Core\Form\Service\Widget\Color;
use Loader;
use StdClass;
use Page;

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


	public function add () {
		$this->setAssetEdit();

	}
	public function edit () {
		$this->setAssetEdit();
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
		$this->requireAsset('core/colorpicker');
		$this->requireAsset('css', 'font-awesome');
		$this->set('pageSelector', Loader::helper('form/page_selector'));
		$this->set('options', $this->getOptionsObject());
    }

	public function view () {
		// var_dump($this->getOptionsObject());
        $this->set('options', $this->getOptionsObject());
	}

		public function getBlockNavFromPage ($c) {
			if (!is_object($c))	$c = Page::getByID($c);

			$b = array();
			$blocks = $c->getBlocks();
			if (count($blocks)) :
				foreach ( as $key => $block) :
					if ($block->getBlockTypeHandle() == 'page_navigator' && $block->getBlockID != $this->bID) :
						$b[] = $block;
					endif;
				endforeach;
			endif;

			return count($b) ? $b : false;
		}

		// On va recupérer tous les HR avec leurs infos
		function getNavItemsFromBlocks ($blocks) {
			$navItems = array();
			foreach ($blocks as $block) {
				 $navItems[] = $block->getController()->getNavItemFromBlock($block);
			}
			return $navItems;
		}

		// On va recupérer les info du mode HR
		function getNavItemFromBlock ($block) {
			$o = $this->getOptionsObject();
			$ni = new StdClass();
			$ni->name = $o->name;
			$ni->handle = $o->handle();
			return $ni;
		}

    public function registerViewAssets() {
        $this->requireAsset('css', 'font-awesome');
    }

		public function save($data) {
      $options = $data;
      // unset($options['fID']);
      $data['options'] = json_encode($options);
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
