<?php 
namespace Concrete\Package\ThemeAnitya\Theme\Anitya;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {
         
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'bootstrap/dropdown');
        $this->requireAsset('javascript', 'imagesloaded');        
        $this->requireAsset('javascript', 'masonry');
        $this->requireAsset('javascript', 'flickity');        
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
        $this->requireAsset('css', 'flickity');
        $this->requireAsset('css', 'slick');
        $this->requireAsset('css', 'slick-theme');
        $this->requireAsset('css', 'jquery/ui');
        $this->requireAsset('css', 'bootsrap-custom');
         
	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
        return array(
            'page_list' => array('sidebar-wrapped','accordion-primary','accordion-secondary','accordion-tertiary','accordion-quaternary','accordion-light',
                                          'slider-dots-primary', "slider-dots-white", "slider-dots-black"),
            'content' => array('sidebar-wrapped', 'white-block', 'primary-block', 'secondary-block', 'tertiary-block', 'quaternary-block'),
            'autonav' => array('sidebar-wrapped', 'small-text-size'),
            'horizontal_rule' => array('space-s','space-m','space-l','space-xl','thin','primary','secondary','tertiary','quaternary'),
            'topic_list' => array('sidebar-wrapped'),
            'image' => array('responsive', 'svg-primary','svg-quaternary',),
            'testimonial' => array ('primary','secondary','tertiary','quaternary','white'),
            'core_stack_display' => array('accordion-primary','accordion-secondary','accordion-tertiary','accordion-quaternary','accordion-light',
                                          'slider-dots-primary', "slider-dots-white", "slider-dots-black")

        );
    }
    
    public function getThemeAreaClasses()
    {
        // For multiple area
        $main_area = array('Main');
        $area_classes = array('primary','secondary','tertiary','quaternary','white','black','grid-overlay', 'space-s','space-m','hr-bold', 'border-thin','border-bold','border-bold-primary','border-bold-secondary','border-bold-tertiary','border-bold-quaternary','border-bold-white');
        for ($i=1; $i < 8; $i++) { 
            $main_area['Main - ' . $i] = $area_classes;
        }
        // Default array
        $other_area = array(
            'Main' => $area_classes,
            'Page Footer' => array('primary, secondary, tertiary')
        );

        return array_merge($main_area,$other_area);
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Box arrow'), 'menuClass' => '', 'spanClass' => 'box-arrow'),
            array('title' => t('Box arrow Secondary'), 'menuClass' => '', 'spanClass' => 'box-arrow secondary'),
            array('title' => t('Button Primary'), 'menuClass' => '', 'spanClass' => 'btn btn-primary'),
            array('title' => t('Button Primary Large'), 'menuClass' => '', 'spanClass' => 'btn btn-primary btn-lg'),
            array('title' => t('Button Default'), 'menuClass' => '', 'spanClass' => 'btn btn-default'),
            array('title' => t('Button Default Large'), 'menuClass' => '', 'spanClass' => 'btn btn-default btn-lg'),
            array('title' => t('Button Block'), 'menuClass' => '', 'spanClass' => 'btn btn-default btn-block'),
            array('title' => t('Button Block Primary'), 'menuClass' => '', 'spanClass' => 'btn btn-primary btn-block'),
            array('title' => t('Lead'), 'menuClass' => '', 'spanClass' => 'lead'),
            array('title' => t('Decorative Header'), 'menuClass' => '', 'spanClass' => 'head-1'),
            array('title' => t('Code'), 'menuClass' => '', 'spanClass' => 'code')
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
}

