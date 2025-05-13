<?php
  $server="localhost";
  $database="restaurant";
  $user="root";
  $password="";

  try {
    $connection = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
  }
?>
