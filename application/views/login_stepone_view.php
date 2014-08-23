<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jumbotron-narrow.css'); ?>" rel="stylesheet">

	<script type="text/javascript">
		var RecaptchaOptions = {
		theme : 'clean',
		lang : 'es'
		};
 	</script>

	<title>Two-Factor Auth Step 1</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="#">Home</a></li>
			</ul>
			<h3 class="text-muted">Two-Factor Auth</h3>
		</div>

		<div class="jumbotron">
			<h1>Bienvenido</h1>
			<p class="lead">Para utilizar esta aplicación debe iniciar sesión</p>

			<?php
			echo form_open('/login/stepone/');

			$user_params = array(
				'name'        => 'user',
				'class'	      => 'form-control',
				'maxlength'   => '80',
				'placeholder' => 'Usuario',
				);

			$pass_params = array(
				'name'        => 'pass',
				'class'	      => 'form-control',
				'type'        => 'password',
				'maxlength'   => '80',
				'placeholder' => 'Contraseña',
				);

			echo form_input($user_params);
			echo '<br />';
			echo form_input($pass_params);
			echo '<br />';

			if(isset($captcha) && $captcha){
				require_once('application/libraries/recaptcha/recaptchalib.php');
 				require('application/config/captcha.php');
 				$use_ssl = TRUE;
 				echo '<div class="btn">'.recaptcha_get_html($publickey, null, $use_ssl).'</div>';
			}			

			echo form_submit('send', 'Login', 'class="btn btn-success"');
			echo form_close();

			/* Mostrar errores de validación */

			echo '<span style=color:orange>'.validation_errors().'</span>';
			echo '<br />';

			/* Mostrar otros errores y mensajes al usuario */

			if(isset($message))
			{
				echo '<span style=color:orange><p>'.$message.'</p></span>';
			}

			echo '<a href="'.base_url('index.php/registrar').'">Registrarse</a>';
			?>

		</div>

		<div class="footer">
			<p>Pablo Valentini</p>
		</div>
	</div>
</body>
</html>