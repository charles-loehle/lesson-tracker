<?php 

$student_name = $_POST['student_name'];
$instrument = $_POST['instrument'];
$parent_name = $_POST['parent_name'];
$parent_email = $_POST['parent_email'];
$phone = $_POST['phone'];

if(!$student_name) {
  $errors[] = 'Name is required';
}

if(!$instrument) {
  $errors[] = 'Instrument is required';
}

