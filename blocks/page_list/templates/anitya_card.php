<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();
extract ($pageTheme->getPageListVariables($b,$controller,$pages));
if (!$c->isEditMode()) :
  echo $wrapperOpenTag;
  foreach ($pages as $key => $page): extract($page->mclDetails);
  	echo $itemOpenTag;?>
    <figure class="snip1208">
      <?php if ($imageTag) : echo $imageTag; else:?><div class="placeholder"></div><?php endif ?>
      <?php  if($includeDate): ?><div class="date void"><span class="day"><?php echo date('d',$rawdate) ?></span><span class="month"><?php echo date('M',$rawdate) ?></span></div><?php echo $icon ?><?php endif ?>
      <figcaption>
        <?php  if ($includeName): ?><h3><?php  echo $title ?></h3><?php  endif ?>
        <?php  if ($includeDescription): ?><p class="desc"><small><?php  echo $description ?></small></p><?php  endif ?>
        <?php if ($useButtonForLink): ?><button href="<?php echo $url?>" class="btn btn-default <?php echo $popupClassLauncher ?>"><?php echo $buttonLinkText?></button><?php endif ?>
      </figcaption><a <?php echo $to ?>></a>
    </figure>
			<?php echo $popup ?>
		<?php echo $itemCloseTag ?>
	<?php  endforeach ?>
	<?php echo $wrapperCloseTag ?>
	<?php Loader::PackageElement("page_list/utils", 'theme_anitya', array('b'=>$b,'controller' => $controller,'pages'=>$pages))?>
<?php  endif ?>
