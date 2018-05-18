<?php
  session_start();
  if(!isset($_SESSION["user"])){
    header("Location:index.php");
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>subir</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/bootstrap.js" charset="utf-8"></script>
    <script src="js/popper.js" charset="utf-8"></script>
    <script src="js/funciones.js" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        getInit();
        $("#cerrar_sesion").click(function(){
          $.post('core/Login/controller_login.php',{action:'cerrar_sesion'},function(){
            location.reload();
          });
        });
        $("#cargar").click(function(){

          var arch=$("#archivo").val();
          // console.log(arch);
          //alert(nom_arc);
          $.post('core/Usuarios/controller_usuario.php',{action:'subir',arch:arch},function(res){
            alert(res);
          });
        });

        $("#valor").on('click',"a.btnArchivo",function () {
           nombre_arch+="/"+$(this).data("id");
           var nombre=$(this).data("id");
           console.log(nombre_arch);
          $.post('core/Usuarios/controller_usuario.php',{action:'bajar',nombre_arch:nombre_arch,nombre:nombre},function(res){
            alert(res); location.reload();
          });
        });

        var nombre_arch="/home";
        $("#valor").on('click',"a.btnCarpeta",function () {
          nombre_arch+="/"+$(this).data("id");
          // console.log(nombre_arch);
          getArchivos(nombre_arch);
        });
        $("#valor").on('click',"a.btnRegresar",function () {
          // nombre_arch;
          var nombre_arch_temp="";
          var ind=0;
          var con=0;
          console.log(nombre_arch);
          for (var i = 0; i <= nombre_arch.length; i++) {
            if(nombre_arch.charAt(i)=="/"){
              ind=i;
              con++;
            }
            // console.log(nombre_arch_temp);
          }
          for (var i = 0; i < ind; i++) {
            nombre_arch_temp+=nombre_arch.charAt(i);
          }
          // console.log(ind+" "+con+" "+nombre_arch_temp);
          // console.log(nombre_arch_temp);
          nombre_arch=nombre_arch_temp;
          getArchivos(nombre_arch);
        });

      });
      function getArchivos(para){
        var nombre_dir=para;
        console.log(nombre_dir);
        $.post('core/Usuarios/controller_usuario.php',{action:'dirNav',nombre_dir:nombre_dir},function(res){
          var datos=JSON.parse(res);
          console.log(res);
          // console.log(dir);
          var html="";
          html+='<div class="btn btn-outline text-warning card text-center col-md-2"><a data-id="'+datos[1]+'" class="btn btn-outline btnRegresar" ><div class="card-body"> <i class="fas fa-reply icon-file"></i></div><div class="card-footer text-muted">'+datos[1]+'</div></a></div>';

          var datemp="";
          var datemp2="";
          var ind=0;
          var conf=0;
          for (var i = 0; i < datos.length; i++) {
              if (datos[i].charAt(0)==".") {
                ind++;
              }
            }
            // console.log(ind);
            for (var i = ind; i < datos.length; i++) {
              // var info=datos[i];<a data-id="'+datos[i]+'" class="btn btn-outline btnArchivo"><i class="far fa-file icon-file"></i>'+datos[i]+'</a>
              var dato=datos[i];
              conf=2;
              for (var j = 0; j < dato.length; j++) {
                if (dato.charAt(j)==".") {
                  conf=1;
                  for (var k = j; k < dato.length; k++) {
                     datemp+=dato.charAt(k);
                  }
                }
              }


              if ((datemp==".png" && conf==1) || (datemp==".jpg" && conf==1)) {
                html+='<div class="btn btn-outline text-warning card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-image icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if (datemp==".pdf" && conf==1) {
                html+='<div class="btn btn-outline text-danger card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-pdf icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if ((datemp==".doc"&& conf==1) || (datemp==".docx"&& conf==1) || (datemp==".odt"&& conf==1)) {
                html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-word icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if ((datemp==".xls"&& conf==1) || (datemp==".xlsx"&& conf==1) || (datemp==".ods"&& conf==1)) {
                html+='<div class="btn btn-outline text-success card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-excel icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if ((datemp==".sh"&& conf==1) || (datemp==".bash"&& conf==1) || (datemp==".js"&& conf==1) || (datemp==".html"&& conf==1) || (datemp==".php"&& conf==1) || (datemp==".sql"&& conf==1)) {
                html+='<div class="btn btn-outline text-dark card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-code icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if (datemp==".txt"&& conf==1) {
                html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-alt icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if ((datemp==".zip"&& conf==1) || (datemp==".rar"&& conf==1) || (datemp==".tar"&& conf==1) ) {
                html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-archive icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if (datemp==".mp3"&& conf==1) {
                html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-audio icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }
              if (conf==2) {

                html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnCarpeta" ><div class="card-body"> <i class="far fa-folder icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
              }

              datemp="";
              // html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+datos[i]+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-folder icon-file"></i></div><div class="card-footer text-muted">'+datos[i]+'</div></a></div>';
            }
          $("#valor").html(html);

        });
      }
        function getInit(){
          // var nombre_dir=para;
          // console.log(nombre_dir);
          $.post('core/Usuarios/controller_usuario.php',{action:'dir'},function(res){
            var datos=JSON.parse(res);
            console.log(res);
            // console.log(dir);
            var html="";
            html+='<div class="btn btn-outline text-warning card text-center col-md-2"><a data-id="'+datos[1]+'" class="btn btn-outline btnRegresar" ><div class="card-body"> <i class="fas fa-reply icon-file"></i></div><div class="card-footer text-muted">'+datos[1]+'</div></a></div>';

            var datemp="";
            var datemp2="";
            var ind=0;
            var conf=0;
            for (var i = 0; i < datos.length; i++) {
                if (datos[i].charAt(0)==".") {
                  ind++;
                }
              }
              // console.log(ind);
              for (var i = ind; i < datos.length; i++) {
                // var info=datos[i];<a data-id="'+datos[i]+'" class="btn btn-outline btnArchivo"><i class="far fa-file icon-file"></i>'+datos[i]+'</a>
                var dato=datos[i];
                conf=2;
                for (var j = 0; j < dato.length; j++) {
                  if (dato.charAt(j)==".") {
                    conf=1;
                    for (var k = j; k < dato.length; k++) {
                       datemp+=dato.charAt(k);
                    }
                  }
                }


                if ((datemp==".png" && conf==1) || (datemp==".jpg" && conf==1)) {
                  html+='<div class="btn btn-outline text-warning card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-image icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if (datemp==".pdf" && conf==1) {
                  html+='<div class="btn btn-outline text-danger card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-pdf icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if ((datemp==".doc"&& conf==1) || (datemp==".docx"&& conf==1) || (datemp==".odt"&& conf==1)) {
                  html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-word icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if ((datemp==".xls"&& conf==1) || (datemp==".xlsx"&& conf==1) || (datemp==".ods"&& conf==1)) {
                  html+='<div class="btn btn-outline text-success card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-excel icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if ((datemp==".sh"&& conf==1) || (datemp==".bash"&& conf==1) || (datemp==".js"&& conf==1) || (datemp==".html"&& conf==1) || (datemp==".php"&& conf==1) || (datemp==".sql"&& conf==1)) {
                  html+='<div class="btn btn-outline text-dark card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-code icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if (datemp==".txt"&& conf==1) {
                  html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-alt icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if ((datemp==".zip"&& conf==1) || (datemp==".rar"&& conf==1) || (datemp==".tar"&& conf==1) ) {
                  html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-archive icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if (datemp==".mp3"&& conf==1) {
                  html+='<div class="btn btn-outline text-default card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-file-audio icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }
                if (conf==2) {

                  html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+dato+'" class="btn btn-outline btnCarpeta" ><div class="card-body"> <i class="far fa-folder icon-file"></i></div><div class="card-footer text-muted">'+dato+'</div></a></div>';
                }

                datemp="";
                // html+='<div class="btn btn-outline text-primary card text-center col-md-2"><a data-id="'+datos[i]+'" class="btn btn-outline btnArchivo" ><div class="card-body"> <i class="far fa-folder icon-file"></i></div><div class="card-footer text-muted">'+datos[i]+'</div></a></div>';
              }
            $("#valor").html(html);

          });
      }

    </script>
  </head>
  <body>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="" id="name"><?php echo $_SESSION["name"]." ".$_SESSION["pass"] ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn"  id="cerrar_sesion">Cerrar Sesion</a>
      </li>

    </ul>
    <div class="container padding">
      <div class="col-md-offset-4">
        <div class="card text-center">
          <div class="card-header" id="saludo">
            <form method="POST" enctype="multipart/form-data" action="subir_archivo.php">
              <input type="file" name="archivo" id="archivo" />
              <input type="submit" class="btn btn-primary" value="Enviar" id="cargar" />
            </form>
          </div>
          <div class="card-body row" id="valor">



          </div>
      </div>
    </div>
  </body>
</html>
