<?php 
class Authentification{
    private $regex = '/^[a-zA-Z0-9]{3,20}$/';

    public function connectSession($today){
        if($_GET['new-meal'] === 'new-meal'){
            if(preg_match($this->regex, $_GET['name']) && preg_match($this->regex, $_GET['restaurant'])){
                session_start();
                $_SESSION['idSession'] = $today;
                $_SESSION['name'] = htmlentities($_GET['name']);
                $_SESSION['restaurant'] = htmlentities($_GET['restaurant']);
                header('Location: /note-sheet.php');
                exit;
            }
            else{
                return "L'un des deux champs ne comporte pas 3 à 20 caractères alphanumériques.";
            }
    }

    }

    public function is_connected():bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return !empty($_SESSION['name']);
    }

    public function user_to_login(): void {
        if (!$this->is_connected()){
            header('Location: /new-meal.php');
            exit();
        }
    }

}

?>