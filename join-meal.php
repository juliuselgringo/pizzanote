<?php 
require_once "Class/Authentification.php";
//?idSession=18/06/2025&restaurant=pizz

if($_GET['join'] === 'join'){
    if(!empty($_GET['name']) && !empty($_GET['restaurant']) && !empty($_GET['idSession'])){
        session_start();
        $_SESSION['idSession'] = trim($_GET['idSession']);
        $_SESSION['name'] = trim($_GET['name']);
        $_SESSION['restaurant'] = trim($_GET['restaurant']);
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
    <main>
        <a href="index.php" >Accueil</a>
        <h1>Rejoignez une session repas</h1>

        <form method="GET">
            <label>Saisissez l'idSession (c'est la date du jour):</label>
            <input type="text" name="idSession" value="<?= date('d/m/Y')?>" >
            <label>Saisissez le nom du retaurant (demander la sythaxe exacte):</label>
            <input type="text" name="restaurant" >
            <label for="name" >Saissez votre pseudo</label>
            <input type="text" name="name" id="name" >
            <button type="submit" name="join" value="join">Rejoindre</button>
        </form>
    </main>
</body>