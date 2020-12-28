<?php 

include_once 'config.php';

$pdo = new PDO('mysql:host=' . URL . ';port=3306;dbname=' . DB, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;