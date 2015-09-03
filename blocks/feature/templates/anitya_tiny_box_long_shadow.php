<?php   defined('C5_EXECUTE') or die("Access Denied.");
if ($linkURL) {
    $title = '<a href="' . $linkURL . '">' . $title . '</a>';
} ?>
<div class="box-tiny-long-shadow hide-hover feature-item run-wrap">
	<div class="content clear-after detect run">
		<div class="icon">
			<div class='square-box'>
			    <div class='square-content'>
			    	<div>
			    		<span>
			    			<i class="fa fa-<?php  echo $icon?> secondary long-shadow"></i>
			    		</span>
			    	</div>
			    </div>
			    <div class='square-content to-hide'>
			    	<div>
			    		<span>
			    			<i class="fa fa-<?php  echo $icon?> primary long-shadow"></i>
			    		</span>
			    	</div>
			    </div>
			</div>
		</div>		
	    <?php  if ($title) { ?>
	        <p class="title"><strong><?php  echo $title?></strong></p>
	    <?php  } ?>
	    <?php  if ($paragraph) { ?>
	        <p><small><?php  echo $paragraph?></small></p>
	    <?php  } ?>
	</div>
</div>