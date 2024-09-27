<?php
$dsn = 'mysql:host=localhost;dbname=multi_api';
$username = 'root';
$password = '';

//Create a PDO Instance

try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Connection Failed: " . $e->getMessage());
}