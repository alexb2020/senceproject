<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>tu pagina</title>
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link href="../css/estilos.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

</head>
<body>
    <img src="../images/logo.png" alt="">
    <div class="text"><p>Si usted está registrado en un curso SENCE debe ingresar su usuario (su RUT sin punto, sin guión y sin dígito verificador) y su clave SENCE (CUS).</p></div>

<?php 
  
  header( "refresh:6;url=tu pagina" ); 
  $m = $_GET['m'];
  if ($m==1) {
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Usuario incorrecto o no existe</p></div>';
  }elseif ($m==2) {
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Debe ingresar un nombre de usuario</p></div>';
  }elseif ($m==3){
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Debe ingresar una clave SENCE</p></div>';
  }elseif($m==5){
  	header( "refresh:5;url=https://academia.global/acceso/" );
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Su usuario ya se encuentra registrado. Acceda a su cuenta a traves de <a href="https://tu pagina">https://tu pagina</a></p></div>';
  }elseif($m==6){

	echo '<div class="msg"> <p class="texto3" id="mensaje"> Hay un error en el CAPTCHA.</p></div>';
  }else {
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Debe ingresar un nombre de usuario.</p></div>';
  	echo '<div class="msg"> <p class="texto3" id="mensaje">Debe ingresar una clave SENCE.</p></div>';
  }

?>    
 
</body>
</html>

