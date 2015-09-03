<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";
	$alternativeDateAttributeHandle = 'date';

// Some internal variables

	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
	$dh = Core::make('helper/date');
    $type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');

  if ($pageListTitle): ?>
    <div class="page-list-header">
        <h3><?php  echo $pageListTitle?></h3>
    </div>
    <?php  endif ?>
<div class="anitya-accordion">
	 <dl>
	 	<?php  foreach ($pages as $key => $page):

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

        if ($displayThumbnail) :
	        $img_att = $page->getAttribute('thumbnail');
	        if($type != NULL && is_object($img_att)) :
	            $thumbnailUrl = $img_att->getThumbnailURL($type->getBaseVersion());
	        else: 
	        	$thumbnailUrl = false;
	        endif;	
	    endif;
	
	?>
       	<dt class="title <?php echo $key === 0 ? 'active' : '' ?>">
            <a href=""><?php echo $includeName ? $title : t('Title ') . $key ?>
                <i class='fa fa-chevron-down icon'></i>
            </a>
        </dt>		
        <dd class="content <?php echo $key === 0 ? 'active' : '' ?>">
			<div class='content-inner clearfix'>
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

			</div>
        </dd>				

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
 
</div><!-- end .anitya-accordion -->


<?php  if ($showPagination): ?>
    <?php  echo $pagination;?>
<?php  endif ?>