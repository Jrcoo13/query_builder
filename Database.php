<?php

$dsn = 'mysql:host=127.0.0.1;dbname=ads';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);

try {
    if(!$pdo) {
        
    }
}
catch (Exception $exception) {
   die( $exception->getMessage());
}