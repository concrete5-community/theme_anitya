<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getCurrentPage();
$content = $controller->getContent();
$is_placeholder = ($c->isMasterCollection()) || $c->getController() instanceof \Concrete\Controller\SinglePage\Dashboard\Blocks\Stacks;

echo $controller->getOpenTag();

if ($is_placeholder) :
   echo $content;
else :
  echo "<span class=\"fa ";
  echo $controller->getContent();
  echo "\">";
endif;
echo $controller->getCloseTag();
