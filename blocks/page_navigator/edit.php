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
      <button onclick="submitBlockForm()" class="btn btn-primary" type="button" id="image_save"><?php if ($controller->getTask() == 'add') { ?><?php echo t('Add Navigator')?><?php } else { ?><?php echo t('Update Navigator')?><?php } ?></button>
    </li>
    <?php endif ?>
 </ul>

<div class="basic-image-form-wrapper ccm-ui">
    <?php
    echo '<ul class="nav-items">';
    	foreach ($navItems as $ni) :
    		echo '<li class="nav-item">'?>
    			<?php echo $ni->name?>
          <input type="hidden" name="ID[]" value="<?php echo $ni->ID?>">
    		<?php echo '</li>';
    	endforeach;
    echo '</ul>';
    ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.nav-items').sortable({
    containment: "parent"
  })
})

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
<style>
  ul.nav-items {
    /*height: 50px;*/
    padding: 0 3px; margin: 0;
    background: #dde2e7;
  }
  li.nav-item {
    display: inline-block;
    min-width: 80px;
    line-height: 40px;
    padding:0 20px;
    margin: 6px 3px;
    background: #414d59;
    color: #dde2e7;
    border-radius: 2px;
    cursor: move;
  }
</style>
