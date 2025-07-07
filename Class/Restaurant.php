<?php
require_once 'DBconnection.php';

/**
 * Restaurant
 *  Display restaurant result from best to worst
 *  Get data from a restaurant input
 *  Get an array of all restaurant evaluated
 * 
 */
class Restaurant extends DBconnection{
    
    /**
     * getBest
     * Display restaurant result from best to worst
     * @return array
     */
    public function getBest(){
        $this->connectFct();
        $queryTable = "SELECT * FROM best_restaurant;";
        $resultArray = $this->dbQuery($queryTable, 'select');
        $this->closeFct();
        return $resultArray;
    }
        
    /**
     * getRestaurantItem
     * Get data from a restaurant input
     * @param  string $restaurant
     * @return array
     */
    public function getRestaurantItem($restaurant){
        $this->connectFct();
        $queryTable = $this->pdo->prepare("SELECT * FROM restaurant_result_item WHERE restaurant = :restaurant;");
        $queryTable->execute([
            'restaurant' => $restaurant
        ]);
        $this->closeFct();
        $resultArray = $queryTable->fetchAll();
        return $resultArray;
    }
    
    /**
     * getArrayRestaurant
     * Get an array of all restaurant evaluated
     * @return array
     */
    public function getArrayRestaurant(){
        $this->connectFct();
        $queryTable = "SELECT restaurant FROM best_restaurant;";
        $resultArray = $this->dbQuery($queryTable, 'select');
        $this->closeFct();
        return $resultArray;
    }

}

?>