<?php
require_once 'DBconnection.php';

class Notation extends DBconnection{
    private $dataNotation = 'SELECT * FROM notation GROUP BY id_note, item ORDER BY item;';
    private $regex = '/\b(ALTER|CREATE|DELETE|DROP|EXEC(UTE)?|INSERT(\s+INTO)?|MERGE|SELECT|UPDATE|UNION(\s+ALL)?)\b/i';


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
        header('Content-Type: application/json');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])){
            if($_POST['name'] === 'julius'){
                $itemtest = preg_match($this->regex,$_POST['item']);
                $sousItemtest = preg_match($this->regex,$_POST['sous-item']);
                $mintest = preg_match($this->regex,$_POST['min']);
                $maxtest = preg_match($this->regex,$_POST['max']);
                $ponderationtest = preg_match($this->regex,$_POST['ponderation']);
                if($itemtest || $sousItemtest || $mintest || $maxtest || $ponderationtest){
                    $messageAlert = "Tentative d'injection SQL!!!";
                    $response = [
                        'message' => $messageAlert,
                        'class' => 'alert-danger'
                    ];
                    echo json_encode($response);
                    $this->closeFct();
                    
                }
                else{
                    $this->connectFct();
                    $item = $_POST['item'];
                    $sousItem = $_POST['sous-item'];
                    $min = $_POST['min'];
                    $max = $_POST['max'];
                    $ponderation = $_POST['ponderation'];
                    $updateQuery = "UPDATE notation SET min = $min , max = $max , ponderation = $ponderation WHERE item = '$item' AND sous_item = '$sousItem';";
                    $messageAlert = $this->dbQuery($updateQuery, 'update');
                    $response = [
                        'message' => $messageAlert,
                        'class' => 'alert-success'
                    ];
                    echo json_encode($response);
                    $this->closeFct();
                }
            }
            else{
                $messageAlert = "Vous n'avez pas de droit d'administration";
                $response = [
                    'message' => $messageAlert,
                    'class' => 'alert-danger'
                ];
                $this->closeFct();
            }
        }
    }

    public function getScoreMax($item = null){
        $this->connectFct();
        $ScoreMaxQuery='';
        if($item ===null){
            $ScoreMaxQuery = "SELECT SUM(max * ponderation) FROM notation;";
        }
        else{
            $ScoreMaxQuery = "SELECT SUM(max * ponderation) FROM notation WHERE item = '$item';";
        }
        $resultScoreMax = $this->dbQuery($ScoreMaxQuery)[0]['sum'];
        $this->closeFct();
        return $resultScoreMax;
    }

    public function getItem(){
        $this->connectFct();
        $itemQuery = "  SELECT item FROM notation;";
        $itemResult = $this->dbQuery($itemQuery);
        $itemArray = [];
        foreach($itemResult as $item){
            $itemArray[] = $item['item']; 
        }
        $itemArray = array_unique($itemArray, SORT_STRING);
        return $itemArray;
    }
}


?>