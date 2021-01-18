<?php 

$pdo = require_once 'database.php';

$id = $_POST['id'] ?? null;

if(!$id) {
  header('Location: users.php');
  exit;
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();

header('Location: users.php');