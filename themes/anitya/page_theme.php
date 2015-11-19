<?php
namespace Concrete\Package\ThemeAnitya\Theme\Anitya;

use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use stdClass;
use Package;
use Loader;
use Core;
use Page;
use Request;
use CollectionAttributeKey;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  implements ThemeProviderInterface  {


	protected $block;
	protected $cc;
	protected $cs;

	public function registerAssets() {

				$this->requireAsset('core/lightbox');
				$this->requireAsset('javascript', 'backstretch');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'bootstrap/dropdown');
				$this->requireAsset('javascript', 'js/jquery-ui.js');
        $this->requireAsset('javascript', 'jquery-ui/accordion');

        $this->requireAsset('javascript', 'imageloaded');
        $this->requireAsset('javascript', 'isotope');
				$this->requireAsset('javascript', 'element-masonry');
        $this->requireAsset('javascript', 'slick');
        $this->requireAsset('javascript', 'rcrumbs');
        $this->requireAsset('javascript', 'scrollmonitor');
        $this->requireAsset('javascript', 'breakpoint');
        $this->requireAsset('javascript', 'nprogress');
        $this->requireAsset('javascript', 'YTPlayer');
        $this->requireAsset('javascript', 'stellar');
				$this->requireAsset('javascript', 'mmenu');
				$this->requireAsset('javascript', 'wow');
				$this->requireAsset('javascript', 'autohidingnavbar');
				$this->requireAsset('javascript', 'enquire');
        $this->requireAsset('javascript', 'anitya.script');


        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('css', 'YTPlayer');
        $this->requireAsset('css', 'slick');
        $this->requireAsset('css', 'slick-theme');
        $this->requireAsset('css', 'jquery/ui');
        $this->requireAsset('css', 'bootsrap-custom');
				$this->requireAsset('css', 'megamenu');
				$this->requireAsset('css', 'mmenu');

	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
				$blocks_classes = array('block-primary', 'block-secondary', 'block-tertiary', 'block-quaternary');
				$elements_colors = array('element-primary','element-secondary','element-tertiary','element-quaternary','element-light');
				$columns = $margin = array();
				for ($i=1; $i < 7; $i++) $columnsClasses[] = "$i-column";
				for ($i=0; $i < 40; $i+=10) $marginClasses[] =  "carousel-margin-{$i}px";

				$image_height = array('image-height-30','image-height-50','image-height-80','image-height-100');
        return array(
            'page_list' => array_merge(
								// Accordions & tabs colors
								$elements_colors,
								// Carousel dots
								array(
								// page-list type
								'is-masonry','is-carousel',
								// sqlite_error_string
								'tag-sorting','keyword-sorting',
								// Popup result
								'popup-link',
								// Layout
								'no-gap'
								),
								// # columns for carousel
								$columnsClasses),
						'image_slider' => array_merge(
								// Carousel dots
								array(
                'slider-dots-primary', "slider-dots-white", "slider-dots-black",
								// Layout
								'no-gap'
								),
								// # columns for carousel
								$columnsClasses,
								// Margin size for carousel
								$marginClasses),
						'content' => array('image-caption','image-caption-inside','collapse-top-margin'),
            'autonav' => array_merge($elements_colors,array()),
            'horizontal_rule' => array('space-s','space-m','space-l','space-xl','thin','primary','secondary','tertiary','quaternary','dotted','hr-bold'),
            'topic_list' => array('sidebar-wrapped'),
						'image' => array_merge($image_height,array(
															// overlay
															'black-smoked','primary-smoked','secondary-smoked','tertiary-smoked','quaternary-smoked', 'white-smoked',
                             'no-text',
                              // Height classes
                             'height-80','height-50','height-30',
                             'into-columns',
                             // Caption  classes
                             'caption-inside','caption-hover',
                             'caption-primary', 'caption-secondary', 'caption-tertiary', 'caption-quaternary',
													 	// specials
														'svg-primary','svg-quaternary'
													)),
            'testimonial' => array ('primary','secondary','tertiary','quaternary','white'),
						'core_stack_display' => array_merge(array('element-primary','element-secondary','element-tertiary','element-quaternary','element-light','slider-dots-primary', "slider-dots-white", "slider-dots-black"),$columnsClasses, $marginClasses),
						'core_area_layout' => array('left-primary','left-secondary','left-tertiary','left-quaternary','right-primary','right-secondary','right-tertiary','right-quaternary','no-gap','image-on-right','left-column-25','left-column-75')

        );
    }

    public function getThemeAreaClasses()
    {
				// For multiple area
				$divider_style = array('section-divider','sd-style-doublediagonal','sd-style-doublediagonal-inversed','sd-style-halfcircle','sd-style-multitriangles','section-divider-primary','section-divider-secondary','section-divider-tertiary','section-divider-quaternary');
				$twoNoGapClasses = array('two_nogap','left-primary','left-secondary','left-tertiary','left-quaternary','right-primary','right-secondary','right-tertiary','right-quaternary','image-on-right','left-column-25','left-column-75');
				$main_area = array('Main');

        $area_classes = array_merge(array(
            // Colors
            'area-primary','area-secondary','area-tertiary','area-quaternary','area-white','area-black','area-body',
            // Spacing
            'area-space-s','area-space-m','area-space-l','area-space-xl','area-space-horizontal',
						// Placements
						'vertical-align',
            // Topics
            'topic-get-in-touch','topic-idea','topic-help','topic-config','topic-news','topic-conversation',
            // Borders
            'border-thin','border-bold','border-bold-primary','border-bold-secondary','border-bold-tertiary','border-bold-quaternary','border-bold-white',
            // Animation
            'wow','flipInX','fadeInDown','zoomIn'),
						// divider_style
						$divider_style);
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
						'Simple Content' => $area_classes,
            'Page Footer' => array('primary', 'secondary','tertiary'),
						'Header Image' => array_merge($image_height,$area_classes),
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

		public function getThemeAreaLayoutPresets()
    {
        $presets = array(
            array(
                'handle' => 'three_nogap',
                'name' => 'Three no-gap',
                'container' => '<div class="row no-gap area-primary"></div>',
                'columns' => array(
                    '<div class="col-sm-4"></div>',
                    '<div class="col-sm-4"></div>',
										'<div class="col-sm-4"></div>'
                ),
            ),
            array(
                'handle' => 'two_nogap',
                'name' => 'Two no-gap',
                'container' => '<div class="row no-gap area-primary"></div>',
                'columns' => array(
                    '<div class="col-sm-6"></div>',
                    '<div class="col-sm-6"></div>'
                )
            )
        );
        return $presets;
    }
	// -- Helpers -- \\

	function get_footer_geometry ($footer_column) {
		$footer_column = $footer_column ? $footer_column : 3;
		$geometry = array();

		if (is_numeric($footer_column)) :
			for ($i = 1 ; $i < ((int)$footer_column + 1) ; $i++) :
				$geometry[$i] = array();
				$geometry[$i]['class'] = 'footer-item col-md-' . (12 / $footer_column );
				$geometry[$i]['name'] = 'Footer ' . $i ;
			endfor;
		else :
			switch($footer_column) :

				case 'half_two':
					$geometry[1] = array('class'=>'footer-item col-md-6', 'name'=>'Footer 1');
					$geometry[2] = array('class'=>'footer-item col-md-3', 'name'=>'Footer 2');
					$geometry[3] = array('class'=>'footer-item col-md-3 last', 'name'=>'Footer 3');
					break;

				case 'half_three':
					$geometry[1] = array('class'=>'footer-item col-md-6', 'name'=>'Footer 1');
					$geometry[2] = array('class'=>'footer-item col-md-2', 'name'=>'Footer 2');
					$geometry[3] = array('class'=>'footer-item col-md-2', 'name'=>'Footer 3');
					$geometry[4] = array('class'=>'footer-item col-md-2 last', 'name'=>'Footer 4');
					break;
			endswitch;

		endif;

	return $geometry;
}

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


		// Block Custom classes
		function setBlock ($b) {

			// On definie le style de bloc que si il est completement different de celui déjà réglé dans la page
			if (!is_object($this->block)) {
				$this->block = $b;
				$new = true;
			}
			if (($b->getBlockTypeHandle() != $this->block->getBlockTypeHandle() ||
				  $b->getBlockID() != $this->block->getBlockID()) ||
					$new
				 ):

				// on extrait les classes
				// Et on les sauvegardes
				$style = $b->getCustomStyle();
				$this->cc = (is_object($b) && is_object($style)) ? $style->getStyleSet()->getCustomClass() : '';
				$this->cs =  is_object($style) ? $style : false;

			endif;
		}

		function getClassSettingsString ($b) {
			$this->setBlock ($b);
			return $this->cc;
		}

		function getClassSettingsArray ($b) {
			$this->setBlock ($b);
			return explode(' ',  $this->cc);
		}

		function getClassSettingsPrefixInt ($b,$prefix,$string = false) {
			$this->setBlock ($b);
			$_string = $tring ? $string : $this->cc;
      preg_match('/' . $prefix . '-(\w+)/',$_string,$found);
      return isset($found[1]) ? (int)$found[1] : false;
	  }

		## return words AFTER $prefix (element-)primary
		function getClassSettingsPrefixString ($b,$prefix,$string = false) {
			$this->setBlock ($b);
			$_string = $tring ? $string : $this->cc;
      preg_match('/' . $prefix . '-(\w+)/',$_string,$found);
	    return isset($found[1]) ? $found[1] : false;
	  }

		function getCustomStyleImage ($b) {
			$this->setBlock ($b);
			if ($this->cs) {
			    $set = $this->cs->getStyleSet();
			    $image = $set->getBackgroundImageFileObject();
			    if (is_object($image)) {
			        return $image;
			    }
			}
			return false;
		}

		function getClassSettingsObject ($block, $defaultColumns = 3, $defaultMargin = 10  ) {
			$this->setBlock ($block);
			$styleObject = new StdClass();

			if ($this->cs) :
				// We get string as 'first-class second-class'
				$classes = $this->cc;
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

		function getPageListVariables ($b,$controller,$pages,$options = array()) {
			$options = array_merge(array(
												'type' => 'tiny',
												'topicAttributeKeyHandle' => 'project_topics',
												'alternativeDateAttributeHandle' => 'date',
												'hideEditMode' => true,
												'user' => false,
												'topics' => false,
												'forcePopup' => false,
												'slider' => false,
												'additionalWrapperClasses' => array()),
												$options);

			/*
				Les carousels sont activé par une classe "is-carousel"
					=> Ajout de la classe 'slick-wrapper' sur le wrapper
					=> Ajout des options slick sous forme Ajax et en temps qu'attribut data du wrapper
				Le masonry est activé par la classe 'is-masonry' , sauf si carousel.
					=> Le wrapper contient la classe "masonry-wrapper"
					=> Le wrapper contient l'attribut data-gridsizer avec la classe des colonnes
					-- Si pas masonery
						=> ajout d'un div.row tous les X
				Les filtre de tags sont activé par une classe "tag-sorting"
					=> géré par elements/sortable.php
				Les filtre keywords sont activé par une classe "keywords-sorting"
					=> géré par elements/sortable.php
				Le nombre de colonnes pas column-x
				L'absence de marge par "no-gap"
				L'affichage en popup est activé par la classe "popup-link" ou par l'option 'forcePopup'

				Chaque page liste a un wrapper qui portera le nom du fichier en temps que classe
			*/

			$vars = array();
			$c = Page::getCurrentPage();
			$nh = Loader::helper('navigation');
			$vars['th'] = $th = Loader::helper('text');
			$vars['dh'] = $dh = Core::make('helper/date');
			$request = Request::getInstance();

			$styleObject = $this->getClassSettingsObject($b);
			$tagsObject = $this->getPageTags($pages);

			$displayUser = $options['user'];
			$displaytopics = $options['topics'];
			$displayPopup = (in_array('popup-link',$styleObject->classesArray)) || ($options['forcePopup']);
			$isCarousel = in_array('is-carousel',$styleObject->classesArray);
			$isMasonry = in_array('is-masonry',$styleObject->classesArray) && !$isCarousel;
			$isStaticGrid = !$isMasonry && !$isCarousel;

			// Theme related
			$vars['o'] = $o = $this->getOptions();
			$vars['tagsObject'] = $tagsObject;
			$vars['type'] = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle($options['type']);
			$vars['styleObject'] = $styleObject;
			$vars['$masonryWrapperAttributes'] = 'data-gridsizer=".' . $vars['column_class'] . '" data-bid="' . $b->getBlockID() . '"';
			$vars['gap'] = (in_array('no-gap',$styleObject->classesArray)) ? 'no-gap' : 'with-gap';
			$vars['column_class'] = ($styleObject->columns > 3 ? 'col-md-' : 'col-sm-') . intval(12 / $styleObject->columns);
			// carousels
			if ($isCarousel) :
				$slick = new StdClass();
				$slick->slidesToShow = $styleObject->columns;
				$slick->slidesToScroll = $styleObject->columns;
				$slick->margin = $styleObject->margin;
				$slick->dots = (bool)$o->carousel_dots;
				$slick->arrows = (bool)$o->carousel_arrows;
				$slick->infinite = (bool)$o->carousel_infinite;
				$slick->speed = (int)$o->carousel_speed;
				$slick->centerMode = (bool)$o->carousel_centerMode;
				$slick->variableWidth = (bool)$o->carousel_variableWidth;
				$slick->adaptiveHeight = (bool)$o->carousel_adaptiveHeight;
				$slick->autoplay = (bool)$o->carousel_autoplay;
				$slick->autoplaySpeed = (int)$o->carousel_autoplaySpeed;
				$vars['slick'] = $slick;
			endif;

			/***** Block related ****/
			$templateName = $b->getBlockFilename();
			$blockTypeHandle = str_replace('_', '-', $b->getBlockTypeHandle());
			$templateCleanName = str_replace('_', '-', substr(substr( $templateName, 0, strlen( $templateName ) -4 ),7)); // Retire le '.php' et 'anitya_'
			$vars['includeEntryText'] = ($controller->includeName || $controller->includeDescription || $controller->useButtonForLink) ? true :false;

			// Wrapper classes
			$wrapperClasses[] = 'ccm-' . $blockTypeHandle;
			$wrapperClasses[] =  $blockTypeHandle . '-' . $templateCleanName; //-> page-list-portfolio
			if ($isCarousel) 	$wrapperClasses[] = 'slick-wrapper ';
			if ($isMasonry) 	$wrapperClasses[] = 'masonry-wrapper';
			$wrapperClasses[] = 'wrapper-'. $styleObject->columns . '-column';
			$wrapperClasses[] = 'row';
			$wrapperClasses[] = (in_array('no-gap',$styleObject->classesArray)) ? 'no-gap' : 'with-gap';
			// Wrapper attributes
			$wrapperAtrtribute[] = 'data-bid="' . $b->getBlockID() . '"';
			if ($isMasonry) $wrapperAtrtribute[] = 'data-gridsizer=".' . $vars['column_class'] . '"';
			if ($isCarousel) $wrapperAtrtribute[] = 'data-slick=\'' . json_encode($slick) . '\'';
			// Finally, wrapper html
			$vars['wrapperOpenTag'] = '<div class="' . implode(' ', array_merge($wrapperClasses,$options['additionalWrapperClasses'])) . '" ' . implode(' ', $wrapperAtrtribute) . '>';
			$vars['wrapperCloseTag'] = '</div><!-- end .' . $blockTypeHandle . '-' . $templateCleanName . ' -->';
			// Item classes
			if(!$isCarousel) $itemClasses[] = $vars['column_class'];
			$itemClasses[] = 'item';
			if ($isMasonry) $itemClasses[] = 'masonry-item';
			// itemTag
			$itemAttributes = array();
			if($isCarousel) $itemAttributes[] = (in_array('no-gap',$styleObject->classesArray) ? '' : 'style="margin:0 15px"');

			/*****  Page related -- *****/

			foreach ($pages as $key => $page):
				$page->mclDetails = array();
				$externalLink = $page->getAttribute('external_link');
				$page->mclDetails['url'] = $externalLink ? $externalLink : $nh->getLinkToCollection($page);
				$page->mclDetails['popupClassLauncher'] = '';
				$page->mclDetails['render'] = false;
				$page->mclDetails['popup'] = false;

				// Popup
				if ($page->getPageTemplateHandle() == 'one_page_details' && $displayPopup):
					$v = $page->mclDetails['v'] = $page->getController()->getViewObject();
					$page->isPopup = true;
					$page->mclDetails['url'] = "#mcl-popup-{$page->getCollectionID()}";
					$page->mclDetails['popupClassLauncher'] = 'open-popup-link';
					$request->setCurrentPage($page);
					$page->mclDetails['render'] = $v->render("one_page_details");
					$page->mclDetails['popup'] = '<div class="white-popup mfp-hide large-popup" id="mcl-popup-' . $page->getCollectionID() .'">' . $page->mclDetails['render'] . '</div>';
					$request->setCurrentPage($c);
				endif;

				// target
				$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
				$target = empty($target) ? '_self' : $target;
				$page->mclDetails['target'] = $target;
				$page->mclDetails['link'] = 'href="' . $page->mclDetails['url'] . '"' . ' target="' . $page->mclDetails['target'] . '"';
				$page->mclDetails['to'] = $page->mclDetails['link'] . ' class="' . $page->mclDetails['popupClassLauncher'] . '"';

				// title
				$title_text =  $th->entities($page->getCollectionName());
				$page->mclDetails['title'] = $controller->useButtonForLink ? $title_text : ('<a ' . $page->mclDetails['to'] . '>' . $title_text . '</a>') ;

				// date
				$eventDate = $page->getAttribute($options['alternativeDateAttributeHandle']);
		    $page->mclDetails['date'] =  $eventDate ? $dh->formatDate($eventDate) : date('M / d / Y',strtotime($page->getCollectionDatePublic()));
				$page->mclDetails['rawdate'] =  $eventDate ? $dh->formatDate($eventDate) : strtotime($page->getCollectionDatePublic());

				// user
		    if ($displayUser) $page->mclDetails['original_author'] = Page::getByID($page->getCollectionID(), 1)->getVersionObject()->getVersionAuthorUserName();

				// tags
				$tagsArray = $tagsObject->pageTags[$page->getCollectionID()];
				$page->mclDetails['tagsArray'] = $tagsArray ? $tagsArray : array();

				// topics
				if ($displaytopics) $page->mclDetails['topics'] = $page->getAttribute($options['topicAttributeKeyHandle']);

				// description
				if ($controller->includeDescription):
					$description = $page->getCollectionDescription();
					$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
					$page->mclDetails['description'] = $th->entities($description);
				endif;

				// Icon
				$page->mclDetails['icon'] = $page->getAttribute('icon') ? "<i class=\"fa {$page->getAttribute('icon')}\"></i>" : false;

				// Thumbnail
		    if ($controller->displayThumbnail) :
		      $img_att = $page->getAttribute('thumbnail');
		      if (is_object($img_att)) :
		      	$img = Core::make('html/image', array($img_att, true));
		      	$page->mclDetails['imageTag'] = $img->getTag();
			      $page->mclDetails['thumbnailUrl'] = ($type != NULL) ? $img_att->getThumbnailURL($type->getBaseVersion()) : false;
					else :
						$page->mclDetails['imageTag'] = $page->mclDetails['thumbnailUrl'] = false;
		      endif;
		    endif;

				// Item classes
				$itemClassesTemp = $itemClasses;
				$itemClassesTemp[] = $key % 2 == 1 ? 'pair' : 'impair';
				$itemClassesTemp[] = $tagsArray ? implode(' ',$tagsArray) : '';
				// Item tag
				$page->mclDetails['itemOpenTag'] = (($key%$styleObject->columns == 0 && $isStaticGrid) ? '<div class="row">' : '') . '<div class="' . implode(' ', $itemClassesTemp) . '" ' . implode(' ', $itemAttributes) . '>';
				$page->mclDetails['itemCloseTag'] = '</div>' . (($key%$styleObject->columns == ($styleObject->columns) - 1 || ($key == count($fIDs)-1)) && $isStaticGrid ? '</div><!-- .row -->' : '');

			endforeach;
			if ($c->isEditMode() && $options['hideEditMode']) :
			    echo '<div class="ccm-edit-mode-disabled-item">';
					echo '<p style="padding: 40px 0px 40px 0px;">' .
						'[ ' . $blockTypeHandle . ' ] ' .
					  '<strong>' .
						ucwords($templateCleanName) .
						($isCarousel ? t(' carousel') : '') .
						($isMasonry ? t(' masonry') : '') .
						($isStaticGrid ? t(' static grid') : '') .
						'</strong>' .
						t(' with ') .
						$styleObject->columns .
						t(' columns and ') .
						(!(in_array('no-gap',$styleObject->classesArray)) ? t(' regular Gap ') : t('no Gap ')) .
						t(' disabled in edit mode.') .
						'</p>';
			    echo '</div>';
			endif;

			if ($controller->pageListTitle):
		    echo '<div class="page-list-header">';
		    echo '<h3>' . $controller->pageListTitle . '</h3>';
		    echo '</div>';
			endif;

			if (!$c->isEditMode() && $isMasonry)
				Loader::PackageElement("page_list/sortable", 'theme_anitya', array('o'=>$o,'tagsObject'=>$tagsObject,'bID'=>$b->getBlockID(),'styleObject'=>$styleObject));

			return $vars;

		}


	  function contrast ($hexcolor, $dark = '#000000', $light = '#FFFFFF') {
	      return (hexdec($hexcolor) > 0xffffff/2) ? $dark : $light;
	  }


}
