<?php 
require_once "elements/head.php";
require_once 'Class/DBconnection.php';
require_once 'Class/Notation.php';

$alertClass= "alert-danger";
$alertMsg = "Saisissez votre pseudo";
$selectInput = new Notation;
$itemArray = $selectInput->getItem();

?>

<body>
    <main>
        <a href="index.php" >Accueil</a>
        <h1>Modifier les paramètres</h1>
        <div class="search">
            <label for='name' >Saisissez votre pseudo</label>
            <input type='text' name='name' id='name' pattern="[a-zA-Z0-9]{3,20}" required >
        
            <label for="item-search">Saisissez un item</label>
            <select type="text" id="item-search">
                <?php foreach($itemArray as $item): ?>
                    <option><?= $item ?></option>
                <?php endforeach ?>
            </select>
            
            <label for="sous-item-search">Saisissez un sous-item</label>
            <input type="text" id="sous-item-search"></input>
                
            <button type='submit' name='connection' id='connection' value='connection'>Rechercher</button>
            
            <div id="display-search"></div>
        </div>
        <div class="update">
            <form method='POST'>
                <label for="item-search">Saisissez un item</label>
                <input type="text" id="item-update" name="item-update"></input>
                
                <label for="sous-item-search">Saisissez un sous-item</label>
                <input type="text" id="sous-item-update" name="sous-item-update"></input>
                
                <label for="min-update">Saisissez min</label>
                <input type="number" id="min-update" name="min-update"></input>

                <label for="max-update">Saisissez max</label>
                <input type="number" id="max-update" name="max-update"></input>

                <label for="ponderation-update">Saisissez ponderation</label>
                <input type="number" id="ponderation-update" name="ponderation-update"></input>

                <button type='submit' id='update-notation' name='update-notation' value='update-notation'>Modifier</button>

                <div class='<?= $alertClass ?>' id='message'><?= $alertMsg ?></div>
                </form>
                <a href="index.php" >Accueil</a>
        </div>
        <pre>
            <?= var_dump($itemArray) ?>
        </pre>
        
    </main>

    <script src="static/config.js"></script>
</body>