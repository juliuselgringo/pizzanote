<?php
require_once '../Class/Notation.php';


$update = new Notation();
$update->updateNotation($_POST["item"]);
?>