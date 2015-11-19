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
				<a href="<?php  echo $url ?>">
					<?php if ($imageTag) : echo $imageTag; else:?><div class="placeholder"></div><?php endif ?>
					<div class="infos">
						<?php  if ($includeName): ?><h2><?php  echo $title ?></h2><?php  endif ?>
						<?php  if ($includeDescription): ?><p><?php  echo $description ?></p><?php  endif ?>
						<?php  if (is_array($topics)): ?><p class="topics"><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p><?php  endif ?>
						<?php  if ($includeDate) : ?><small><?php  echo $date ?></small><?php  endif ?>
					</div>
				</a>
			</div>
			<?php echo $popup ?>
		<?php echo $itemCloseTag ?>
	<?php  endforeach; ?>
	<?php echo $wrapperCloseTag ?>
	<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif; ?>
