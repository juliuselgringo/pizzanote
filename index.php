<?php 
require_once "elements/head.php";
require_once "Class/DBconnection.php";
require_once "Class/Notation.php";
$connectionDB = new DBconnection();
$connectionDB->closeFct();
$pizzaConfig = new DBconnection;
$pizzaConfig->closeFct();
$update = new Notation();
$update->closeFct();
//Napolitaine
?>

<body>
    <main>
        <h1>PizzaNote</h1>
        <h2>La carte</h2>
        <form action="new-meal.php" method="POST">
            <button type="submit" name="new-meal" id="new-meal">
                Créer un nouveau repas
            </button>
        </form>
        <form action="join-meal.php" method="POST">
            <button type="submit" name="join-meal" id="join-meal">
                Rejoindre un repas
            </button>
        </form>
        <form action="check-notes.php" method="POST">
            <button type="submit" name="check-notes" id="check-notes">
                Voir les notes
            </button>
        </form>
        <form action="config-sheet.php" method="POST">
            <button type="submit" name="check-notes" id="check-notes">
                Paramètres
            </button>
        </form>
        <img class="logo" src="image/pizza.png" width=70% height=70%>
    </main>
</body>
</html>