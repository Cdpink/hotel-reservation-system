<?php 
$localhost = "mysql:host=127.0.0.1;dbname=hotel_db";
$username = "root";
$password = "";

try{
    $pdo = new PDO($localhost, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
} catch (PDOException $e) {
    echo "Connection Failed". $e->getMessage(); 
}

?>