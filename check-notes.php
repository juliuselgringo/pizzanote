<?php 
require_once 'Class/Evaluation.php';

$check = new Evaluation;
$datanote = $check->getSessionNote();

require_once "elements/head.php";
?>

<body>
    <a href="index.php" >Accueil</a>
    <h1>Consultez les notes d'une session repas</h1>
    <?php foreach($datanote as $dataLine): ?>
        <p><?= $dataLine['idsession'] . ' ' . $dataLine['restaurant'] . ' ' . $dataLine['item'] . ' ' . $dataLine['sous_item'] . ' ' . $dataLine['name'] . ' ' . $dataLine['note'] ?></p>
    <?php endforeach ?>
    
</body>