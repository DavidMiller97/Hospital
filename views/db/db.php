<?php
session_start();

$mysqli = new mysqli(
  '127.0.0.1',
  'davidPHP',
  'IGotAllTheTimeInTheWorld21',
  'hospital', 3306
);

if ($mysqli -> connect_errno){
  echo "Fallo en conexión a MySQL: " . $mysqli -> connect_error;
}
?>