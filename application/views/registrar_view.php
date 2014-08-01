<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jumbotron-narrow.css'); ?>" rel="stylesheet">

	<title>Two-Factor Login</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="<?php echo base_url('/index.php/login');?>">Home</a></li>
			</ul>
			<h3 class="text-muted">Two-Factor Login</h3>
		</div>

		<div class="jumbotron">
			<h1>Registrarse</h1>
			<p class="lead">Complete sus datos para registrarse en el sistema</p>

			<?php
			if($this->session->userdata('usuario'))
			{
				redirect(base_url('index.php/home/'));
			}
			else
			{
				echo form_open('/registrar/go/');

				$name_params = array(
					'name'        => 'name',
					'class'       => 'form-control',
					'maxlength'   => '80',
					'placeholder' => 'Nombre completo',
					'value'       => set_value('name'),
					);
				
				$user_params = array(
					'name'        => 'user',
					'id'          => 'user',
					'class'	      => 'form-control',
					'maxlength'   => '80',
					'placeholder' => 'Usuario',
					'value'       => set_value('user'),
					);

				$pass_params = array(
					'name'        => 'pass',
					'class'	      => 'form-control',
					'type'        => 'password',
					'maxlength'   => '80',
					'placeholder' => 'Contraseña',
					'value'       => set_value('pass'),
					);

				$passconf_params = array(
					'name'        => 'passconf',
					'class'	      => 'form-control',
					'type'        => 'password',
					'maxlength'   => '80',
					'placeholder' => 'Confirmar contraseña',
					);

				$phone_params = array(
					'name'        => 'phone',
					'class'	      => 'form-control',
					'maxlength'   => '80',
					'placeholder' => 'Numero WhatsApp (ej. 5492615123456)',
					'value'       => set_value('phone'),
					);

				echo form_input($name_params);
				echo '<br />';

				echo form_input($user_params);
				echo '<br />';

				echo form_input($pass_params);
				echo '<br />';

				echo form_input($passconf_params);
				echo '<br />';

				echo form_input($phone_params);
				echo '<br />';

				echo form_submit('send', 'Registrar', 'class = "btn btn-warning"');
				echo form_close();

				/* Mostrar errores de validacion */

				echo validation_errors();

				/* Mostrar otros errores y mensajes al usuario */

				if(isset($message))
				{
					echo '<p>'.$message.'</p>';
				}
			}
			?>
		</div>

		<div class="footer">
			<p>Pablo Valentini</p>
		</div>
	</div>
</body>
</html>