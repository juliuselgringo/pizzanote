<?php 
require_once "Class/Authentification.php";
require_once "Class/Evaluation.php";
// Authentification
$authNoteSheet = new Authentification();
$authNoteSheet->user_to_login();

// Share with QR code
include 'phpqrcode/qrlib.php';
if(isset($_GET['share']) && $_GET['share'] === 'share'){
    $lien = "join-meal.php?idSession=" . $_SESSION['idSession'] . "&restaurant=" . $_SESSION['restaurant'];
    QRcode::png($lien, 'image-qrcode.png');
}

$hide = '';
if(isset($_GET['hide']) && $_GET['hide'] === 'hide'){
    $hide = 'hidden';
}

// Get data to display sheet note & insert new session data
$evalData = [];
$evaluation = new Evaluation();
$evalData = $evaluation->getNotation();
$alertClass = '';
$alertMsg = '';
if(isset($_POST['send-btn']) && $_POST['send-btn'] === 'send-btn'){
    $alertMsg = $evaluation->sendEvaluation();
    $alertClass = 'alert-success';
}

require_once "elements/head.php";
?>

<body>
    <?php require_once "elements/header.php" ?>
    <h1>Feuille de notation</h1>
    <form action="note-sheet.php" method="GET">
        <input name="idSession" type="text" value="<?= htmlentities($_SESSION['idSession']) ?>">
        <button type="submit" name="share" value="share" >Partager</button>
        <button type="submit" name="hide" value="hide" >Cacher</button>
    </form>
    <div class="<?= $alertClass ?>"><pre><?= $alertMsg ?></pre></div>
    <main>
        <?php if(isset($_GET['share'])): ?>
            <img src="image-qrcode.png" <?= $hide ?> >
        <?php endif ?>
        <p>Repas du <?= $_SESSION['idSession'] ?> chez <?= $_SESSION['restaurant'] ?></p>
        <p>Bienvenue <?= $_SESSION['name'] ?> </p>
        <div class="notation-sheet" id="notation-sheet"></div>
        <h2>Que l'évaluation soit</h2>
        <form method="POST">
            <?php foreach($evalData as $evalLine): ?>
                <hr>
                <p><?= $evalLine["item"] ?> : <?= $evalLine['sous_item'] ?></p>
                <select name="<?= $evalLine["item"] . '/' . $evalLine['sous_item'] . '/' . $evalLine['id_note'] ?>">
                    <?php $evaluation->displayNotesheet($evalLine) ?>
                </select>
                <hr>
            <?php endforeach ?>
            <button type="submit" name="send-btn" value="send-btn" >Valider</button>
        </form>
        <?php if ($authNoteSheet->is_connected()): ?>
            <a href="logout.php" >Se déconnecter</a>
        <?php endif ?>
    </main>
</body>