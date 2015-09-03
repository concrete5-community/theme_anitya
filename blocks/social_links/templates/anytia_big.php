<?php 
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div id="ccm-block-social-links">
    <ul class="list-inline">
    <?php  foreach($links as $link) {
        $service = $link->getServiceObject();
        ?>
        <li><a href="<?php  echo $link->getURL()?>"><i class="fa fa-2x fa-<?php  echo $service->getIcon()?>"></i></a></li>
    <?php  } ?>
    </ul>
</div>