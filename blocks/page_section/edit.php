<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>
<ul id="" class="ccm-inline-toolbar ccm-ui image-toolbar">
    <!-- <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-options">
        <button id="options-button" type="button" class="btn btn-mini"><?php echo t("Options")?></button>
    </li> -->
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-cancel">
        <button onclick="cancelBlockForm()" id="" type="button" class="btn btn-mini"><?php echo t("Cancel")?></button>
    </li>
    <?php if(!$isComposer): ?>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-save">
      <button onclick="submitBlockForm()" class="btn btn-primary" type="button" id="image_save"><?php if ($controller->getTask() == 'add') { ?><?php echo t('Add Section')?><?php } else { ?><?php echo t('Update Section')?><?php } ?></button>
    </li>
    <?php endif ?>
 </ul>

<div class="form-wrapper ccm-ui">
  <input type="hidden" name="ID" value="<?php echo $options->ID?>">
  <div class="form-group">
    <label for="name"><?php echo t('Name') ?></label>
    <input clas="page-section-text void" type="text" name="name" value="<?php echo $options->name?>">
  </div>
</div>
<script type="text/javascript">
var submitBlockForm = function () {
    $('#ccm-block-form').submit();
    ConcreteEvent.fire('EditModeExitInlineSaved');
    ConcreteEvent.fire('EditModeExitInline', {
        action: 'save_inline'
    });
}

function cancelBlockForm () {
    ConcreteEvent.fire('EditModeExitInline');
    Concrete.getEditMode().scanBlocks();
}
</script>
