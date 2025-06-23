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

/*
if(isset($_POST['update-notation']) && $_POST['update-notation'] === 'update-notation'){
    if(!empty($_POST['item-update']) && !empty($_POST['sous-item-update']) && !empty($_POST['update-min']) && !empty($_POST['update-max']) && !empty($_POST['update-ponderation'])){
        echo "appel fct updateNotation";
        $updateNotation = new Notation;
        $alertMsg = $updateNotation->updateNotation();
    }
    else{
        return "l'un des champs est vide!";
    }
}
*/
?>

<body>
    <a href='index.php' >Accueil</a>
    <main>
        <h1>Modifier les paramètres</h1>
        <div class="search">
            <label for='name' >Saisissez votre pseudo</label>
            <input type='text' name='name' id='name' >
        
            <label for="item-search">Saisissez un item</label>
            <input id="item-search"></input>
            
            <label for="sous-item-search">Saisissez un sous-item</label>
            <input id="sous-item-search"></input>
                
            <button type='submit' name='connection' id='connection' value='connection'>Rechercher</button>

            <form method="POST">
                <button type='submit' name='close-connection' value='close-connection'>Se déconnecter</button>
            </form>

            <div class='<?= $alertClass ?>' id='message'><?= $alertMsg ?></div>

            <div id="display-search"></div>
        </div>
        <div class="update">
            <form method='POST'>
                <label for="item-search">Saisissez un item</label>
                <input id="item-update" name="item-update"></input>
                
                <label for="sous-item-search">Saisissez un sous-item</label>
                <input id="sous-item-update" name="sous-item-update"></input>
                
                <label for="min-update">Saisissez min</label>
                <input id="min-update" name="min-update"></input>

                <label for="max-update">Saisissez max</label>
                <input id="max-update" name="max-update"></input>

                <label for="ponderation-update">Saisissez ponderation</label>
                <input id="ponderation-update" name="ponderation-update"></input>

                <button type='submit' id='update-notation' name='update-notation' value='update-notation'>Modifier</button>
            </form>
            <pre>
                <?= var_dump($_POST) ?>
            </pre>
        </div>

        
    </main>

    <script src="static/config.js"></script>
</body>