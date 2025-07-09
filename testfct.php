<?php
/*
$env = file_get_contents(__DIR__."/.env");
$lines = explode("\n",$env);

foreach($lines as $line){
  preg_match("/([^#]+)\=(.*)/",$line,$matches);
  if(isset($matches[2])){ putenv(trim($line)); }
} 

echo getenv('PASSWORD');
*/

/*
$restaurantsArray = [1,2,3,4];
$itemsArray = ['/', '-', '+', '*'];
$sousitemsArray = ['a','b','c','d','e','f','g','h','i','j','k','l','m'];
*/

/*
foreach($restaurantsArray as $restaurant){
    foreach($itemsArray as $item){
        foreach($sousitemsArray as $sousitem){
            echo $restaurant . $item . $sousitem . PHP_EOL;
        }
    }
}
*/

/*
echo count($restaurantsArray);
*/

/* 
<select name="<?= $evalLine["item"] . '/' . $evalLine['sous_item'] ?>">
<?php for($i = $evalLine['min']; $i <= $evalLine['max']; $i + $evalLine['ponderation']): ?>
    <option><?= $i ?></option>
<?php endfor ?>
</select>
*/

?>