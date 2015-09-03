<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";
	$alternativeDateAttributeHandle = 'date';
	

// Some internal variables

	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
    $type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');
	$dh = Core::make('helper/date');

?><div class="page-list event-date">

    <?php  if ($pageListTitle): ?>
    <div class="page-list-header">
        <h3><?php  echo $pageListTitle?></h3>
    </div>
    <?php  endif; ?>

	<?php  foreach ($pages as $page):
		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
		$eventDate = $page->getAttribute($alternativeDateAttributeHandle);
        $date =  $eventDate ? $dh->formatDate($eventDate) : $dh->formatDate($page->getCollectionDatePublic());
		
		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;        

		$description = $page->getCollectionDescription();
		$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
		$description = $th->entities($description);	

		$topics = $page->getAttribute($topicAttributeKeyHandle);
        $options = $page->getAttribute($tagAttributeHandle);
        $options = is_object($options)  ? $options->getOptions() : array();

        ?><div class="event">
			<div class="meta clearfix">
				<p class="ribbon primary pull-left">
		            <a href="<?php  echo $url ?>" target="<?php  echo $target ?>"><?php  echo $date; ?></a>
				</p>
				<div class="tags pull-left">
					<?php  foreach($options as $option) : ?><small class="tag"><?php  echo $option->getSelectAttributeOptionValue()?></small><?php  endforeach ?>
				</div>
			</div>
			<div class="content">
				<?php  if ($includeName): ?><h6><?php  echo $title ?></h6><?php  endif ?>
		        <?php  if ($includeDescription): ?>
					<p>
			        <?php  if ($useButtonForLink): ?><a href="<?php  echo $url?>" class="btn btn-link pull-right"><?php  echo $buttonLinkText?></a><?php  endif; ?>			
					<small><?php  echo $description ?></small>
					</p>
		        <?php  endif; ?>				
			</div>
        </div>
	<?php  endforeach; ?>

    <?php  if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php  echo $noResultsMessage?></div>
    <?php  endif;?>
 

	<?php  if ($showRss): ?>
		<div class="ccm-block-page-list-rss-icon">
			<a href="<?php  echo $rssUrl ?>" target="_blank"><img src="<?php  echo $rssIconSrc ?>" width="14" height="14" alt="<?php  echo t('RSS Icon') ?>" title="<?php  echo t('RSS Feed') ?>" /></a>
		</div>
		<link href="<?php  echo BASE_URL.$rssUrl ?>" rel="alternate" type="application/rss+xml" title="<?php  echo $rssTitle; ?>" />
	<?php  endif; ?>
 
</div><!-- end .ccm-block-page-list -->


<?php  if ($showPagination): ?>
    <?php  echo $pagination;?>
<?php  endif; ?>