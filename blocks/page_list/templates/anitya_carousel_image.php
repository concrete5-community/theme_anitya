<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme =  $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();
$styleObject = $pageTheme->getClassSettingsObject($b);//,$o->carousel_slidesToShow,$o->carousel_margin);
$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
$th = Loader::helper('text');
$dh = Core::make('helper/date');
$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle($styleObject->columns > 1 ? 'medium' : 'large');

if ($c->isEditMode()) : ?>
<?php $templateName = $controller->getBlockObject()->getBlockFilename() ?>
	<div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
			<p style="padding: 40px 0px 40px 0px; color:#999 !important"><strong><?php echo  ucwords(str_replace('_', ' ', substr( $templateName, 0, strlen( $templateName ) -4 ))) . t(' with ') . $styleObject->columns . t(' columns and ') . $styleObject->margin . t('px margin')?> </strong><?php echo  t(' disabled in edit mode.') ?></p>
	</div>
<?php elseif (count($pages)):

	if ($includeName || $includeDescription || $useButtonForLink) $includeEntryText = true; else $includeEntryText = false;
// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";
	$alternativeDateAttributeHandle = 'date';

	$slick = new StdClass();
	$slick->slidesToShow = $styleObject->columns;
	$slick->slidesToScroll = $styleObject->columns;
	$slick->margin = $styleObject->margin;
	$slick->dots = (bool)$o->carousel_dots;
	$slick->arrows = (bool)$o->carousel_arrows;
	$slick->infinite = (bool)$o->carousel_infinite;
	$slick->speed = $o->carousel_speed;
	$slick->centerMode = (bool)$o->carousel_centerMode;
	$slick->variableWidth = (bool)$o->carousel_variableWidth;
	$slick->adaptiveHeight = (bool)$o->carousel_adaptiveHeight;
	$slick->autoplay = false; //(bool)$o->carousel_autoplay;
	$slick->autoplaySpeed = $o->carousel_autoplaySpeed;

// Some internal variables




  if ($pageListTitle): ?><div class="page-list-header">
        <h3><?php  echo $pageListTitle?></h3>
    </div>
    <?php  endif ?>
<div class="slick-wrapper img-based img-based-carousel carousel-<?php echo $styleObject->columns?>-columns" id="slick-<?php echo $bID ?>"  data-slick='<?php echo json_encode($slick) ?>' >

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

	?><div class="<?php  echo $pair ?> item">
			<a href="<?php  echo $url ?>" target="<?php  echo $target ?>" style="display:block">
				<?php  if ($thumbnailUrl) : ?>
				<div class="thumb">
					<img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title ?>">
				</div>
				<?php  endif ?>
				<div class="info">
			        <?php  if($includeDate): ?><h1 class="date"><?php  echo $date ?></h1><?php  endif ?>
			        <?php  if (is_array($topics)): ?>
			        <p><i><small><?php  foreach ($topics as $key => $topic) : ?><?php  echo $topic->getTreeNodeDisplayName() ?><?php  endforeach ?></small></i></p>
			        <?php  endif ?>
					<?php  if ($includeName): ?><h4><?php  echo $title ?></h4><?php  endif ?>
		            <?php  if ($includeDescription): ?><p class="desc"><small><?php  echo $description ?></small></p><?php  endif ?>
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

</div><!-- end .ccm-block-page-list -->


<?php  if ($showPagination): ?>
    <?php  echo $pagination;?>
<?php  endif ?>
<?php  endif ?>
