<?php   defined('C5_EXECUTE') or die(_("Access Denied."));
$pageTheme =  $c->getCollectionThemeObject();
$o = $pageTheme->getOptions();

$footer = $pageTheme->get_footer_geometry($o->display_footer_column);
$footer_top = new Area('Footer');
$display_footer_top = (is_object($footer_top) ? ($footer_top->getTotalBlocksInArea($c) > 0) : 0) || $c->isEditMode();

?>
<footer class="main-footer">
  <?php  if ($display_footer_top) : ?>
  <section id="footer-top">
      <?php
      $footer_top->enableGridContainer();
      $footer_top->display($c);
      ?>

  </section>
  <?php endif ?>
  <?php if ($o->display_footer) : ?>
  <section id="footer-bottom">
  <div class="container">
      <div class="row">
      	<hr class="space-s">
		<?php  foreach ($footer as $area) : ?>
		<div class="<?php echo $area['class'] ?>" id='<?php echo $area['name']?>'>
			<?php
			if($o->footer_global) :
				$f = new GlobalArea($area['name']);
				$f->display();
			else :
				$f = new Area($area['name']);
				$f->display($c);
			endif;
			?>
		</div>
		<?php  endforeach ?>
      </div>
      <hr>
      <div class="row credits">
      	<div class="col-md-8">
      		<p id="footer-note" class="small">
      			<span>&copy;&nbsp;<?php echo date('Y')?>&nbsp;<a href="<?php echo DIR_REL?>/"><?php echo Config::get('concrete.site')?></a>&nbsp;</span>
				<?php echo $o->footer_credit ?>
				<?php
        if (!$o->disable_footer_login) :
				$u = new User();
				if ($u->isRegistered()) { ?>
					<?php
					if (Config::get("ENABLE_USER_PROFILES")) {
						$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
					} else {
						$userName = $u->getUserName();
					}
					?>
					<span class="sign-in">&nbsp;<?php echo t('Currently logged in as <b>%s</b>.', $userName)?> <a href="<?php  echo $view->url('/login', 'logout', Loader::helper('validation/token')->generate('logout'))?>"><?php  echo t('Sign Out')?></a></span>
				<?php  } else { ?>
					<span class="sign-in"><a href="<?php echo $this->url('/login')?>">&nbsp;<?php echo t('Sign In to Edit this Site')?></a></span>
				<?php  } ?>
      <?php endif ?>
      		</p>
      	</div>
      </div>
  </div>
  </section>
  <?php endif ?>
</footer>


<?php  $this->inc('elements/footer_bottom.php');?>
