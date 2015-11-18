<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
  echo $wrapperOpenTag;
  foreach ($pages as $key => $page): extract($page->mclDetails);
  	echo $itemOpenTag;?>
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
<?php echo $itemCloseTag ?>
<?php  endforeach; ?>
<?php echo $wrapperCloseTag ?>
<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php endif ?>
