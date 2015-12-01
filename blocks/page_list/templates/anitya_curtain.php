<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
  echo $wrapperOpenTag;
  foreach ($pages as $key => $page): extract($page->mclDetails);
  	echo $itemOpenTag;?>
    <figure>
      <?php if ($imageTag) : echo $imageTag; else:?><div class="placeholder"></div><?php endif ?>
      <figcaption>
        <?php echo $icon ?>
        <?php  if ($includeName): ?><h4><?php  echo $title ?></h4><?php  endif ?>
          <?php  if($includeDate): ?><small class="date"><?php  echo $date ?></small><?php  endif ?>
        <?php  if ($includeDescription): ?><h6><?php  echo $description ?></h6><?php  endif ?>
        <?php if ($useButtonForLink): ?><a href="<?php echo $url?>" class="btn btn-primary <?php echo $popupClassLauncher ?>"><?php echo $buttonLinkText?></a><?php endif ?>
      </figcaption><a <?php echo $to ?>></a>
    </figure>
			<?php echo $popup ?>
		<?php echo $itemCloseTag ?>
	<?php  endforeach ?>
	<?php echo $wrapperCloseTag ?>
	<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif ?>
