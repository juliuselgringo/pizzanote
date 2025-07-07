<?php
require_once "DBconnection.php";

/**
 * Evaluation
 * get data from notation table
 * display note sheet from notation table
 * get data from session table 
 * insert new data from note sheet
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
        $min = htmlentities($evalLine['min']);
        $max = htmlentities($evalLine['max']);
        for($i = $min; $i <= $max; $i++){
            echo "<option>" . htmlentities($i) . "</option>";
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
            $sous_item = $itemSousitemArr[1];
            $idNote = $itemSousitemArr[2];
            if(preg_match($this->regex, $note)){
                $resultQuery[] = [$idSession,$restaurant,$item,$sous_item,$name,$note,$idNote];
            }
            else{
                $alertMsg = "Saisie invalide!";
                return $alertMsg;
            }
        }
        $values = implode("," , $resultQuery);

        try{
            for($i = 0; $i < count($resultQuery); $i++){
                $finalQuery = $this->pdo->prepare("INSERT INTO session 
                (idSession, restaurant, item, sous_item, name, note, id_note) VALUES (:idSession, :restaurant, :item, :sous_item, :name, :note, :idNote);");
                $finalQuery->bindParam('idSession', $resultQuery[$i][0]);
                $finalQuery->bindParam('restaurant', $resultQuery[$i][1]);
                $finalQuery->bindParam('item', $resultQuery[$i][2]);
                $finalQuery->bindParam('sous_item', $resultQuery[$i][3]);
                $finalQuery->bindParam('name', $resultQuery[$i][4]);
                $finalQuery->bindParam('note', $resultQuery[$i][5]);
                $finalQuery->bindParam('idNote', $resultQuery[$i][6]);
                $finalQuery->execute();
                
            }
            return "Votre évaluation a été enregistré avec succés.";
        }
        catch(PDOException $e){
            $error = $e->getMessage();
            return "Erreur lors de l'insertion!" . $error;
        }

    }

}

?>