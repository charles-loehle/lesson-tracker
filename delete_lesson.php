<?php

$pdo = require_once 'database.php';

// get lesson id 
$lesson_id = $_POST['lesson_id'] ?? null;
$user_id = $_POST['user_id'];

// var_dump($lesson_id, $user_id); 

$stmt = $pdo->prepare("DELETE FROM lessons WHERE id = :lesson_id");
$stmt->bindValue(':lesson_id', $lesson_id);
$stmt->execute();

// var_dump($lesson_id, $user_id); 

header("Location: user_lessons.php?id=" . $user_id);