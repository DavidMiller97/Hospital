<?php
session_start();

$mysqli = new mysqli(
  'localhost',
  'root',
  'usbw',
  'hospital'
);

if ($mysqli -> connect_errno){
  echo "Fallo en conexión a MySQL: " . $mysqli -> connect_error;
}
?>