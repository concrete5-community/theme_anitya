<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<header class="container top-bar">
   <div class="row">
        <div class="col-md-3 logo">
            <?php
            $a = new GlobalArea('Header Site Title');
            $a->display();
            ?>
        </div>
        <nav class="col-md-9 main-nav">
            <?php
            $a = new GlobalArea('Header Navigation');
            $a->display();
            ?>
        </nav>
    </div><!-- /.top-nav-inner -->
</header>
