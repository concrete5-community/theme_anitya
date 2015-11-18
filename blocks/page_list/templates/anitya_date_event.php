<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
  echo $wrapperOpenTag;
  foreach ($pages as $key => $page): extract($page->mclDetails);
  	echo $itemOpenTag;?>
		<div class="inner">
			<div class="meta clearfix">
				<p class="ribbon primary pull-left">
		      <a <?php echo $to ?>><?php  echo $date; ?></a>
				</p>
				<div class="tags pull-left">
					<?php  foreach($tagsArray as $handle) : ?><small class="tag"><?php  echo $handle ?></small><?php  endforeach ?>
				</div>
			</div>
			<div class="content clearfix">
				<?php  if ($includeName): ?><h6><?php  echo $title ?></h6><?php  endif ?>
		    <?php  if ($includeDescription): ?><p><small><?php  echo $description ?></small></p><?php  endif; ?>
				<?php  if ($useButtonForLink): ?><a <?php echo $link ?> class="pull-right"><?php  echo $buttonLinkText?></a><?php  endif; ?>
			</div>
		</div>
		<?php echo $popup ?>
	<?php echo $itemCloseTag ?>
	<?php  endforeach; ?>
	<?php echo $wrapperCloseTag ?>
	<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif; ?>
