<?php
session_start();

if (isset($_GET["id"])){
    $id = $_GET["id"];


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'webshop_db';
    
    
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM products WHERE id=$id";
    $connection->query($sql);
}

header("location: /webshop-php/administrator.php");
exit;
?>