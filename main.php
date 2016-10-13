<?php
include('CSearch.php');

$query  = htmlentities($_POST['query'], ENT_NOQUOTES, "UTF-8");
$search = new CSearch($query, "default.json");
$output = $search->searchJson();

header('Content-type: text/html');
echo $output;
