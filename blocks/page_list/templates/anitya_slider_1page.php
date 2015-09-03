<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";
	$alternativeDateAttributeHandle = 'date';
    $type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');	

// Flickity options :
	$flickity = new StdClass();
	$flickity->accessibility = true;
	$flickity->autoPlay = false;
	// $flickity->freeScrollFriction = 0.075, friction when free-scrollin;
	// $flickity->friction = 0.28, friction when selectin;
	$flickity->cellAlign = 'center';
	// $flickity->cellSelector = undefined;
	// $flickity->contain = false;
	$flickity->draggable = true;
	// $flickity->initialIndex = 0;
	// $flickity->imagesLoaded = false;
	$flickity->percentPosition = true;
	$flickity->pageDots = true;
	$flickity->prevNextButtons = true;
	$flickity->resizeBound = true;
	// $flickity->watcCSS = false;
	$flickity->wrapAround = true;
	$flickity->selectedAttraction = 0.025;
	$flickity->leftArrowText = '<';
	$flickity->rightArrowText = '>';

// Some internal variables

	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
	$dh = Core::make('helper/date');



	if ($pageListTitle): ?>
    <div class="page-list-header">
        <h3><?php  echo $pageListTitle?></h3>
    </div>
    <?php  endif ?>
    <div class="gallery js-flickity flickity-1-page" id="flickity-<?php echo $bID ?>"  data-flickity-options='<?php echo json_encode($flickity) ?>' >
	<?php  foreach ($pages as $key => $page):

		$pair = $key % 2 == 1 ? 'pair' : 'impair';
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
	
	?><div class="gallery-cell <?php  echo $pair ?>" <?php  if ($thumbnailUrl) : ?>style="background-image:url(<?php echo $thumbnailUrl ?>)"<?php  endif ?>>
			<a href="<?php  echo $url ?>" target="<?php  echo $target ?>" style="display:block">
				<?php if (!$thumbnailUrl) : ?>
				<div class="dummy"></div>
				<?php  endif ?>
				<div class="captions">
					<?php  if ($includeName): ?><h2><?php  echo $title ?><?php  if($includeDate): ?><small class="date"><?php  echo $date ?></small><?php  endif ?></h2><?php  endif ?>
		            <?php  if ($includeDescription && $description): ?>
		            <p class="desc">
		            	
		            	<small><?php  echo $description ?></small>
		            </p><?php  endif ?>					
				</div>
			</a>
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
 
</div><!-- end .gallery js-flickity -->
<style>
.gallery-cell {
  width: 100%;
  /*margin: 0 5%;*/
  height: 400px;
}

</style>
