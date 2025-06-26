<?php
require_once 'DBconnection.php';
require_once 'Evaluation.php';

class Restaurant extends Evaluation{

    private function deleteData(){
        $resetQuery = "TRUNCATE restaurant;";
        $this->dbQuery($resetQuery);
    }
    
    public function getArrays(){
        $dataSession = $this->getSessionNote();
        $restaurantsArray = [];
        $sessionsArray = [];
        $Arrays = [];
        foreach($dataSession as $dataInput){
            $restaurantsArray[] = $dataInput['restaurant'];
            $restaurantsArray = array_unique($restaurantsArray, SORT_STRING);
            $sessionsArray[] = $dataInput['idsession'];
            $sessionsArray = array_unique($sessionsArray, SORT_STRING);
            //+itemArray<-notation
            //+sousitemArray<-notation
            //+itemSousitemArray<-notation
        }
        $Arrays = ['restaurants' => $restaurantsArray, 'sessions' => $sessionsArray];
        return $Arrays;
    }
    // Objectif: "SELECT item, sous_item, ROUND(AVG(note),2) FROM session WHERE restaurant = $restaurant GROUP BY item, sous_item ORDER BY item;"
  
}

?>