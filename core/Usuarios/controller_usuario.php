<?php
  require("../conexion.php");
  switch ($_POST['action']) {
    case 'dir':
    session_start();
    $id=$_SESSION['user'];
    $sql="SELECT directorios.nombre_directorio,usuarios.id_tipo_usuario,usuarios.nombre_usuario FROM usuarios,directorios WHERE usuarios.id_directorio=directorios.id_directorio AND usuarios.id_usuario=".$id.";";
    $result=$conexion->query($sql)or trigger_error($conexion->error."[$sql]");
    $datos=$result->fetch_assoc();

    if ($datos["id_tipo_usuario"]==1) {
      # code...
      $dir="/".$datos["nombre_directorio"];//"/".$datos["nombre_directorio"]."/";
      $archivos=scandir($dir);
      print_r(json_encode($archivos));
    }else {
      $dir="/".$datos["nombre_directorio"]."/".$datos["nombre_usuario"];
      $archivos=scandir($dir);
      print_r(json_encode($archivos));
      // echo $dir;
    }

    // $archivos=scandir("/".$datos["nombre_directorio"]."/".$_POST["nombre_dir"]);

      // print_r(json_encode($archivos));
      // print_r($_POST["nombre_dir"]);

      break;
      case 'dirNav':
      session_start();
        $dir=$_POST["nombre_dir"];//"/".$datos["nombre_directorio"]."/";
        $archivos=scandir($dir);
        // echo $dir;
        print_r(json_encode($archivos));

        break;
    case 'bajar':
    // $ftp_server='127.0.0.1';
      session_start();
      $ftp_server='10.0.0.84';
      // $ftp_server='192.168.1.75';
      $ftp_user_name=$_SESSION["name"];
      $ftp_user_pass=$_SESSION['pass'];
      $nombre_arch=$_POST["nombre_arch"];
      $nombre=$_POST["nombre"];

      // echo $nombre_arch
      // ruta al archivo remoto
      $remote_file = $nombre_arch;
      $local_file = '/home/ftp/Descargas/'.$nombre;
      // establecer una conexión básica
      $conn_id = ftp_connect($ftp_server);
      // iniciar sesión con nombre de usuario y contraseña
      $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
      // copy($remote_file,$local_file);
      if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)) {
        echo "Successfully written to $local_file\n";
      }
      else {
          echo "There was a problem\n";
      }
      // cerrar la conexión ftp
      ftp_close($conn_id);
      $remote_file="";

      break;

    default:
      # code...
      break;
  }

 ?>
