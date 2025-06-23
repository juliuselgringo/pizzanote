<?php 
require_once "elements/head.php";
//Napolitaine
?>

<body>
    
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
</body>
</html>