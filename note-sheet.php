<?php 
require_once "Class/Authentification.php";

$authNoteSheet = new Authentification();
var_dump($authNoteSheet->is_connected());
$authNoteSheet->user_to_login();

include 'phpqrcode/qrlib.php';
if($_GET['share'] === 'share'){
    $lien = "join-meal.php?idSession=" . $_SESSION['idSession'] . "&restaurant=" . $_SESSION['restaurant'];
    QRcode::png($lien, 'image-qrcode.png');
}

$hide = '';
if($_GET['hide'] === 'hide'){
    $hide = 'hidden';
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
    <img src="image-qrcode.png" <?= $hide ?> >
    <p>Repas du <?= $_SESSION['idSession'] ?> chez <?= $_SESSION['restaurant'] ?></p>
    <p>Bienvenue <?= $_SESSION['name'] ?> </p>
    <div class="notation-sheet" id="notation-sheet"></div>
    
    <script src="static/script.js"></script>
</body>