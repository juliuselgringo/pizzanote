<?php 
require_once "Class/Authentification.php";

$today = date('d/m/Y');

$authNewMeal = new Authentification();
$alertMsg = $authNewMeal->connectSession($today);

if($alertMsg){
    $alertClass="alert-danger";
}

if($authNewMeal->is_connected()){
    header("Location: /note-sheet.php");
    exit;
}

require_once "elements/head.php";
?>

<body>
    <?= $today ?><br>
    <a href="index.php" >Accueil</a>
    <h1>Créez votre session repas</h1>
    <form method="GET">
        <label for="name" >Saisissez votre pseudo <br>(3 à 10 caractères alphanumériques)</label>
        <input type="text" name="name" id="name" pattern="[a-zA-Z0-9]{3,20}" required ><br>
        <label for="name" >Saisissez le nom de la pizzeria <br>(3 à 10 caractères alphanumériques)</label>
        <input type="text" name="restaurant" id="restaurant" pattern="[a-zA-Z0-9]{3,20}" required ><br>
        <button type="submit" name="new-meal" value="new-meal" >
            Créer
        </button>
        <div class="<?= $alertClass ?>"><?= $alertMsg ?></div>
    </form>
    <?php  ?>
    <pre>
        <?= "Session: " . PHP_EOL . var_dump($_SESSION) ?>
        <?= "GET: " . PHP_EOL . var_dump($_GET) ?>
    </pre>
</body>