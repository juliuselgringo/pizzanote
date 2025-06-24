<?php
require_once "DBconnection.php";

class Evaluation extends DBconnection{

    public function getEvalution() {
        $this->connectFct();
        $evalQuery = "SELECT * FROM notation;";
        return $this->dbQuery($evalQuery);
    }

    public function getSessionNote(){
        $this->connectFct();
        $evalQuery = "SELECT * FROM session;";
        return $this->dbQuery($evalQuery);
    }

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
            $resultQuery[] = "('" . $idSession . "','" . $restaurant . "','" . $item . "','" .$sousitem . "','" . $name . "'," . $note . ")";
        }
        $values = implode("," , $resultQuery);
        $finalQuery = "INSERT INTO session (idSession, restaurant, item, sous_item, name, note) VALUES $values";
        $alertMsg = $this->dbQuery($finalQuery, 'insert');
        return $alertMsg;
    }

}

?>