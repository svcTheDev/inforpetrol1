<?php
if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['mensaje']) && isset($_POST['recaptcha_response'])) {
	# code...
	// print_r($_POST);
	foreach ($_POST as $key => $value) {
		$_POST[$key]=addslashes($value);
	}

	require_once('recaptcha-php-1.11/recaptchalib.php');

	// Get a key from https://www.google.com/recaptcha/admin/create
	$publickey = "";
	$privatekey = "6LdvWEsUAAAAAG3BmR_-BP8g9yKgr2eaPrpRl45A";

	# the response from reCAPTCHA
	$resp = null;
	# the error code from reCAPTCHA, if any
	$error = null;

	require_once("config/fecha.php");
	$admin		= "gerencia@inforpetrol.com.co";
	#$admin		= "webmaster@inforpetrol.com.co";

	$name="";
	$email="";
	$msg ="";
	$error1 = false;
	$messageStack="";
	//require('config/funciones.php');
	//include("imge/securimage/securimage.php");
	//$img = new Securimage();
	//$valid = $img->check($_POST['code']);
	//      echo '('.$valid.')<br/>';
	//      echo '('.$_POST['code'].')<br/>';
	//      echo '('.$_SESSION['securimage_code_value'].')<br/>';
	//if($valid == true) {

	$response=null;
	if (isset($_POST['recaptcha_response'])) {
	    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdvWEsUAAAAALb4zvH-J2X6l5_6oG8YDubcOsKE&response=".$_POST['recaptcha_response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
	}
	//  var_dump($response);
	/*
	  $json = '{"foo-bar": 12345}';
	  $obj = json_decode($json);
	  print $response->{'success'}; // 12345
	*/
	$obj = json_decode($response);

	$bb1=0;
	if ($obj->{'success'} == true) {
		# was there a reCAPTCHA response?

	    $email = $_POST['email'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $name = $_POST['nombre'];
		    $msg = $_POST['mensaje'];
			$sub = 'De Contactenos '.$name;
			$ip	= getenv("REMOTE_ADDR");
			$d 	= dia_semana(date("w"))." ".date("d")." de ".mes_ano(date("F"))." de ".date("Y")."  Hora: ".date("h:i:s A");
			$headers = "";
			$headers .= "From: $name<$email>\r\n"; 
			$headers .= "X-Sender: $email\r\n"; 
			$headers .= "X-Priority: 3\r\n";
			$headers .= "Return-Path: $email\r\n";
			$headers .= "Reply-To: $email\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$mes = "<h3 style=\"color: #044b79; background-color: #dedede; padding: 10px;\">INFORPETROL <small style=\"color: #0a5903;\">S.A.</small></h3>Mensaje enviado desde la Pagina WEB - Contactenos<br/><br/>\r\n\r\n<strong>Mensaje:</strong><br/>\r\n<div style=\"background-color: #efefef; margin: 10px; padding: 10px; border-radius: 5px;\">$msg</div><br/>\r\nEnviado por: <strong>$name<br/>\r\nE-mail: $email</strong><br/><br/>\r\n\r\n<h6 style=\"color: #044b79; background-color: #dedede; padding: 10px;\">Enviado desde la ip: $ip<br/>\r\nFecha: $d</h6>";
		       	//    tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
		        //     tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
		   if (!mail($admin, $sub, $mes, $headers)) {
		        $error1 = true;
		        $messageStack="Error en env&iacute;o de email a: $admin";
		   }
		} else {
		        $error1 = true;
	         $messageStack="Error en la direcci&oacute;n de email";
		}

		if($error1) {
			echo '<br/>';
			echo '<p style="color: white;"><strong>Su mensaje No ha podido ser enviado!, '.$messageStack.'.</strong></p>';
		} else {
			echo '<br>';
				echo '<p style="color: white;"><strong>Su mensaje ha sido enviado exitosamente!, pronto nos pondremos en contacto con Usted.<br><br>';
				echo 'Muchas gracias por comunicarse con nosotros a trav&eacute;s de esta secci&oacute;n.</strong></p>';
		}

    } else {
            # set the error code so that we can display it
            $error = $obj->{'error-codes'};
    }
    echo "$error";

} else {
	echo "Error en datos!";
}
?>
