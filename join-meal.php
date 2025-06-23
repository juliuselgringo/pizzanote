<?php 
require_once "Class/Authentification.php";
//?idSession=18/06/2025&restaurant=pizz

if($_GET['join'] === 'join'){
    if(!empty($_GET['name']) && !empty($_GET['restaurant']) && !empty($_GET['idSession'])){
        session_start();
        $_SESSION['idSession'] = $_GET['idSession'];
        $_SESSION['name'] = $_GET['name'];
        $_SESSION['restaurant'] = $_GET['restaurant'];
        header('Location: /note-sheet.php');
        exit;
    }
    else{
        $alertMsg = "L'un des deux champs de saisie est vide!";
    }
}


require_once "elements/head.php" 
?>

<body>
    <a href="index.php" >Accueil</a>
    <h1>Rejoignez une session repas</h1>

    <form method="GET">
        <input type="text" name="idSession" value="<?= htmlentities($_GET['idSession']) ?>" >
        <input type="text" name="restaurant" value="<?= htmlentities($_GET['restaurant']) ?>" >
        <label for="name" >Saissez votre pseudo</label>
        <input type="text" name="name" id="name" >
        <button type="submit" name="join" value="join">Rejoindre</button>
    </form>
</body>