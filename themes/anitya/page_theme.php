<?php
namespace Concrete\Package\ThemeAnitya\Theme\Anitya;

use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use stdClass;
use Package;
use Loader;
use CollectionAttributeKey;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

				$this->requireAsset('core/lightbox');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'bootstrap/dropdown');
        $this->requireAsset('javascript', 'imageloaded');
        $this->requireAsset('javascript', 'isotope');
				$this->requireAsset('javascript', 'element-masonry');
        $this->requireAsset('javascript', 'slick');
        $this->requireAsset('javascript', 'rcrumbs');
        $this->requireAsset('javascript', 'scrollmonitor');
        $this->requireAsset('javascript', 'breakpoint');
        $this->requireAsset('javascript', 'nprogress');
        $this->requireAsset('javascript', 'YTPlayer');
        $this->requireAsset('javascript', 'js/jquery-ui.js');
        $this->requireAsset('javascript', 'jquery-ui/accordion');
        $this->requireAsset('javascript', 'stellar');
        $this->requireAsset('javascript', 'anitya.script');


        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('css', 'YTPlayer');
        $this->requireAsset('css', 'slick');
        $this->requireAsset('css', 'slick-theme');
        $this->requireAsset('css', 'jquery/ui');
        $this->requireAsset('css', 'bootsrap-custom');
				$this->requireAsset('css', 'megamenu');

	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
				$blocks_classes = array('block-primary', 'block-secondary', 'block-tertiary', 'block-quaternary');
				$columns = $margin = array();
				for ($i=1; $i < 7; $i++) $columnsClasses[] = "$i-column";
				for ($i=0; $i < 40; $i+=10) $marginClasses[] =  "carousel-margin-{$i}px";

				$image_height = array('image-height-30','image-height-50','image-height-80','image-height-100');
        return array(
            'page_list' => array_merge(array(
								'sidebar-wrapped',
								// Accordions & tabs colors
								'element-primary','element-secondary','element-tertiary','element-quaternary','element-light',
								// Carousel dots
                'slider-dots-primary', "slider-dots-white", "slider-dots-black",
								// sqlite_error_string
								'tag-sorting','keyword-sorting',
								// Layout
								'no-gap'
								),
								// # columns for carousel
								$columnsClasses,
								// Margin size for carousel
								$marginClasses),
						'content' => array('image-caption','image-caption-inside','collapse-top-margin'),
            'autonav' => array('sidebar-wrapped', 'small-text-size'),
            'horizontal_rule' => array('space-s','space-m','space-l','space-xl','thin','primary','secondary','tertiary','quaternary','dotted','hr-bold'),
            'topic_list' => array('sidebar-wrapped'),
            'image' => array_merge(array('responsive', 'svg-primary','svg-quaternary'),$image_height),
            'testimonial' => array ('primary','secondary','tertiary','quaternary','white'),
						'core_stack_display' => array_merge(array('element-primary','element-secondary','element-tertiary','element-quaternary','element-light','slider-dots-primary', "slider-dots-white", "slider-dots-black"),$columnsClasses, $marginClasses),

        );
    }

    public function getThemeAreaClasses()
    {
				// For multiple area
        $main_area = array('Main');
        $area_classes = array(
            // Colors
            'page-content-style','area-primary','area-secondary','area-tertiary','area-quaternary','area-white','area-black','area-body',
            // Spacing
            'area-space-s','area-space-m','area-space-l','area-space-xl',
            // Topics
            'topic-get-in-touch','topic-idea','topic-help','topic-config','topic-news','topic-conversation',
            // Borders
            'border-thin','border-bold','border-bold-primary','border-bold-secondary','border-bold-tertiary','border-bold-quaternary','border-bold-white',
            // Animation
            'wow','flipInX','fadeInDown','zoomIn'
            );
        for ($i=1; $i < 8; $i++) {
            $main_area['Main - ' . $i] = $area_classes;
            $main_area['Main Column ' . $i] = $area_classes;
            $main_area['Main Column 1 - ' . $i] = $area_classes;
            $main_area['Main Column 2 - ' . $i] = $area_classes;
            $main_area['Main Column 3 - ' . $i] = $area_classes;
            $main_area['Main Column 4 - ' . $i] = $area_classes;
        }
				$image_height = array('image-height-30','image-height-50','image-height-80','image-height-100');
        // Default array
        $other_area = array(
            'Main' => $area_classes,
            'Page Footer' => array('primary', 'secondary','tertiary'),
						'Header Image' => $image_height,
						'Page Header' => $area_classes,
						'Sub Header' => $area_classes,
        );

        return array_merge($main_area,$other_area);
    }

    public function getThemeEditorClasses()
    {
        return array(
					array('title' => t('Code'), 'menuClass' => '', 'spanClass' => 'code'),
					array('title' => t('Light'), 'menuClass' => 'light', 'spanClass' => 'light'),
					array('title' => t('Small'), 'menuClass' => 'small', 'spanClass' => 'small'),
					array('title' => t('Lead'), 'menuClass' => 'lead', 'spanClass' => 'lead')
        );
    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '900px',
            'medium' => '768px',
            'small' => '0'
        );
    }

	// -- Helpers -- \\

	public function getOptions () {
		return MclOptions::get();
	}

	public function getPageTags ($pages) {
    $tagsObject = new StdClass();
    $tagsObject->tags = $tagsObject->pageTags = array();
    $ak = CollectionAttributeKey::getByHandle('tags');
    $db = Loader::db();

    foreach ($pages as $key => $page):
    		if ($page->getAttribute('tags')) :

    				$v = array($page->getCollectionID(), $page->getVersionID(), $ak->getAttributeKeyID());
    				$avID = $db->GetOne("SELECT avID FROM CollectionAttributeValues WHERE cID = ? AND cvID = ? AND akID = ?", $v);
    				if (!$avID) continue;

    				$query = $db->GetAll("
    						SELECT opt.value
    						FROM atSelectOptions opt,
    						atSelectOptionsSelected sel

    						WHERE sel.avID = ?
    						AND sel.atSelectOptionID = opt.ID",$avID);

    				foreach($query as $opt) {
    						$handle = preg_replace('/\s*/', '', strtolower($opt['value']));
    						$tagsObject->pageTags[$page->getCollectionID()][] =  $handle ;
    						$tagsObject->tags[$handle] = $opt['value'];
    				}
    		endif ;
    endforeach;
    return $tagsObject;
  }
		function createLayout ($navItems, $niKey, $break_columns_on_child, $nav_multicolumns_item_per_column){

			// Cette fonction crée un layout pour le systeme de multicolonnes

			$item_count = 0;
			$columns = 0;
			$layout = array();

			foreach ($navItems as $key => $ni)  :
				// Si on est AVANT les sous menu, on ignore
			 	if($key <= $niKey ) continue;
			 	// Si on est APRES les sous menu, on arrete.
				if($ni->level == 1 ) break;

				if ($break_columns_on_child && $ni->hasSubmenu ) {
					$columns ++;
					$item_count = 0;
				}

				if(!$break_columns_on_child && $item_count ==  $nav_multicolumns_item_per_column) {
					$columns ++;
					$item_count = 0;
				}

				$layout[$columns][] = $ni;
				$item_count ++;
			endforeach;


			if($columns) :
				return $layout;
			else :
				// Si le layout a ete cree et qu'il n'y a qu'une colonne
				// On teste le nombre d'elment pour voir si c'est normal qu'il n'y ai qu'une colonne.
				// On est soit dans le cas ou il n'y a pas plusieurs enfants pour creer des colonnes
				// et alors on se base sur uen decoupe de colonnes suivant le nombres d'elements
				if (count($layout[0]) > $nav_multicolumns_item_per_column ) return $this->createLayout($navItems,$niKey, false, $nav_multicolumns_item_per_column);
				return $layout;
			endif;
		}


	  function getClassSettings ($block,$prefix) {
	    $styleObject = new StdClass();
	    if (is_object($block) && is_object($style = $block->getCustomStyle())) :
				$classes = $style->getStyleSet()->getCustomClass();
				$classesArray = explode(' ', $classes);
				$styleObject->classesArray = $classesArray;
	      preg_match('/' . $prefix . '-(\w+)/',$classes,$found);
	      return isset($found[1]) ? (int)$found[1] : false;
	    endif;
	  }

		function getClassSettingsObject ($block, $defaultColumns = 3, $defaultMargin = 10  ) {
			$styleObject = new StdClass();

			if (is_object($block) && is_object($style = $block->getCustomStyle())) :
				// We get string as 'first-class second-class'
				$classes = $style->getStyleSet()->getCustomClass();
				// And get array with each classes : 0=>'first-class', 1=>'second-class'
				$classesArray = explode(' ', $classes);
				$styleObject->classesArray = $classesArray;

				// get Columns number
				preg_match("/(\d)-column/",$classes,$columns);
				$styleObject->columns = isset($columns[1]) ? (int)$columns[1] : (int)$defaultColumns;
				// Get margin number
				// If columns == 1 then we set margin to 0
				// If more columns, set margin to asked or to default.
				preg_match("/carousel-margin-(\d+)/",$classes,$margin);
				$styleObject->margin = $styleObject->columns > 1 ? (isset($margin[1]) ? (int)$margin[1] : (int)$defaultMargin ) : 0 ;
				// Get the 'no-text' class
				// The title is displayed by default
				$styleObject->displayTitle = array_search('no-text',$classesArray) === false;
			else :
				$styleObject->columns = (int)$defaultColumns;
				$styleObject->margin = (int)$defaultMargin;
				$styleObject->classesArray = array();
			endif;

			return $styleObject;

		}

	  function contrast ($hexcolor, $dark = '#000000', $light = '#FFFFFF') {
	      return (hexdec($hexcolor) > 0xffffff/2) ? $dark : $light;
	  }


}
