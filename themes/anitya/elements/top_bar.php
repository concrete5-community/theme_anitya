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
        <nav class="col-md-8 main-nav">
            <?php
            $a = new GlobalArea('Header Navigation');
            $a->display();
            ?>
        </nav>
        <div class="col-md-1 search-container">
          <?php if($o->display_searchbox || true) :
        		$p = Page::getByID(1);//$o->display_searchbox);
        		if (is_object($p)) :

        		// echo '<li class="search-in-nav">';
        		?>
        		<form action="<?php  echo  Loader::helper('navigation')->getCollectionURL($p)?>" id="expand-search">
        			<input id="search-box" type="text" class="search-box" name="query" />
        		  <label for="search-box"><i class="fa fa-search search-icon"></i></label>
        		  <input type="submit" id="search-submit" />
        		</form>
        		<!-- </li> -->
        		<?php endif ?>
        	<?php endif ?>
        </div>
    </div><!-- /.top-nav-inner -->
</header>
