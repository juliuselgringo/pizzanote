<?php
if($pizzaConfig){
    $pizzaConfig = new DBconnection;
    $alertMsg = $pizzaConfig->closeFct();
}
session_start();
unlink('image-qrcode.png');
unset($_SESSION['name']);
unset($_SESSION['restaurant']);
unset($_SESSION['idSession']);
header("Location: /index.php");

?>