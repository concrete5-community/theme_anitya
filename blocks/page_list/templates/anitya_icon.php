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
				<a <?php echo $to ?>>
					<div class="iconwrapper"><?php echo $icon ?></div>
					<div class="text">
		        <?php  if($includeDate): ?><h3 class="date"><?php  echo $date ?></h3><?php  endif ?>
		        <?php  if (is_array($topics)): ?><p><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p><?php  endif ?>
						<?php  if ($includeName): ?><h5><?php  echo $title ?></h5><?php  endif ?>
	          <?php  if ($includeDescription): ?><p class="desc"><small><?php  echo $description ?></small></p><?php  endif ?>
					</div>
				</a>
				<?php echo $popup ?>
			</div>
		<?php echo $itemCloseTag ?>
	<?php  endforeach ?>
  <?php echo $wrapperCloseTag ?>
  <?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif ?>
