<?php
namespace Concrete\Package\ThemeAnitya\Controller\SinglePage\Dashboard\AnityaOptions;

defined('C5_EXECUTE') or die(_("Access Denied."));

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Package\ThemeAnitya\Controller\SinglePage\Dashboard\AnityaOptions as SmController;

class Fonts extends SmController {


    function view() {

        parent::view();


    }

    function save_options($POST = null) {

        parent::save_options($_POST);
    }

}
