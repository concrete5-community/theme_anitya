<?php   defined('C5_EXECUTE') or die("Access Denied.");
if ($linkURL) {
    $title = '<a href="' . $linkURL . '">' . $title . '</a>';
} ?>
<div class="feature-item">
	<div class="flip" ontouchstart="this.classList.toggle('hover');">
		<div class="flipper">
      <div class='square-box'>
    	  <div class='square-content to-hide'>
    	  	<div>
    	  		<span>&nbsp;</span>
    	  	</div>
    	  </div>
      </div>
			<div class="front">
				<div class='square-box'>
				    <div class='square-content area-primary'>
				    	<div>
				    		<span>
				    			<i class="fa fa-<?php  echo $icon?> fa-4x primary-long-shadow"></i>
			    			    <?php  if ($title) :?>
							        <h4> <?php  echo $title?></h4>
							    <?php  endif ?>
				    		</span>

				    	</div>
				    </div>
				</div>
			</div>
			<div class="back">
				<div class='square-box'>
				    <div class='square-content area-primary'>
				    	<div>
						    <?php  if ($paragraph) : ?>
						        <p><?php  echo $paragraph?></p>
						    <?php  endif ?>

				    	</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
