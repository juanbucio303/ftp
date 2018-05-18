<?php
$conexion=new mysqli("localhost","phpmyadmin","123456","ftpd");
if ($conexion->connect_errno) {
  printf("Fallo conexion %s\n",$conexion->mysqli_error);
  exit();
}

?>
