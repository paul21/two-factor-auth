<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jumbotron-narrow.css'); ?>" rel="stylesheet">

	<title>Two-Factor Auth - Login Log</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li><a href="<?php echo base_url('index.php/home/'); ?>">Home</a></li>
				<li class="active"><a href="#">Logs</a></li>
				<li><a href="<?php echo base_url('index.php/login/out/'); ?>">Logout</a></li>
			</ul>
			<h3 class="text-muted">Two-Factor Auth</h3>
		</div>
		Login Log: <pre><ul>
		<?php 
		foreach ($log as $entry)
		{
			echo '<li>'.$entry->Timestamp.'   '.$entry->IPAddress.'   ';
		
			switch ($entry->Status) {
				case 0:
					echo 'Fallo';
					break;
				case 1:
					echo 'Fase 1';
					break;
				case 2:
					echo 'Fase 2';
					break;
				default:
					echo 'Desconocido';
					break;
			}
			echo '</li>';
		} ?>
		</ul></pre>
		<div class="footer">
			<p>Pablo Valentini</p>
		</div>
	</div>
</body>
</html>
