<?php
if(isset($pizzaConfig)){
    $pizzaConfig->closeFct();
}
session_start();
if (file_exists('image-qrcode.png')){
    unlink('image-qrcode.png');
}
unset($_SESSION['name']);
unset($_SESSION['restaurant']);
unset($_SESSION['idSession']);
header("Location: /index.php");

?>