<?php  defined('C5_EXECUTE') or die("Access Denied."); 
$footer_top = new Area('Footer');
$display_footer_top = (is_object($footer_top) ? ($footer_top->getTotalBlocksInArea($c) > 0) : 0) || $c->isEditMode();

?>

<footer>
    <?php  if ($display_footer_top) : ?>
    <section id="footer-top">
        <?php 
        $footer_top->enableGridContainer();
        $footer_top->display($c);
        ?>

    </section>
    <?php  endif ?>
    <section id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    $a = new GlobalArea('Footer 1');
                    $a->display();
                    ?>        
                </div>
                <div class="col-sm-3">
                    <?php 
                    $a = new GlobalArea('Footer 2');
                    $a->display();
                    ?>        
                </div>
                <div class="col-sm-3">
                    <?php 
                    $a = new GlobalArea('Footer 3');
                    $a->display();
                    ?>        
                </div>
            </div>        
        </div>    
    </section>
</footer>

<footer id="concrete5-brand">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span><?php  echo t('Built with <a href="http://www.concrete5.org" class="concrete5">concrete5</a> CMS.')?></span>
                <span><a href="http://myconcretelab.com"><?php  echo t('Theme by myconcretelab') ?></a></span>
                <span class="pull-right">
                    <a href="<?php  echo URL::to('/login')?>">Login</a>
                </span>
            </div>
        </div>
    </div>
</footer>


<?php  $this->inc('elements/footer_bottom.php');?>