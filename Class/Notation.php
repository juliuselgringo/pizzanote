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
                    'class' => 'alert-success',
                    'dataNotation' => $dataNotation    
                ];
                
            }
            else{
                $messageAlert = "Vous n'avez pas de droit d'administration";
                $response = [
                    'message' => $messageAlert,
                    'class' => 'alert-danger'
                ];
            }

            echo json_encode($response);
            $pizzaConfig->closeFct();
        }
    }

    public function updateNotation(){
        $this->connectFct();

        $item = $_POST['item-search'];
        $sousItem = $_POST['sous-item-search'];
        $min = $_POST['update-min'];
        $max = $_POST['update-max'];
        $ponderation = $_POST['update-ponderation'];
        
        $updateQuery = "UPDATE notation SET min = $min , max= $max , ponderation = $ponderation WHERE item = $item AND sous_item = $sousItem;";
        return $this->dbQuery($updateQuery, 'insert');
        
        
    }
}


?>