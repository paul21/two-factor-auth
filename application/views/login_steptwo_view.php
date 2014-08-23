<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jumbotron-narrow.css'); ?>" rel="stylesheet">

	<title>Two-Factor Auth Step 2</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="<?php echo base_url('index.php/login/out'); ?>">Logout</a></li>
			</ul>
			<h3 class="text-muted">Two-Factor Auth</h3>
		</div>

		<div class="jumbotron">
			<h1>Bienvenido</h1>
			<p class="lead">Ingrese el codigo de verificacion</p>

			<?php
			echo form_open('/login/steptwo/');

			$code_params = array(
				'name'        => 'code',
				'class'	      => 'form-control',
				'maxlength'   => '6',
				'placeholder' => '',
				);

			echo form_input($code_params);
			echo '<br />';

			echo form_submit('send', 'Enviar', 'class = "btn btn-success"');
			echo form_close();

			/* Mostrar errores de validación */

			echo '<span style=color:orange>'.validation_errors().'</span>';

			/* Mostrar otros errores y mensajes al usuario */

			if(isset($message))
			{
				echo '<span style=color:orange><p>'.$message.'</p></span>';
			}
			?>
			
		</div>

		<div class="footer">
			<p>Pablo Valentini</p>
		</div>
	</div>
</body>
</html>