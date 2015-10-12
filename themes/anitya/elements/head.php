<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>
<!DOCTYPE html>
<html lang="<?php  echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?php  Loader::element('header_required', array('pageTitle' => $pageTitle));?>
    <?php  echo $html->css($view->getStylesheet('main.less')); ?>
    <?php if (Loader::helper('concrete/ui')->showWhiteLabelMessage()) :?><style media="screen">body div#ccm-toolbar>ul>li#ccm-white-label-message{display: none !important}</style><?php endif ?>
    <link rel="stylesheet" href="<?php echo URL::to("/ThemeAnitya/tools/override") . '?cID=' . $c->cID ?>" id="css-override" type="text/css" />
    <link rel="stylesheet" href="<?php echo Concrete\Package\ThemeAnitya\Controller\Tools\FontsTools::getFontsURL() ?>" id="css-fonts" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
    </script>
</head>
<body class="<?php  echo $c->isEditMode() ? 'edit-mode' : '' ?> <?php  $p = new Permissions($c) ; if($p->canAdminPage()): ?>edit-bar <?php  endif ?>">
    <!-- Responsive Nav -->
    <div class="small-display-nav-bar">
        <?php
        $a = new GlobalArea('Responsive Navigation');
        $a->display();
        ?>
    </div>
    <!-- End Responsive Nav -->
    <div class="<?php  echo $c->getPageWrapperClass()?> <?php echo $c->getAttribute('boxed_layout_mode') ? 'boxed-wrapper' : '' ?>">
        <div class="an">
