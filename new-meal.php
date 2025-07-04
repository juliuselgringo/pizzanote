<?php 
require_once "Class/Authentification.php";
require_once "Class/Restaurant.php";

$today = date('d/m/Y');

$authNewMeal = new Authentification();
$alertMsg = $authNewMeal->connectSession($today);

$checkNotes = new Restaurant();
$restaurantArray =  $checkNotes->getArrayRestaurant();

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
    <main>
        <?= $today ?><br>
        <a href="index.php" >Accueil</a>
        <h1>Créez votre session repas</h1>
        <form method="GET">
            <label for="name" >Saisissez votre pseudo <br>(3 à 20 caractères alphanumériques)</label>
            <input type="text" name="name" id="name" pattern="[a-zA-Z0-9\s]{3,20}" required ><br>
            <label for="name" >Saisissez le nom de la pizzeria <br>(3 à 20 caractères alphanumériques)</label>
            <input type="text" name="restaurant" id="restaurant" pattern="[a-zA-Z0-9\s]{3,20}" ><br>
            <label>Ou un restaurant déjà évalué:</label>
            <select name="restaurant">
                <option></option>
                <?php foreach($restaurantArray as $rest): ?>
                    <option><?= $rest['restaurant'] ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" name="new-meal" value="new-meal" >
                Créer
            </button>
            <div class="<?= $alertClass ?>"><?= $alertMsg ?></div>
        </form>
    </main>
</body>