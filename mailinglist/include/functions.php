<?php

function mailExists($connexion, $mail){
  $query = $connexion->prepare('SELECT COUNT(*) AS total FROM user WHERE mail = :mail');
  $query->bindValue(':mail', $mail);
  $query->execute();
  if($result = $query->fetch()){
    return !empty($result['total']);
  }
  return false;
}

function getConnectedAdmin($connexion){
  if(empty($_SESSION['admin_secret'])){
    return false;
  }
  $secret = $_SESSION['admin_secret'];
  $query = $connexion->prepare('SELECT * FROM admin WHERE secret = :secret');
  $query->bindValue(':secret', $secret);
  $query->execute();
  if($admin = $query->fetch()){
    return $admin;
  }else{
    return false;
  }
}

function redirectTo($url){
  header('Location: '.$url);
  exit;
}

function validateDate($input, $format = 'Y-m-d H:i:s'){
    $date = DateTime::createFromFormat($format, $input);
    return $date && $date->format($format) == $input;
}

function displayTasks($tasks){
  include('tasks.view.php');
}
