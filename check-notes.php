<?php 
require_once 'Class/Evaluation.php';
require_once 'Class/Restaurant.php';

$test = new Restaurant();
$dataDev = $test->getArrays();

require_once "elements/head.php";
?>

<body>
    <a href="index.php" >Accueil</a>
    <h1>Notes des restaurants</h1>

    <pre>
        <?= var_dump($dataDev) ?>
    </pre>
</body>