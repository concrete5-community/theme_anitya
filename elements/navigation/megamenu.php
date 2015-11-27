<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getCurrentPage();
$view = $ni->relatedMegaMenu->getController()->getViewObject();

?>

<div class='nav-pane stack-pane absolute-container' style="padding:20px;">
	<div class="row">
		<div class="col-md-12">
			<?php if (!$c->isEditMode()) :
				Request::getInstance()->setCurrentPage($ni->relatedMegaMenu);
				echo $view->render("mega_menu_content");
				Request::getInstance()->setCurrentPage($c);
			endif;
			?>
		</div>
	</div>
</div>

<?php
