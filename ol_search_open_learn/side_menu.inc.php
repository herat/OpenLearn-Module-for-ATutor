<?php 
/* start output buffering: */
ob_start(); 
global $savant;
?>

<a href= "<?php  echo AT_BASE_HREF; ?>mods/ol_search_open_learn/index.php"> <?php echo _AT('ol_search_open_learn'); ?> </a>

<?php
$savant->assign('dropdown_contents', ob_get_contents());
ob_end_clean();

$savant->assign('title', _AT('ol_search_open_learn')); // the box title
$savant->display('include/box.tmpl.php');
?>