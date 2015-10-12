<?php
namespace Concrete\Package\ThemeAnitya\Block\PageSection;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Concrete\Core\Block\BlockController;
use Concrete\Core\Form\Service\Widget\Color;
use Loader;
use StdClass;
use Page;

class Controller extends BlockController {

	protected $btTable = "btPageSection";
	protected $btInterfaceWidth = "600";
	protected $btInterfaceHeight = "500";
  protected $btDefaultSet = 'navigation';
	protected $btSupportsInlineEdit = true;
	protected $btSupportsInlineAdd = true;


	public function getBlockTypeName() {
		return t('Page Section');
	}
	public function getBlockTypeDescription() {
		return t('Add a navigation section into a one page layout. ');
	}
	public function add () {
		$this->setAssetEdit();
	}
	public function edit () {
		$this->setAssetEdit();
	}
  public function getOptionsObject ()  {
      if (!$this->bID) :
      	$options = new StdClass();
				$options->ID = uniqid();
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

	public function view () {
      $this->set('options', $this->getOptionsObject());
	}


		// On va recupérer les infos
		function getNavItemFromBlock () {
			$o = $this->getOptionsObject();
			$ni = new StdClass();
			$ni->name = $o->name;
			$ni->ID = $o->ID;
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
