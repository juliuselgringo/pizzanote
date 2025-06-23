<?php 
require_once "elements/head.php";
require_once 'Class/DBconnection.php';
require_once 'Class/Notation.php';

$alertClass= "alert-danger";
$alertMsg = "Saisissez-votre au minimum votre pseudo";

if(isset($_POST['close-connection']) && $_POST['close-connection'] === 'close-connection'){
    $pizzaConfig = new DBconnection;
    $alertMsg = $pizzaConfig->closeFct();
    $alertClass = 'alert-danger';
}

if(isset($_POST['update-notation']) && $_POST['update-notation'] === 'update-notation'){
    if(!empty($_POST['item-search']) && !empty($_POST['sous-item-search']) && !empty($_POST['update-min']) && !empty($_POST['update-max']) && !empty($_POST['update-ponderation'])){
        $updateNotation = new Notation;
        $alertMsg = $updateNotation->updateNotation();
    }
    else{
        return "l'un des champs est vide!";
    }
}

?>

<body>
    <a href='index.php' >Accueil</a>
    <main>
        <h1>Modifier les paramètres</h1>
        
            <label for='name' >Saisissez votre pseudo</label>
            <input type='text' name='name' id='name' >
        
            <form method='POST'>
                <label for="item-search">Saisissez un item</label>
                <input id="item-search"></input>
                
                <label for="sous-item-search">Saisissez un sous-item</label>
                <input id="sous-item-search"></input>
                
                <button type='submit' name='connection' id='connection' value='connection'>Rechercher</button>
            <div class="search">
                <button type='submit' name='close-connection' value='close-connection'>Se déconnecter</button>
            </form>

            <div class='<?= $alertClass ?>' id='message'><?= $alertMsg ?></div>

            <div id="display-search"></div>
        </div>
        <div class="update">
            <form method='POST'>
                <label for="item-search">Saisissez un item</label>
                <input id="item-search" name="item-search"></input>
                
                <label for="sous-item-search">Saisissez un sous-item</label>
                <input id="sous-item-search" name="sous-item-search"></input>
                
                <label for="update-min">Saisissez min</label>
                <input id="update-min" name="update-min"></input>

                <label for="update-max">Saisissez max</label>
                <input id="update-max" name="update-max"></input>

                <label for="update-ponderation">Saisissez ponderation</label>
                <input id="update-ponderation" name="update-ponderation"></input>

                <button type='submit' name='update-notation' value='update-notation'>Modifier</button>
            </form>
            <pre>
                <?= var_dump($_POST) ?>
            </pre>
        </div>

        
    </main>

    <script src="static/config.js"></script>
</body>