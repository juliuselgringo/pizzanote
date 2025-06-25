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
        $restaurantArray = [];
        $sessionArray = [];
        $Arrays = [];
        foreach($dataSession as $dataInput){
            $restaurantArray[] = $dataInput['restaurant'];
            $restaurantArray = array_unique($restaurantArray, SORT_STRING);
            $sessionArray[] = $dataInput['idsession'];
            $sessionArray = array_unique($sessionArray, SORT_STRING);
        }
        $Arrays = ['restaurants' => $restaurantArray, 'sessions' => $sessionArray];
        return $Arrays;
    }



}

?>