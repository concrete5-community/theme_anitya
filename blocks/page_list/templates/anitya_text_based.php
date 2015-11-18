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
				<a href="<?php  echo $url ?>" target="<?php  echo $target ?>">
					<?php  if($includeDate) : ?><p class="date"><strong><?php  echo $date ?></strong></p><?php  endif ?>
					<?php  if ($includeName): ?><h2 class="title"><?php  echo $title ?></h2><?php endif ?>
					<hr class="primary">
					<?php if (count($options)): ?><div class="tags"><i class="fa fa-tags"></i>  <?php foreach($options as $option) : ?><small class="tag"><?php  echo $option->getSelectAttributeOptionValue()?></small><?php endforeach ?></div><?php endif ?>
			     <?php  if ($includeDescription): ?><p class="desc"><?php  if ($thumbnailUrl) : ?><img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title_text ?>"><?php  endif ?><small><?php  echo $description ?></small></p><?php  endif ?>
				</a>
			   <?php  if (is_array($topics)): ?><p><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p><?php  endif ?>
			</div>
			<?php echo $popup ?>
		<?php echo $itemCloseTag ?>
	<?php  endforeach; ?>
	<?php echo $wrapperCloseTag ?>
	<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif; ?>
