 
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tu pagina</title>
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
 <img src="images/logo.png" alt="">
    <div class="text"><p>Si usted está registrado en un curso SENCE debe ingresar su usuario (su RUT sin punto, sin guión y sin dígito verificador) y su clave SENCE (CUS).</p></div>

  <form name="form" id="claveSence" action="php/registro.php" method="POST">

    <div class="todo">

        <p>
          <label for="username">Usuario<br>(RUT sin dígito verificador):<br></label>
          <input class="input-text" id="username" name="username" type="text" required>
        </p>

        <p>
          <label for="sence">Clave Sence:<br></label>
          <input class="input-text" id="sence" name="sence" type="text" required>
        </p>
	 
	  <div class="g-recaptcha" data-sitekey="clave de captcha"></div>

	  <input class="boton" type="submit" value="Entrar" >

      <div class="texto2">
          <h3>Si aún no tienes clave Sence haz clic <a target="_blank" href="http://cus.sence.cl/Account/Registrar">aquí</a></h3>
      </div>
    </div>
  </form>
</body>
</html>
