<?php 

$pdo = require_once 'database.php';

// get student id 
$id = $_POST['id'] ?? null;
$user_id = $_POST['user_id'];

// get user id 
$stmt = $pdo->prepare("SELECT user_id FROM students WHERE user_id = :user_id");
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$id) {
  header("Location: user_students.php?id=" . $user_id);
  exit;
}

//var_dump($user_id); exit;

$stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();

// var_dump($user_id); exit;
header("Location: user_students.php?id=" . $user_id);

// user_students.php?id=6