<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
Loader::PackageElement("page_list/sortable", 'theme_anitya', array('o'=>$o,'tagsObject'=>$tagsObject,'bID'=>$bID,'styleObject'=>$styleObject))?>

<div class="page-list event-date masonry-wrapper row <?php echo $gap ? 'with-gap' : 'no-gap' ?>" data-gridsizer=".<?php echo $column_class?>" data-bid="<?php echo $bID?>">
<?php  foreach ($pages as $key => $page): extract($page->mclDetails);	?>
	<div class="event <?php echo $column_class?> item masonry-item <?php echo $tags ?>">
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
  </div>
	<?php  endforeach; ?>
	</div><!-- end .ccm-block-page-list -->
<?php  endif; ?>
