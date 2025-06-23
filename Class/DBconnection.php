<?php
class DBconnection{
    private $dsn = 'pgsql:host=localhost;dbname=pizzanote';
    private $user = 'postgres';
    private $password = '29017507';
    private $pdo = null;
    
    /**
     * connectFct
     *
     * @return void
     */
    public function connectFct(){
        try{
            $this->pdo =new PDO($this->dsn, $this->user, $this->password);
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
        return "La connection à la base de donnée a été fermée avec succés.";
    }

        /**
     * dbQuery
     *
     * @param  string $pizzaQuery
     * @param  string $queryType
     * @return void
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
            return $pizzaQuerry . " / " . $exception;
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
