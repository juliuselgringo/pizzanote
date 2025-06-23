<?php
require_once '../Class/Notation.php';

$config = new Notation();
$config->getNotation($_POST['name']);

?>