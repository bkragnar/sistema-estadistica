 //--------------- contar cada 5 seg por token user-log ----------
 //control panel
 $("#control").show();
 var controlpanel_ruta = ("static/transaccion/token_control.php");

 //refresco de divs
 $(function() {
     token_control();
 });

 //control
 var timer;
 var seconds = 5; // 5s

 function token_control() {
     timer = setInterval(function() {
         $("#control").load(controlpanel_ruta);
     }, seconds * 1000)
 }

 //--------------------------------------------------------------
 //--------------------------------------------------------------