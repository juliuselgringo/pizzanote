<?php
require_once 'DBconnection.php';

class Notation extends DBconnection{
    private $dataNotation = 'SELECT * FROM notation';
    

    public function selectNotation(){
        return $this->dbQuery($this->dataNotation,'select');
    }

    public function getNotation($PostName){    
        header('Content-Type: application/json');

        $dataNotation = [];
        $messageAlert = "";
        $pizzaConfig = null;
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($PostName)){
            if($pizzaConfig === null){
                    $pizzaConfig = new Notation;
            } 
            if($_POST['name'] === 'julius'){
                $messageAlert = $pizzaConfig->connectFct();
                $dataNotation = $pizzaConfig->selectNotation();
                $response = [
                    'message' => $messageAlert,
                    'dataNotation' => $dataNotation    
                ];
                
            }
            else{
                $messageAlert = "Vous n'avez pas de droit d'administration";
                $response = [
                    'message' => $messageAlert,
                ];
            }

            echo json_encode($response);
            $pizzaConfig->closeFct();
        }
    }
}


?>