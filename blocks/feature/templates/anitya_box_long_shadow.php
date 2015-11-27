<?php   defined('C5_EXECUTE') or die("Access Denied.");
if ($linkURL) {
    $title = '<a href="' . $linkURL . '">' . $title . '</a>';
} ?>
<div class="box-long-shadow feature-item run3 detect hide-hover">
	<div class='square-box'>
	    <div class='square-content to-hide'>
	    	<div>
	    		<span>
	    			<i class="fa fa-<?php  echo $icon?> primary long-shadow"></i>
	    		</span>
	    	</div>
	    </div>
	    <div class='square-content'>
	    	<div>
	    		<span>
	    			<i class="fa fa-<?php  echo $icon?> secondary long-shadow"></i>
	    		</span>
	    	</div>
	    </div>
	</div>
	    <?php  if ($title) { ?>
	        <h4 class="box-arrow block primary"> <?php  echo $title?></h4>
	    <?php  } ?>
	    <?php  if ($paragraph) { ?>
	        <p><?php  echo $paragraph?></p>
	    <?php  } ?>
</div>
