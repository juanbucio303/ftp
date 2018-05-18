<?php
session_start();
$directorio_archivo = "/home/".$_SESSION["name"]."/Subidos/"; // tipo /home/user/public_html/archivos/
$nombre = strtr($_FILES['archivo']['name'], "ñ'ÁÉÍÓÚÀÈÌÒÙáéíóúäëïöüàèìòù ", "n-AEIOUAEIOUaeiouaeiouaeiou_");
$tamanio = $_FILES['archivo']['size'];
$tipo = $_FILES['archivo']['type'];
copy($_FILES['archivo']['tmp_name'], $directorio_archivo.$nombre);
echo "el archivo se a subido correctamente al servidor<br>".$directorio_archivo.$nombre;
?>
