<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
$open = $pageTheme->getClassSettingsPrefixInt($b,'open');
extract($pageTheme->getPageListVariables($b,$controller,$pages,array('topics'=>true,'forcePopup'=>true)));
if (!$c->isEditMode()) :
?>

<div class="anitya-accordion">
	 <dl>
	 	<?php  foreach ($pages as $key => $page): extract($page->mclDetails);	?>
   	<dt class="title <?php echo $key === $open ? 'active' : '' ?>">
        <a href="">
					<?php echo $icon ? ($icon . ' ') : ''  ?>
					<?php echo $includeName ? $title : t('Title ') . $key ?>
            <i class='fa fa-chevron-down icon switch'></i>
        </a>
    </dt>
    <dd class="content <?php echo $key === $open ? 'active' : '' ?>">
			<div class='content-inner clearfix'>
			<?php if ($page->isPopup): ?>
				<?php if (!$c->isEditMode()) :
					echo $render;
				endif ?>
			<?php else : ?>
				<?php  if ($thumbnailUrl) : ?>
				<div class="page-list-accordion-thumbnail">
					<img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title ?>">
				</div>
				<?php  endif ?>
				<div class="info">
	        <?php  if($includeDate): ?><p class="date"><?php  echo $date ?></p><?php  endif ?>
	        <?php  if (is_array($topics)): ?>
	        <p><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p>
	        <?php  endif ?>
				</div>
					<?php  if ($includeDescription): ?><p class="desc"><small><?php  echo $description ?></small></p><?php  endif ?>
					<?php if ($useButtonForLink): ?>
					<div class="read-more">
					    <a href="<?php echo $url?>" class="btn btn-primary"><?php echo $buttonLinkText?></a>
					</div>
					<?php endif; ?>
			<?php endif; ?>
			</div>
    </dd>
	<?php  endforeach ?>
</div><!-- end .anitya-accordion -->
<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages)) ?>
<?php  endif ?>
