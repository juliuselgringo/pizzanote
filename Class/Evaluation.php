<?php
require_once "DBconnection.php";

/**
 * Evaluation
 * display note sheet from notation data, get data from session table, insert new data from note sheet
 */
class Evaluation extends DBconnection{
    private $regex = '/^(?:[0-9](?:[.,]5)?|[0-9][.,]5)$/';
    
    /**
     * getNotation
     * get data for note sheet from notation data
     * 
     * @return array
     */
    public function getNotation() {
        $this->connectFct();
        $evalQuery = 'SELECT * FROM notation GROUP BY id_note, item ORDER BY item;';
        return $this->dbQuery($evalQuery);
    }
        
    /**
     * displayNotesheet
     * display option for the select html
     * @param  array $evalLine
     * @return string
     */
    public function displayNotesheet($evalLine){
        $min = $evalLine['min'];
        $max = $evalLine['max'];
        for($i = $min; $i <= $max; $i++){
            echo "<option>" . $i . "</option>";
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
        $dataNote = array_splice($_POST, 0, 27); # pour enlever le bouton send de $_post
        foreach($dataNote as $itemSousitem => $note){
            $itemSousitemArr = explode("/", $itemSousitem);
            $item = $itemSousitemArr[0];
            $sousitem = $itemSousitemArr[1];
            $idNote = $itemSousitemArr[2];
            if(preg_match($this->regex, $note)){
                $resultQuery[] = "('" . $idSession . "','" . $restaurant . "','" . $item . "','" .$sousitem . "','" . $name . "', " . $note . ", " . (int)$idNote . ")";
            }
            else{
                $alertMsg = "Saisie invalide!";
                return $alertMsg;
            }
        }
        $values = implode("," , $resultQuery);
        $finalQuery = "INSERT INTO session (idSession, restaurant, item, sous_item, name, note, id_note) VALUES $values";
        $alertMsg = $this->dbQuery($finalQuery, 'insert');
        return $alertMsg;
    }

}

?>