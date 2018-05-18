<?php
require("../conexion.php");
switch ($_POST['action']) {
  case 'registro':
    $user=$_POST["usuario"];
    $pass=$_POST["regcontra"];
    $sql="CALL registro('".$user."','".$pass."');";

    $result=$conexion->query($sql)or trigger_error($conexion->error."[$sql]");
    $file = fopen("/etc/vsftpd.chroot_list", "a");
    fwrite($file,"".$user);
    fclose($file);
    // exec("");
    // $datos=array();
    // while ($row=$result->fetch_array()){
    //   $datos[]=$row;
    // }
    //   print_r(json_encode($datos));
    // system("su juandeb");
    $comando = "sudo useradd -g juandeb -d /home/".$user." -m -s /bin/bash ".$user." -p ".$pass;//"adduser ".$usuario." -g ".$grupo;
      if(!system($comando)){
      exec("sudo mkdir /home/".$user."/Descargas,Subidos");
      // exec("sudo mkdir /home/".$user."/Subidos");
      echo "El usuario ".$user." se ha creado";
    }
    // useradd -g juandeb -d /home/pedro -m -s /bin/bash roman
    break;
  default:
    # code...
    break;
}
	$conexion->close();
?>
