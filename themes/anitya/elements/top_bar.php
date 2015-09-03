<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<header class="container top-bar">
   <div class="top-nav-inner clearfix">
        <div class="logo">
            <?php 
            $a = new GlobalArea('Header Site Title');
            $a->display();
            ?>                            
        </div>
        <nav class="main-nav">
            <?php 
            $a = new GlobalArea('Header Navigation');
            $a->display();
            ?>
        </nav>
    </div><!-- /.top-nav-inner -->
</header>

