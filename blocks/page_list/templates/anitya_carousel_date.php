<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
Loader::PackageElement("page_list/sortable", 'theme_anitya', array('o'=>$o,'tagsObject'=>$tagsObject,'bID'=>$bID,'styleObject'=>$styleObject));


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
	$slick->autoplay = (bool)$o->carousel_autoplay;
	$slick->autoplaySpeed = (int)$o->carousel_autoplaySpeed;

?>
<div class="slick-wrapper gallery img-date-based img-date-based-carousel <?php echo $styleObject->columns?>-columns" id="slick-<?php echo $bID ?>"  data-slick='<?php echo json_encode($slick) ?>' >

<?php  foreach ($pages as $key => $page): extract($page->mclDetails);	?>
	<div class="<?php  echo $pair ?> item">
			<a href="<?php  echo $url ?>" target="<?php  echo $target ?>" style="display:block">
				<?php  if ($thumbnailUrl) : ?>
				<img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title ?>">
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
</div><!-- end .ccm-block-page-list -->
<?php  endif ?>
