<?php 

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];

if(!$name) {
  $errors[] = 'Name is required';
}

if(!$username) {
  $errors[] = 'Username is required';
}

if(!$email) {
  $errors[] = 'Email is required';
}
