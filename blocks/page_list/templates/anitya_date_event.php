<?php
defined('C5_EXECUTE') or die("Access Denied.");

	$c = Page::getCurrentPage();
	$pageTheme = $c->getCollectionThemeObject();
	$o = $pageTheme->getOptions();
	$t =  $c->getCollectionThemeObject();
	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
	$dh = Core::make('helper/date');
	$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');
	$tagsObject = $pageTheme->getPageTags($pages);

	if ($includeName || $includeDescription || $useButtonForLink) $includeEntryText = true; else $includeEntryText = false;
	$styleObject = $t->getClassSettingsObject($b);
	$column_class = $styleObject->columns > 3 ? 'col-md-' : 'col-sm-';
	$gap = !(in_array('no-gap',$styleObject->classesArray));

// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";
	$alternativeDateAttributeHandle = 'event_date';


	if ($c->isEditMode()) : ?>
		<?php $templateName = $controller->getBlockObject()->getBlockFilename() ?>
	    <div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
					<p style="padding: 40px 0px 40px 0px;"><strong><?php echo  ucwords(str_replace('_', ' ', substr( $templateName, 0, strlen( $templateName ) -4 ))) . '</strong>' . t(' with ') .  $styleObject->columns . t(' columns and ') . ($gap ? t(' regular Gap ') : t('no Gap ')) . t(' disabled in edit mode.') ?></p>
	    </div>
	<?php else :?>

<?php Loader::PackageElement("page_list/sortable", 'theme_anitya', array('o'=>$o,'tagsObject'=>$tagsObject,'bID'=>$bID,'styleObject'=>$styleObject))?>
<div class="page-list event-date page-list-masonry row <?php echo $gap ? 'with-gap' : 'no-gap' ?>" data-gridsizer=".<?php echo $column_class . intval(12 / $styleObject->columns)?>" data-bid="<?php echo $bID?>">

    <?php  if ($pageListTitle): ?>
    <div class="page-list-header">
        <h3><?php  echo $pageListTitle?></h3>
    </div>
    <?php  endif; ?>

	<?php  foreach ($pages as $page):
		$title_text =  $th->entities($page->getCollectionName());
		$title = $useButtonForLink ? $title_text : "<a href=\"$url\" target=\"$target\">$title_text</a>" ;
		$url = $nh->getLinkToCollection($page);
		$eventDate = $page->getAttribute($alternativeDateAttributeHandle);
    $date =  $eventDate ? $dh->formatDate($eventDate) : $dh->formatDate($page->getCollectionDatePublic());
		$tags = isset($tagsObject->pageTags[$page->getCollectionID()]) ? implode(' ',$tagsObject->pageTags[$page->getCollectionID()]) : '';

		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;

		if ($includeDescription):
			$description = $page->getCollectionDescription();
			$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
			$description = $th->entities($description);
		endif;

		$topics = $page->getAttribute($topicAttributeKeyHandle);
    $options = $page->getAttribute($tagAttributeHandle);
    $options = is_object($options)  ? $options->getOptions() : array();
        ?>
	<div class="event <?php echo $column_class . intval(12 / $styleObject->columns)?> item masonry-item <?php echo $tags ?>">
		<div class="inner">
			<div class="meta clearfix">
				<p class="ribbon primary pull-left">
		      <a href="<?php  echo $url ?>" target="<?php  echo $target ?>"><?php  echo $date; ?></a>
				</p>
				<div class="tags pull-left">
					<?php  foreach($options as $option) : ?><small class="tag"><?php  echo $option->getSelectAttributeOptionValue()?></small><?php  endforeach ?>
				</div>
			</div>
			<div class="content clearfix">
				<?php  if ($includeName): ?><h6><?php  echo $title ?></h6><?php  endif ?>
		    <?php  if ($includeDescription): ?><p><small><?php  echo $description ?></small></p><?php  endif; ?>
				<?php  if ($useButtonForLink): ?><a href="<?php  echo $url?>" class="pull-right"><?php  echo $buttonLinkText?></a><?php  endif; ?>
			</div>
		</div>
  </div>
	<?php  endforeach; ?>

    <?php  if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php  echo $noResultsMessage?></div>
    <?php  endif;?>

	</div><!-- end .ccm-block-page-list -->
	<div class="rss">
		<?php  if ($showRss): ?>
			<div class="ccm-block-page-list-rss-icon">
				<a href="<?php  echo $rssUrl ?>" target="_blank"><img src="<?php  echo $rssIconSrc ?>" width="14" height="14" alt="<?php  echo t('RSS Icon') ?>" title="<?php  echo t('RSS Feed') ?>" /></a>
			</div>
			<link href="<?php  echo BASE_URL.$rssUrl ?>" rel="alternate" type="application/rss+xml" title="<?php  echo $rssTitle; ?>" />
		<?php  endif; ?>

	</div>


<?php  if ($showPagination): ?>
    <?php  echo $pagination;?>
<?php  endif; ?>
<?php  endif; ?>
