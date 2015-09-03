<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>
<!DOCTYPE html>
<html lang="<?php  echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?php  Loader::element('header_required', array('pageTitle' => $pageTitle));?>
    <?php  echo $html->css($view->getStylesheet('main.less')); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
