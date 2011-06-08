<?php

require ('search.class.php');

$obj = new Search();

$rows = $obj->getSearchResult($_GET['q']);

$_SESSION['rows']=$rows;

header("Location: mods/ol_search_open_learn/result-gen.php?cursor=1");
?>