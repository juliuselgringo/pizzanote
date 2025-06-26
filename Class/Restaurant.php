<?php
require_once 'DBconnection.php';

class Restaurant extends DBconnection{
    
    /**
     * getBest
     * 
     * @return array
     */
    public function getBest(){
        $this->connectFct();
        $queryTable = "SELECT * FROM best_restaurant;";
        $resultArray = $this->dbQuery($queryTable, 'select');
        $this->closeFct();
        return $resultArray;
    }
    
    public function getRestaurantItem($restaurant){
        $this->connectFct();
        $queryTable = "SELECT * FROM restaurant_result_item WHERE restaurant = '$restaurant';";
        $resultArray = $this->dbQuery($queryTable, 'select');
        $this->closeFct();
        return $resultArray;
    }

    public function getArrayRestaurant(){
        $this->connectFct();
        $queryTable = "SELECT restaurant FROM best_restaurant;";
        $resultArray = $this->dbQuery($queryTable, 'select');
        $this->closeFct();
        return $resultArray;
    }

}

?>