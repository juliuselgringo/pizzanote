<?php

class DBconnection{
    
    public $pdo = null;
    
    /**
     * connectFct
     *
     * @return void
     */
    public function connectFct(){
        $env = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . ".env");
        $lines = explode("\n",$env);

        foreach($lines as $line){
        preg_match("/([^#]+)\=(.*)/",$line,$matches);
        if(isset($matches[2])){ putenv(trim($line)); }
        }
        $dns = 'pgsql:host=localhost;port=5432;dbname=' . getenv('DBNAME');
        $user = getenv('USER');
        $password = getenv('PASSWORD');
        try{
            $this->pdo =new PDO($dns, $user, $password);
            return 'Vous êtes connecté à la base de données.';
        }
        catch(PDOException $e){
            return 'Echec de la connection.' . $e->getMessage();
            exit;
        }
    }
    
    /**
     * closeFct
     *
     * @return void
     */
    public function closeFct() {
        $this->pdo = null;
        return "La connection à la base de données a été fermé avec succés.";
    }

        /**
     * dbQuery
     *
     * @param  string $pizzaQuery
     * @param  string $queryType
     * @return array
     */
    public function dbQuery($pizzaQuerry, $queryType = 'select'){
        try{
            $statement = $this->pdo->query($pizzaQuerry);
            if($statement->rowCount() > 0 && $queryType === 'select'){
                while ($row = $statement->fetchAll(PDO::FETCH_ASSOC)){
                    return $row;
                }
            }
            elseif ($queryType !== 'select') {
                return $queryType . " effectué";
            } else {
                return "La requête est vide";
            }
        } 
        catch (Exception $exception) {
            return "Requête non valide // " /*. $exception*/;
        }
    }
}

/*
$test = new DBconnection();
$test->connectFct();
$pizzaQuerry = 'SELECT * FROM notation;';
print_r($test->dbQuery($pizzaQuerry,'select'));
$test->closeFct();
*/
?>
