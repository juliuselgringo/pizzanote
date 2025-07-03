<?php

require_once 'Class/Restaurant.php';
require_once 'Class/Notation.php';

$maxScore = new Notation();
$checkNotes = new Restaurant();

$bestRestaurant = $checkNotes->getBest();

$total = $maxScore->getScoreMax();

$restaurantArray =  $checkNotes->getArrayRestaurant();
$restaurant = (isset($_POST['restaurant-search']) && $_POST['restaurant-search'] === 'restaurant-search') ? $_POST['restaurant'] : "";
$ItemScore = $checkNotes->getRestaurantItem($restaurant);

require_once "elements/head.php";
?>

<body>
    <main>
        <a href="index.php" >Accueil</a>
        <h1>Notes des restaurants</h1>

        <!-- /////////////////////// -->
        <h2>Le meilleur est: </h2>
        <table>
            <tr>
                <th>Restaurant</th>
                <th>Score %</th>
            </tr>
            <?php foreach($bestRestaurant as $rest): ?>
                <tr>
                    <td><?= $rest['restaurant'] ?></td>
                    <td><?= round($rest['score'] / $total * 100, 2) ?></td>
                </tr>
            <?php endforeach ?> 
        </table>
        <!-- /////////////////////// -->
        <h2>Score par catégories:</h2>
        <form method="POST">
            <label>Sélectionner le restaurant que vous souhaitez consuler:</label>
            <select name="restaurant">
                <option></option>
                <?php foreach($restaurantArray as $rest): ?>
                    <option><?= $rest['restaurant'] ?></option>
                <?php endforeach ?>
            </select>
            <button type='submit' name='restaurant-search' value="restaurant-search">Chercher</button>
        </form>

        <table>
            <tr>
                <th>Restaurant</th>
                <th>Catégorie</th>
                <th>Note %</th>
            </tr>
            <?php foreach($ItemScore as $rest): ?>
                <tr>
                    <td><?= $rest['restaurant'] ?></td>
                    <td><?= $rest['item'] ?></td>
                    <td><?= round(($rest['score_par_item'] / $maxScore->getScoreMax($rest['item'])) * 100, 2) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
        
    </main>
</body>