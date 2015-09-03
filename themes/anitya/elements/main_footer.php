<?php  defined('C5_EXECUTE') or die("Access Denied.") ?>

<?php 
$a = new Area('Page Footer');
$a->enableGridContainer();
$a->display($c);
?>