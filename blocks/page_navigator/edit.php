<?php  defined('C5_EXECUTE') or die("Access Denied.");
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
?>
<ul id="" class="ccm-inline-toolbar ccm-ui image-toolbar">
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-options">
        <button id="options-button" type="button" class="btn btn-mini"><?php echo t("Options")?></button>
    </li>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-options">
        <button id="advanced-options-button" type="button" class="btn btn-mini"><?php echo t("Advanced Options")?></button>
    </li>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-cancel">
        <button onclick="cancelBlockForm()" id="" type="button" class="btn btn-mini"><?php echo t("Cancel")?></button>
    </li>
    <?php if(!$isComposer): ?>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-save">
      <button onclick="submitBlockForm()" class="btn btn-primary" type="button" id="image_save"><?php if ($controller->getTask() == 'add') { ?><?php echo t('Add Gallery')?><?php } else { ?><?php echo t('Update Gallery')?><?php } ?></button>
    </li>
    <?php endif ?>
 </ul>

<div class="basic-image-form-wrapper ccm-ui">
    <ul class="nav-items">
    	<?php foreach ($navItems as $ni) :?>
    		<li class="nav-item">
    			<?php echo $ni->name ?>
    		</li>
    	<?php endif;?>
    </ul>
</div>
