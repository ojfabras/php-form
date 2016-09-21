<?php

// Apaga el reporte de errores
error_reporting(0);

if ($_POST['enviar']) {

	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];
	$check = $_POST['check'];
	
	if (!$nombre) {
		$error = "<br/>- Por favor ingresa tu nombre";
	}
	if (!$correo) {
		$error .= "<br/>- Por favor ingresa tu correo electrónico";
	}
	if (!$mensaje) {
		$error .= "<br/>- Por favor ingresa un mensaje";
	}
	if (!$check) {
		$error .= "<br/>- Por favor confirma que eres humano";
	}

	if ($error) {
		$resultado = '<div class="alert alert-danger" role="alert"><strong>Oops!... Hubo un error</strong>. Por favor corrige lo siguiente: '.$error. '</div>';
	} else {

		// Envía correos desde localhost usando PHPMailer
    require 'util/PHPMailerAutoload.php';         
    $mail = new PHPMailer();

    $mail->isSMTP();                            // Establece el mailer para usar SMTP
    $mail->Host = 'smtp.gmail.com';             // Especifica el servidor SMTP
    $mail->SMTPAuth = true;                     // Habilita autenticación vía SMTP
    $mail->Username = 'ojfabras@gmail.com'; 		// Nombre de usuario SMTP
    $mail->Password = '';         // Contraseña de Gmail del Cliente SMTP
    $mail->SMTPSecure = 'tls';                  // Habilita encripción TLS/SSL

    // Asigna el encabezado del correo
    $mail->From = 'info@oscarfabra.com';
    $mail->FromName = 'Formulario de Contacto';
    $mail->addAddress('ojfabras@gmail.com');
    $mail->addAddress('ojfabras@outlook.com');
    $mail->addReplyTo($correo,$nombre);

 		// Asigna el asunto del correo
    $mail->isHTML(true);
    $subject = 'Mensaje de tu Formulario de Contacto';
    $mail->Subject = $subject;

    // Asigna el cuerpo del mensaje
    $body = "<p>Has recibido un nuevo mensaje de tu formulario de contacto.</p>
                <p><strong>Nombre: </strong> {$nombre} </p>
                <p><strong>Correo electrónico: </strong> {$correo} </p>
                <p><strong>Mensaje: </strong> {$mensaje} </p>";
    $mail->Body = $body;

    if(!$mail->Send()){
    	$resultado = '<div class="alert alert-danger" role="alert">El mensaje no pudo ser enviado por el servidor. Inténtalo de nuevo más tarde.</div>';
    } else {

    	$nombre = null;
			$correo = null;
			$mensaje = null;
			
    	$resultado = '<div class="alert alert-success" role="alert">Gracias, me comunicaré contigo pronto.</div>';
    }
	}
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Formulario de Contacto</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <section id="contact">
    	
    	<div class="container">
    	
    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">
    				
    				<h1>Formulario de Contacto</h1>
    				<?php echo $resultado; ?>
    				<p>Envía un mensaje a través de este formulario</p>

    				<form method="post" role="form">
    					
    					<div class="form-group">
    						<input type="text" name="nombre" class="form-control" placeholder="Tu nombre" value="<?php echo $nombre; ?>">
    					</div>

    					<div class="form-group">
    						<input type="email" name="correo" class="form-control" placeholder="Tu correo electrónico" value="<?php echo $correo; ?>">
    					</div>

    					<div class="form-group">
    						<textarea name="mensaje" rows="5" class="form-control" placeholder="Mensaje..."><?php echo $mensaje; ?></textarea>
    					</div>

    					<div class="checkbox">
    						<label>
    							<input type="checkbox" name="check"> Soy humano
    						</label>
    					</div>

    					<div align="center">
    						<input type="submit" name="enviar" class="btn btn-default" value="Enviar mensaje"/>
    					</div>

    				</form>


    			</div>
    			

    		</div>

    	</div>
    	
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>