<?php
// This file is NOT a part of Moodle - http://moodle.org/
//
// This client for Moodle 2 is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
/**
 * REST client for Moodle 2
 * Return JSON or XML format
 *
 * @authorr Jerome Mouneyrac
 */

//Funcion para el rest api

function restcall($params, $functionname )
{
	
	$token = 'tu token';
	$domainname = 'tu sitio moodle';
	$restformat = 'json';

	header('Content-Type: text/plain');
	$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
	require_once('curl.php');
	$curl = new curl;
	//if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
	$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
	$resp = $curl->post($serverurl . $restformat, $params);
	return $resp;
}


//funcion para captcha
require_once('recaptchalib.php');

//preparando las variables del captcha
// clave secreta
$secret = "tu clave de captcha";
// empty response
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($secret);
$functionname1 = 'core_user_get_users_by_field';
$functionname2 = 'core_user_update_users';
$m = 0;
//Validamos parametros
if (empty($_POST['username']))
	$m = 2;
else $usern = strtolower($_POST['username']);

if (empty($_POST['sence'])){
	if ($m==2){
	 	$m=4;
	}else{
		$m=3;
	}
}else $sence = $_POST['sence'];

if ($_POST["g-recaptcha-response"]) {
     $response = $reCaptcha->verifyResponse(
     $_SERVER["REMOTE_ADDR"],
     $_POST["g-recaptcha-response"]
     );
  }

if ($response != null && $response->success) {
    // Si el código es correcto, seguimos procesando el formulario como siempre
    if ($m==0){
		$user=array('values'=>$usern);
		//formateo de informacion
		$buscarUser=array('field'=>'username', 'values' => $user);

		//busco el id
		$resp = restcall($buscarUser, $functionname1);

		if ($resp=="[]"){
			header("Location: mensaje.php?m=1", true, 301);
			exit();
		}

		$usuario = json_decode($resp, true);
		$id = $usuario[0]['id'];

		//verifico si existe la clave
		if (array_key_exists('customfields', $usuario[0])) {
			header("Location: mensaje.php?m=5", true, 301);
			exit();

		}else{
			$id = $usuario[0]['id'];
			$custom=array('type' => 'clavealumno', 'value' => $_POST['sence']);
			$user1 = new stdClass();
			$user1->id = $id;
			$user1->customfields = array($custom);
			//formateo de informacion
			$users = array($user1);
			$setSence = array('users' => $users);

			//segunda llamada
			$resp = restcall($setSence, $functionname2);

		//Redireccion de pagina web
			header("Location: tu pagina", true, 301);
			exit();
		}
	}else{
		header("Location: mensaje.php?m=$m", true, 301);
		exit();
	}
  } else {
    // Si el código no es válido, lanzamos mensaje de error al usuario
    header("Location: mensaje.php?m=6", true, 301);
	exit();
  }

