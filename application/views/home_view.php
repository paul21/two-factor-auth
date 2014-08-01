<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jumbotron-narrow.css'); ?>" rel="stylesheet">

	<title>Two-Factor Auth Home</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="<?php echo base_url('index.php/home/logs/'); ?>">Logs</a></li>
				<li><a href="<?php echo base_url('index.php/login/out'); ?>">Logout</a></li>
			</ul>
			<h3 class="text-muted">Two-Factor Auth</h3>
		</div>
		Mis datos:
		<pre>
		<p><?php echo 'Nombre: '.$usuario[0]->Nombre.'<br/>WhatsApp: +'.$usuario[0]->Telefono; ?></p>
		<ul>
        <p>Tecnologías OSS utilizadas:</p>

		<li>Frameworks:</li> 

		CodeIgniter <a href="http://ellislab.com/codeigniter/">http://ellislab.com/codeigniter/</a>
		Licencia: OSL v.3

		Bootstrap <a href="http://getbootstrap.com/">http://getbootstrap.com/</a>
		Licencia: MIT

		<li>API's:</li>

		reCAPTCHA <a href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a>

		<li>Librerías:</li>

		WhatsAPI <a href="https://github.com/venomous0x/WhatsAPI">https://github.com/venomous0x/WhatsAPI</a>
		Licencia: MIT

		HOTP <a href="https://github.com/Jakobo/hotp-php">https://github.com/Jakobo/hotp-php</a>
		Licencia: BSD

		reCAPTCHA PHP Lib <a href="https://code.google.com/p/recaptcha">https://code.google.com/p/recaptcha
		/downloads/list?q=label:phplib-Latest</a>
		</pre>
	
		<div class="footer">
			<p>Pablo Valentini</p>
		</div>
	</div>
</body>
<html>