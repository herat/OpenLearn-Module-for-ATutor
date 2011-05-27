<?php 
/* start output buffering: */
ob_start(); ?>

Search OpenLearn

<?php
$savant->assign('dropdown_contents', ob_get_contents());
ob_end_clean();

$savant->assign('title', _AT('ol_search_open_learn')); // the box title
$savant->display('include/box.tmpl.php');
?>