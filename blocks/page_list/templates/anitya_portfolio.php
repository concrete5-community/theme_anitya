<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
Loader::PackageElement("page_list/sortable", 'theme_anitya', array('o'=>$o,'tagsObject'=>$tagsObject,'bID'=>$bID,'styleObject'=>$styleObject))?>

<div class="ccm-page-list masonry-wrapper row <?php echo $gap ?>" <?php echo $masonryWrapperAttributes ?>>
	<?php  foreach ($pages as $page):	extract ($page->mclDetails)?>
		<div class="<?php echo $column_class?> item masonry-item <?php echo $tags ?>">
			<?php if (!$useButtonForLink): ?><a href="<?php echo $url ?>" target="<?php echo $target ?>" class="<?php echo $popupClassLauncher ?>"><?php endif ?>
			<?php if ($imageTag) : echo $imageTag; else:?><div class="placeholder"></div><?php endif ?>
			<?php if ($includeEntryText): ?>
			<div class="info">
				<div class="vertical-align">
          <?php if ($includeDate): ?>
            <div class="meta">
            	<small><i class="fa fa-calendar-o"></i> <?php echo $date?></small>
            	<?php if($o->carousel_meta) : ?><small> <i class="fa fa-user"></i> <?php echo $original_author ?></small><?php endif ?>
            </div>
          <?php endif; ?>
					<?php if ($includeName): ?><h4><?php echo $title ?></h4><?php endif ?>
					<?php if ($includeDescription): ?><p><?php  echo $description ?></p><?php endif ?>
		      <?php if ($useButtonForLink): ?><a href="<?php echo $url?>" class="button-primary button-flat button-tiny <?php echo $popupClassLauncher ?>"><?php echo $buttonLinkText?></a><?php endif ?>
				</div>
			</div>
			<?php endif ?>
			<?php if (!$useButtonForLink): ?></a><?php endif ?>
			<?php echo $popup ?>
   		</div>
	<?php  endforeach; ?>
</div><!-- end .ccm-page-list -->
<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages)) ?>
<style>
	#slick-wrapper-<?php echo $bID?> .slick-slide {margin:0 <?php echo $options->margin ?>px}
	#slick-wrapper-<?php echo $bID?> .slick-next {margin-right:<?php echo $options->margin ?>px}
</style>
<?php endif ?>
