<?php 


/**
 * Authentification
 * manage connection and session variables 
 */
class Authentification{
    private $regex = '/^[a-zA-Z0-9\s]{3,20}$/';
    
    /**
     * connectSession
     *
     * @param  date $today
     * @return void
     */
    public function connectSession($today){
        if(isset($_GET['new-meal']) && $_GET['new-meal'] === 'new-meal' && !empty($_GET['name']) && (!empty($_GET['restaurant']) || !empty($_GET['select-restaurant']))){
            if(preg_match($this->regex, $_GET['name']) && (preg_match($this->regex, $_GET['restaurant']) || !empty($_GET['select-restaurant']))){
                session_start();
                $_SESSION['idSession'] = trim((string)$today);
                $_SESSION['name'] = htmlentities(trim($_GET['name']));
                if(empty($_GET['restaurant'])){
                    $_SESSION['restaurant'] = htmlentities($_GET['select-restaurant']);
                }
                else{
                    $_SESSION['restaurant'] = htmlentities(trim($_GET['restaurant']));
                }
                header('Location: /note-sheet.php');
                exit;
            }
            else{
                return "L'un des deux champs ne comporte pas 3 à 20 caractères alphanumériques.";
            }
        }
        else{
            return "L'un des deux champs est vide.";
        }
    }
    
    /**
     * is_connected
     *
     * @return bool
     */
    public function is_connected():bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return !empty($_SESSION['name']);
    }
    
    /**
     * user_to_login
     * redirect new-meal if not connected
     * @return void
     */
    public function user_to_login(): void {
        if (!$this->is_connected()){
            header('Location: /new-meal.php');
            exit();
        }
    }

}

?>