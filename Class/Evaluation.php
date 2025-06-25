<?php
require_once "DBconnection.php";

/**
 * Evaluation
 * get data to display note sheet, insert new data, get data from session table
 */
class Evaluation extends DBconnection{
    private $regex = '/^[0-9]$/';
    
    /**
     * getEvalution
     * get data to display note sheet
     * 
     * @return array
     */
    public function getEvalution() {
        $this->connectFct();
        $evalQuery = "SELECT * FROM notation;";
        return $this->dbQuery($evalQuery);
    }
    
    /**
     * getSessionNote
     * get data from session table
     * 
     * @return array
     */
    public function getSessionNote(){
        $this->connectFct();
        $evalQuery = "SELECT * FROM session;";
        return $this->dbQuery($evalQuery);
    }
    
    /**
     * sendEvaluation
     * insert data of a new session
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