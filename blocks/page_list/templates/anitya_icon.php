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
	$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle($styleObject->columns > 1 ? 'medium' : 'large');

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
	<div class="page-list page-list-icon page-list-masonry row <?php echo $gap ? 'with-gap' : 'no-gap' ?>" data-gridsizer=".<?php echo $column_class . intval(12 / $styleObject->columns)?>" data-bid="<?php echo $bID?>">


		<?php foreach ($pages as $key => $page):

			$externalLink = $page->getAttribute('external_link');
			$url = $externalLink ? $externalLink : $nh->getLinkToCollection($page);
			$title_text =  $th->entities($page->getCollectionName());
			$title = $useButtonForLink ? $title_text : "<a href=\"$url\" target=\"$target\">$title_text</a>" ;
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

			$icon = $page->getAttribute('icon');

	?><div class="<?php  echo $pair ?> <?php echo $column_class . intval(12 / $styleObject->columns)?> item masonry-item <?php echo $tags ?>">
			<div class="inner">
				<a href="<?php  echo $url ?>" target="<?php  echo $target ?>" style="display:block">
					<div class="iconwrapper"><?php echo $icon ? "<i class=\"fa $icon\"></i>" : ""?></div>
					<div class="text">
		        <?php  if($includeDate): ?><h3 class="date"><?php  echo $date ?></h3><?php  endif ?>
		        <?php  if (is_array($topics)): ?><p><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p><?php  endif ?>
						<?php  if ($includeName): ?><h5><?php  echo $title ?></h5><?php  endif ?>
	          <?php  if ($includeDescription): ?><p class="desc"><small><?php  echo $description ?></small></p><?php  endif ?>
					</div>
				</a>
			</div>
		</div>
	<?php  endforeach ?>

    <?php  if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php  echo $noResultsMessage?></div>
    <?php  endif;?>

	<?php  if ($showRss): ?>
		<div class="ccm-block-page-list-rss-icon">
			<a href="<?php  echo $rssUrl ?>" target="_blank"><img src="<?php  echo $rssIconSrc ?>" width="14" height="14" alt="<?php  echo t('RSS Icon') ?>" title="<?php  echo t('RSS Feed') ?>" /></a>
		</div>
		<link href="<?php  echo BASE_URL.$rssUrl ?>" rel="alternate" type="application/rss+xml" title="<?php  echo $rssTitle ?>" />
	<?php  endif ?>

</div><!-- end .ccm-block-page-list -->


<?php  if ($showPagination): ?>
    <?php  echo $pagination;?>
<?php  endif ?>
<?php  endif ?>
