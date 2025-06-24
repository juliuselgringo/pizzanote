<?php
require_once "DBconnection.php";

class Evaluation extends DBconnection{

    public function getEvalution() {
        $this->connectFct();
        $evalQuery = "SELECT * FROM notation;";
        return $this->dbQuery($evalQuery);
    }
}

?>