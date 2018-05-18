<?php

require_once("../conexion.php");
  switch ($_POST['action']) {
    case 'login':
    // establecer una conexión básica
        // $ftp_server='192.168.1.75';
        $ftp_server='10.10.0.84';
        $username=htmlentities(addslashes($_POST["username"]));
        $pass=htmlentities(addslashes($_POST["pass"]));
        //ftp_pass($conn_id, true);
        $conn_id = ftp_connect($ftp_server);

        // echo $conn_id;
        // iniciar una sesión con nombre de usuario y contraseña
        $login_result = ftp_login($conn_id, $username, $pass);

        // verificar la conexión
        if ((!$conn_id) || (!$login_result)) {
          // echo "¡La conexión FTP ha fallado!";
          // echo "Se intentó conectar al $ftp_server por el usuario $username";
          echo "<h6> Usuario o contraseña incorrecto</h6>";
          // exit;
        } else {
          // echo "Conexión a $ftp_server realizada con éxito, por el usuario $ftp_user_name";

          $sql="select * from usuarios where nombre_usuario='".$username."' and contra='".$pass."';";
          $result=$conexion->query($sql)or trigger_error($conexion->error."[$sql]");
          if($result->num_rows>0){

              $datos=$result->fetch_assoc();

              session_start();
              $_SESSION['user']=$datos["id_usuario"];
              $_SESSION["name"]=$datos["nombre_usuario"];
              $_SESSION["pass"]=$datos["contra"];
              ?>
              <script>
              window.location.href='usuario.php';
              </script>

              <?php

            }
          }
         ftp_close($conn_id);
      break;
      case 'cerrar_sesion':
      session_start();
      session_destroy();
      ?>
      <script>
      window.location.href='usuario.php';
      </script>

      <?php
      ftp_close($conn_id);

      break;
    case 'subir':

    $ftp_server='10.0.0.84';
    // $ftp_server='192.168.1.75';
    $ftp_user_name="juandeb";
    $ftp_user_pass="Juandres_0602";
    //ftp_pass($conn_id, true);
    $conn_id = ftp_connect($ftp_server);
    $file = $_FILES["archivo"]["name"];
    $remote_file = $_FILES["archivo"]["tmp_name"];

    // set up basic connection
    $conn_id = ftp_connect($ftp_server);

    // login with username and password
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    // upload a file
    if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
     echo "successfully uploaded $file\n";
    } else {
     echo "There was a problem while uploading $file\n";
    }

    // close the connection
    ftp_close($conn_id);
    // // iniciar una sesión con nombre de usuario y contraseña
    // $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    // ftp_pass($conn_id, true) ;
    // $local = $_FILES["archivo"]["name"];
    // $remoto = $_FILES["archivo"]["tmp_name"];
    // $ruta = "/home/123456/". $local;
    // copy($remoto, $ruta);
    //subir un archivo
    // $destination_file='holisserver.txt';
    // $source_file = 'holis.txt';//$_FILES['archivo']['tmp_name'];
    // echo $source_file;
    // $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
    //
    //   //comprobar el estado de la subida
    //   if (!$upload) {
    //     echo "¡La subida FTP ha fallado!";
    //   } else {
    //     echo "Subida de $source_file a $ftp_server como $destination_file";
    //   }
      break;
    case 'SO':
    $cad="";
    $SO = $_SERVER['HTTP_USER_AGENT'];
    // for ($i=0; $i <strlen($SO) ; $i++) {
    //   $cad.=$SO{$i};
    //   if ($cad{$i}==" ") {
    //     $cad="";
    //   }
    //   if ($cad=="Android") {
    //     echo "Android";
    //   }else{
    //     echo "Linux";
    //   }
    // }
    echo exec("pwd");



    // echo "La plataforma con la que estas visitando esta web es: ".$SO;
      break;
    default:
      # code...
      break;
  }
  $conexion->close();

?>
