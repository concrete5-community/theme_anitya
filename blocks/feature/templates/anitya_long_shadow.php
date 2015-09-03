<?php   defined('C5_EXECUTE') or die("Access Denied.");
if ($linkURL) {
    $title = '<a href="' . $linkURL . '">' . $title . '</a>';
} ?>
<div class="long-shadow feature-item ">
	<div class="icon">
		<i class="fa fa-<?php  echo $icon?> fa-4x long-shadow primary fa-align-center"></i>	
	</div>
	
	    <?php  if ($title) { ?>
	        <h4 class="box-arrow primary full big"> <?php  echo $title?></h4>
	    <?php  } ?>
	    <?php  if ($paragraph) { ?>
	        <p><?php  echo $paragraph?></p>
	    <?php  } ?>
</div>