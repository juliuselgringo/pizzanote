<?php
require_once 'DBconnection.php';

/**
 * Notation
 * Get data notation table
 * 
 * 
 * 
 */
class Notation extends DBconnection{
    private $dataNotation = 'SELECT * FROM notation GROUP BY id_note, item ORDER BY item;';
    private $regex = '/^[a-zA-Z0-9\s.,!?\-\'":;()àâäéèêëîïôöùûüç\n\r]+$/u';

    
    /**
     * selectNotation
     * Get data notation table
     * @return array
     */
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
    
    /**
     * updateNotation
     * Upadate notation table
     * @return array
     */
    public function updateNotation(){
        header('Content-Type: application/json');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])){
            if($_POST['name'] === 'julius'){
                $itemtest = preg_match($this->regex,$_POST['item']);
                $sousItemtest = preg_match($this->regex,$_POST['sous-item']);
                $mintest = preg_match($this->regex,$_POST['min']);
                $maxtest = preg_match($this->regex,$_POST['max']);
                $ponderationtest = preg_match($this->regex,$_POST['ponderation']);
                if(!$itemtest || !$sousItemtest || !$mintest || !$maxtest || !$ponderationtest){
                    $messageAlert = "Entrée invalide";
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
                    try{
                        $updateQuery = $this->pdo->prepare("UPDATE notation SET min = :min , max = :max , ponderation = :ponderation WHERE item = :item AND sous_item = :sousItem");
                        $updateQuery->execute([
                            'min' => $min,
                            'max' => $max,
                            'ponderation' => $ponderation,
                            'item' => $item,
                            'sousItem' => $sousItem
                        ]);
                        $messageAlert = "Les modifications ont été enregistrés avec succès.";
                        $response = [
                            'message' => $messageAlert,
                            'class' => 'alert-success'
                        ];
                        echo json_encode($response);
                        $this->closeFct();
                    }
                    catch(PDOException $e){
                        $messageAlert = "Les modifications n'ont pas été prise en compte." /*. $e->getMessage()*/;
                        $response = [
                            'message' => $messageAlert,
                            'class' => 'alert-danger'
                        ];
                        echo json_encode($response);
                        $this->closeFct();
                    }
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
    
    /**
     * getScoreMax
     * Get the score max for score %
     * @param  string $item
     * @return float
     */
    public function getScoreMax($item = null){
        $this->connectFct();
        $ScoreMaxQuery='';
        if($item === null){
            $ScoreMaxQuery = "SELECT (SUM(max * ponderation)) AS sum FROM notation;";
            $resultScoreMax = $this->dbQuery($ScoreMaxQuery)[0];
            $this->closeFct();
        }
        else{
            $ScoreMaxQuery = $this->pdo->prepare("SELECT (SUM(max * ponderation))AS sum FROM notation WHERE item = :item;");
            $ScoreMaxQuery->execute([
                'item' => $item
            ]);
            $resultScoreMax = $ScoreMaxQuery->fetch();
            $this->closeFct();
        }
        
        return $resultScoreMax['sum'];
    }
    
    /**
     * getItem
     * Get an array of all item
     * @return array
     */
    public function getItem(){
        $this->connectFct();
        $itemQuery = "SELECT item, sous_item FROM notation ORDER BY id_note;";
        $itemResult = $this->dbQuery($itemQuery);
        $itemArray = [];
        foreach($itemResult as $item){
            $itemArray[] = $item['item'] . "/" . $item["sous_item"]; 
        }
        return $itemArray;
    }

}


?>