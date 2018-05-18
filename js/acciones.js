$(document).ready(function(){

  $("#guardar").click(function(){
    var mac='holis'//$("#mac_address").val();
    var ip='holis'//$("#ip_address").val();
    var user='holis'//$("#usuario").val();
    $.post("core/Usuarios/controller_usuarios.php",{action:"guardar",mac:mac,ip:ip,usr:user},function(){

    });
  });

  $("#leer").click(function(){
    var ind=0;
    $.post("core/Usuarios/controller_usuarios.php",{action:"posicion"},function(res){
      var datos=JSON.parse(res);
      var cad="";
      //for para encontrar la posicion de la linea del usuario
      for (var i = 0; i < datos.length; i++) {
          for (var j = 0; j < datos[i].length; j++) {
            cad+=datos[i].charAt(j);
            //console.log(cad);
            for (var k = 0; k < cad.length; k++) {
              if (cad.charAt(k)==" ") {
               cad="";
             }
            }
            if (cad=="holis") {
              ind=i;
            }
          }
      }
      edit(ind,datos);
    });
  });
  $("#stop").click(function(){
    $.post("core/Usuarios/controller_usuarios.php",{action:"stop"},function(){

    })
  });
});
function edit( ind, datos){
  var ind=ind;
  var datos=datos;
  $.post("core/Usuarios/controller_usuarios.php",{action:"editar",ind:ind,datos:datos},function(res){
    //console.log(res);
  });
}scr
