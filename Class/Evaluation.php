<?php
require_once "DBconnection.php";

/**
 * Evaluation
 * display note sheet from notation data, get data from session table, insert new data from note sheet
 */
class Evaluation extends DBconnection{
    private $regex = '/^(?:[0-9](?:[.,]5)?|[0-9][.,]5)$/';
    
    /**
     * getEvalution
     * display note sheet from notation data
     * 
     * @return array
     */
    public function getEvalution() {
        $this->connectFct();
        $evalQuery = 'SELECT * FROM notation GROUP BY id_note, item ORDER BY item;';
        return $this->dbQuery($evalQuery);
    }
    
    public function displayNotesheet($evalLine){
        $min = $evalLine['min'];
        $max = $evalLine['max'];
        $step = $evalLine['ponderation'];
        if($step === 0.5){
            $step = 1;
            $min = $min * 2;
            $max = $max * 2;
            for($i = $min; $i <= $max; $i++){
                echo "<option>" . $i/2 . "</option>";
            }
        }
        else{
            for($i = $min; $i <= $max; $i++){
                echo "<option>" . $i . "</option>";
            }
        }
    }

    /**
     * getSessionNote
     * get data from session table
     * 
     * @return array
     */
    public function getSessionNote($idSession, $pseudo = ""){
        $this->connectFct();
        if(empty($pseudo)){
            $evalQuery = "SELECT * FROM session WHERE idsession = $idSession;";
        }
        else{
            $evalQuery = "SELECT * FROM session WHERE idsession = $idSession, name = $pseudo;";
        }
        $this->closeFct();
        return $evalQuery;
    }
    
    /**
     * sendEvaluation
     * insert new data from note sheet
     * 
     * @return string
     */
    public function sendEvaluation(){
        $this->connectFct();
        $idSession = $_SESSION['idSession'];
        $name = $_SESSION['name'];
        $restaurant = $_SESSION['restaurant'];
        $alertMsg = '';
        $dataNote = array_splice($_POST, 0, 27);
        foreach($dataNote as $itemSousitem => $note){
            $itemSousitemArr = explode("/", $itemSousitem);
            $item = $itemSousitemArr[0];
            $sousitem = $itemSousitemArr[1];
            if(preg_match($this->regex, $note)){
                $resultQuery[] = "('" . $idSession . "','" . $restaurant . "','" . $item . "','" .$sousitem . "','" . $name . "'," . $note . ")";
            }
            else{
                $alertMsg = "Saisie invalide!";
                return $alertMsg;
            }
        }
        $values = implode("," , $resultQuery);
        $finalQuery = "INSERT INTO session (idSession, restaurant, item, sous_item, name, note) VALUES $values";
        $alertMsg = $this->dbQuery($finalQuery, 'insert');
        $_POST = [];
        return $alertMsg;
    }

}

?>