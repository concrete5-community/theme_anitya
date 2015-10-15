<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$options = array(
    array(
        "name" => t("Layout"),
        "icon" => 'fa-file',
        "type" => "section",
        "desc" => t('For each page of the site play with these options to fine tunne design details as optionnal Area, Boxed layout, Side-bar size..')
    ),
    array(
        "name" => t("Enable responsive layout"),
        "desc" => t("If enabled, all layouts will be adapted for small screen. If disabled the site will be rendered as desktop on mobile & tablets"),
        "id" => "responsive",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
        "name" => t("Layout mode"),
        "desc" => t("Each page templates can be displayed in a wide or a Boxed format. Boxed format use the color 'boxed-background-color' as background"),
        "id" => "layout_mode",
        "default" => "wide-wrapper",
        "options" => array(
            'boxed-wrapper' => t("Boxed"),
            'wide-wrapper' => t("Wide")
        ),
        "default" => "wide-wrapper",
        "type" => "select"
    ),

    // array(
    //     'name' => t('Page List'),
    //     "desc" => t('Options for the Built-in "Autonav" block'),
    //     'type' => 'subsection'
    // ),
    //
    // array(
    //     "name" => t("Icon class on left of each navigation title"),
    //     "desc" => t("Pick a icon from the <a href='http://fontawesome.io/icons/'>FontAwesome</a> Librairy. this icon will be used throught all autonav template"),
    //     "id" => "default_nav_block_icon",
    //     "type" => "awesome",
    //     "default" => 'fa-chevron-circle-right'
    // ),

    // Navigation


    array(
        "name" => t("Anitya Navigation"),
        "desc" => t('This section display options for the Header navigation'),
        "icon" => 'fa-list',
        "type" => "section"
    ),

    array(
        "name" => t("Choose a page for searching result"),
        "desc" => t("Display Search box in the top of the page if a page is selected. Add a block search on this page to display result."),
        "id" => "display_searchbox",
        "default" => '0',
        "quick" => false,
        "activated" => true,
        "type" => "page"
    ),
    array(
        "name" => t("Display search box in responsive top bar"),
        "id" => "display_responsive_searchbox",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
        "name" => t("Display icon on first level if available"),
        "desc" => t("If the atrtribute 'icon' is filled on a first-level page it will be displayed in the top-nav"),
        "id" => "first_level_nav_icon",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
        "name" => t("Auto hidde top-bar"),
        "desc" => t("If enabled, the small toolbar is hidde during scroll."),
        "id" => "auto_hidde_top_bar",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
       "name" => t("Wheight of the bar on top of selected/hover menu item"),
       "desc" => t("if 0 the bar will be disabled desactivated "),
       "id" => "header_nav_selected_bar_wheight",
       "min" => "1",
       "max" => "40",
       "step" => "1",
       "unit" => 'px',
       "default" => "3",
       "type" => "range"
   ),

    // multicolumns

    array(
        'name' => t('Dropdown multicolumns mode'),
        "desc" => t('Options When the nav is in dropdown mode and the attribute "Display multi-columns dropdown" is activated'),
        'type' => 'subsection'
    ),
     array(
        "name" => t("Number of link per columns"),
        "desc" => t("This setting allow you to set the number of items by columns (only if the \"breack by parent\" (below)) is desactivated "),
        "id" => "nav_multicolumns_item_per_column",
        "min" => "1",
        "max" => "40",
        "step" => "1",
        "unit" => 'link',
        "default" => "5",
        "type" => "range"
    ),
    array(
        "name" => t("Activate the break by parent"),
        "desc" => t("The number of columns is detreminated by the number of child page in second level"),
        "id" => "break_columns_on_child",
        "default" => 1,
        "type" => "toggle"
    ),


    // Full screen



    array(
        'name' => t('Responsive full width mode'),
        "desc" => t('Options When the nav showed on mobile'),
        'type' => 'subsection'
    ),
    array(
        "name" => t("Display the stack 'Site Logo' on the mobile nav"),
        "desc" => t("If enabled the content of the stack will be displayed at left"),
        "id" => "display_logo_mobile_nav",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
        "name" => t("Display the regular Area Logo on Mobile"),
        "desc" => t("If disabled, the Logo will be hidden when the mobile nav is shown"),
        "id" => "display_main_logo_on_mobile",
        "default" => 0,
        "type" => "toggle"
    ),
    array(
       "name" => t("Font size for links items"),
       "id" => "full_screen_nav_font_size",
       "min" => "10",
       "max" => "50",
       "step" => "1",
       "unit" => 'px',
       "default" => "20",
       "type" => "range"
   ),


  // Responsive Lateral nav

   array(
       'name' => t('Responsive Lateral Nav (mmenu)'),
       "desc" => t('Options the autonav template is "Anitya  Mmenu"'),
       'type' => 'subsection'
   ),
   array(
       "name" => t("Choose the theme"),
       "desc" => t("Theme for Mmenu"),
       "id" => "mmenu_theme",
       "default" => 'light',
       "options" => array(
           'light' => t("Light gray background"),
           'dark' => t("Quaternary background"),
           'white' => t("White background"),
           'black' => t("Black background")
       ),
       "type" => "select"
   ),
   array(
       "name" => t("Choose the Position"),
       "desc" => t("By default, the menu will always slide the page out to the right but you can change it."),
       "id" => "mmenu_position",
       "default" => 'left',
       "options" => array(
           'left' => t("Left"),
           'right' => t("Right")
       ),
       "type" => "select"
   ),
   array(
       "name" => t("Pane shadow"),
       "desc" => t("Enable If you want the page to have a shadow to emphasize it's in front of the menu"),
       "id" => "mmenu_shadow",
       "default" => 0,
       "type" => "toggle"
   ),
   array(
       "name" => t("Display Icon"),
       "id" => "mmenu_display_icon",
       "default" => 0,
       "type" => "toggle"
   ),
    // mega-menu
    array(
        "name" => t("Mega menu options"),
        "desc" => t('Options when a parent page display a Stack as mega-menu'),
        "icon" => 'fa-th-list',
        "type" => "subsection"
    ),
    array(
        "name" => t("Block title when exist"),
        "desc" => t("Display the block name as title"),
        "id" => "display_title_mega_menu",
        "default" => 0,
        "type" => "toggle"
    ),


    // Footer


    array(
        'name' => t('Footer'),
        "desc" => t('Options for the Footer section'),
        'icon' => 'fa-toggle-down',
        'type' => 'section'
    ),
    array(
        "name" => t("Display Footer"),
        "id" => "display_footer",
        "default" => 1,
        "activated" => false,
        "type" => "toggle"
    ),
    array(
        "name" => t("Footer column"),
        "desc" => t("How many column you want in the footer"),
        "id" => "display_footer_column",
        "default" => "half_two",
        "options" => array(
            1 => t("One"),
            2 => t("Two"),
            3 => t("Three"),
            4 => t("Four"),
            "half_two" => t("One Half and two"),
            "half_three" => t("One Half and three")
        ),
        "type" => "select"
    ),
    array(
        "name" => t("Make Footer Global"),
        "desc" => t("If enabled, Block on footer will be Globals"),
        "id" => "footer_global",
        "default" => 1,
        "type" => "toggle"
    ),
    array(
        "name" => t("RAW HTML Credits"),
        "desc" => t("If you want to change it, feel free"),
        "id" => "footer_credit",
        "cols" => 40,
        "type" => "textarea",
        "default" => '<span><i class="fa fa-magic"></i> Designed by <a href="http://www.myconcretelab.com/" rel="Concrete5 theme & addons" title="Concrete5 themes & addons by MyConcreteLab">MyConcreteLab</a></span><span class="powered-by"><i class="fa fa-cogs"></i> Powered by <a href="http://www.concrete5.org" title="concrete5 - open source content management system for PHP and MySQL">concrete5</a></span>'
    ),
    array(
        "name" => t("Disable Footer login links"),
        "desc" => t("If enabled, you will not see login links in the footer"),
        "id" => "disable_footer_login",
        "default" => 0,
        "type" => "toggle"
    ),


    // Popup


    array(
        'name' => t('Popup'),
        "desc" => t(''),
        'icon' => 'fa-plus-square-o',
        'type' => 'section'
    ),
    array(
        'name' => t('CSS transitions for popup'),
        "desc" => t('Here you can set transitions for popups'),
        'type' => 'subsection'
    ),
    array(
        "name" => t("content at start"),
        "desc" => t("CSS only"),
        "id" => "popup_content_start_css",
        "type" => "textarea",
        "default" => "opacity: 0;\n transform: translateY(-20px) perspective( 2000px ) rotateX( 10deg );"
    ),
    array(
        "name" => t("content animate it"),
        "desc" => t("CSS only"),
        "id" => "popup_content_animate_css",
        "type" => "textarea",
        "default" => 'opacity: 1; transform: translateY(0) perspective( 600px ) rotateX( 0 );'
    ),
    array(
        "name" => t("content animate out"),
        "desc" => t("CSS only"),
        "id" => "popup_content_out_css",
        "type" => "textarea",
        "default" => 'opacity: 0; transform: translateY(-20px) perspective( 2000px ) rotateX( 10deg );'
    ),
    array(
        'name' => t('Button type for popup'),
        "desc" => t('Here you can set type of button for popup'),
        'type' => 'subsection'
    ),
    array(
        "name" => t("Button type for popup'"),
        "desc" => t("Choose between three style of button"),
        "id" => "popup_button_type",
        "default" => "button-push",
        "options" => array(
            'button-push' => t("Push"),
            'button-flat' => t("Flat"),
            'button-plain' => t("Plain")
        ),
        "type" => "select"
    ),
    array(
        "name" => t("Button color for popup'"),
        "desc" => t("Choose between four colors"),
        "id" => "popup_button_color",
        "default" => "button-primary",
        "options" => array(
            '' => t("Default"),
            'button-primary' => t("Primary"),
            'button-success' => t("Succes"),
            'button-info' => t("Info"),
            'button-warning' => t("Warning"),
            'button-danger' => t("Danger")
        ),
        "type" => "select"
    ),
    array(
        'name' => t('Miscalenous'),
        "desc" => t(''),
        'icon' => 'fa-question-circle',
        'type' => 'section'
    ),
    array(
        "name" => t("Activate iFrame z-index script"),
        "desc" => t("This script fix a iFrame z-index isue on certain condition."),
        "id" => "fix_iframe_zindex",
        "default" => 0,
        "activated" => true,
        "type" => "toggle"
    ),
    array(
        'type' => 'submit',
        'name' => t("Save")
    )
);
if (!isset($passThrough))
new Concrete\Package\ThemeAnitya\Src\Helper\MclOptionsGenerator($options, $pID, $this->action('save_options'), $this->action('view'));
