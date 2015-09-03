<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-block-share-this-page">
    <ul class="list-inline">
    <?php  foreach($selected as $service) { ?>
        <li><a href="<?php  echo $service->getServiceLink()?>" class="btn btn-default"><i class="fa fa-lg fa-<?php  echo $service->getIcon()?>"></i></a></li>
    <?php  } ?>
    </ul>
</div>