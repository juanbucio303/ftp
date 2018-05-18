<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> FTP</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/bootstrap.js" charset="utf-8"></script>
    <script src="js/popper.js" charset="utf-8"></script>
    <!-- <script src="js/three.js" charset="utf-8"></script>
    <script src="js/TweenMax.min.js" charset="utf-8"></script>
    <script src="js/bas.js" charset="utf-8"></script>
    <script src="js/OrbitControls-2.js" charset="utf-8"></script>
    <script  src="js/index.js"></script> -->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#SO").click(function(){
          $.post("core/Login/controller_login.php",{action:"SO"},function(res){
            $("#resp").html(res);
  				});
        });
        $("#form_registro").hide();
        $("#add-user").click(function(){
          $("#form_login").hide();
          $("#form_registro").show();

        });
        $("#cancelar_reg").click(function(){
          $("#form_registro").hide();
          $("#form_login").show();

        });
        $("#ingresar").click(function(){
          var username= $("#usuario").val();
          var pass= $("#pass").val();
          $.post("core/Login/controller_login.php",{action:"login",username:username,pass:pass},function(res){
            // alert(res); type="text/javascript"
            $("#resp").html(res);
  				});

        });
        $("#reg").click(function(){
          var nombre_usuario=$("#usuario").val();
          var pass=$("#regpass").val();
          var veripass=$("#veripass").val();
          if (pass==veripass) {
            $.post("core/Registro/controller_registro.php",$("#form_registro").serialize(),function(res){
              $("#resp").html(res);
            });
            // $("#form_registro").submit();
          }else {
            $(".val-contra").html("Las Contraseñas no coinciden");
          }
        });
      });
    </script>
  </head>
  <body class="bg-color">
    <div class="container padding center">
      <div class="text-center text-light" style="width: 18rem;">
          <form id="form_login" method="post">
            <i class="fas fa-user user"></i>
            <!-- <input value="login" id="action" name="action" type="hidden"> -->
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario"  placeholder="Usuario">
            </div>
            <div class="form-group">
              <label for="pass">Contraseña</label>
              <input type="password" class="form-control" id="pass" name="contra"placeholder="Contraseña">
            </div>
            <a class="btn btn-success" id="ingresar">Ingresar</a>
            <a class="btn" id="add-user">Registrate</a>
          </form>

          <form id="form_registro" method="post" >
            <i class="fas fa-user-plus user"></i>

            <input value="registro" id="action" name="action" type="hidden">
            <div class="form-group">
              <label for="usuario">Nombre de Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario"  placeholder="Usuario">
            </div>
            <div class="form-group">
              <label for="regpass">Contraseña</label>
              <input type="password" class="form-control" id="regpass" name="regcontra"placeholder="Contraseña">
              <small class="val-contra text-danger"></small>
            </div>
            <div class="form-group">
              <label for="veripass">Verificar Contraseña  </label>
              <input type="password" class="form-control" id="veripass" name="vericontra"placeholder="Verificar Contraseña">
              <small class="val-contra text-danger"></small>
            </div>
            <a class="btn btn-success" id="reg">Registrarse </a>
            <a class="btn btn-danger" id="cancelar_reg">Cancelar</a>
          </form>
      </div>
    </div>
    <button type="button" name="button" id="SO">SO</button>
    <div class="bg-danger" id="resp">

    </div>

    <!-- <div id="three-container"></div>

    <div id="instructions">
    	click and drag to control the animation
    </div> -->
  </body>
</html>
