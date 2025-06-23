<?php
require_once '../Class/Notation.php';

$search = new Notation();
$search->getNotation($_POST['name']);

?>