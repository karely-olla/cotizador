<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/main.css">
	<title>correo</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<div class="container c-cont">
		<div class="col-md-offset-4 col-md-4 form-mail">
			<h2>Buzon de quejas sugerencias y felicitaciones</h2>
			<form method="post" id="formMail">
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Tu Nombre" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="mail" placeholder="Direccionde Correo" required>
				</div>
				<div class="form-group">
					<label for="r1">
						Quejas
						<input type="radio" name="tipo" value="Quejas" id="r1">
					</label>
					<label for="r2">
						Sugerencias
						<input type="radio" name="tipo" value="Sugerencias" id="r2">
					</label>
					<label for="r3">
						Felicitaciones
						<input type="radio" name="tipo" value="Felicitaciones" id="r3">
					</label>
				</div>
				<div class="form-group">
					<textarea name="msj" id="msj" class="form-control" required placeholder="Mensaje"></textarea>
				</div>
				<div class="form-group">
				  <div class="g-recaptcha" data-sitekey="6LdeLyYUAAAAADBdIQw8Lj_WlcO8zGqWL44PnZqT"></div>
				</div>
					<h4 id="captacha" class="text-center text-danger"></h4>
				<input type="submit" class="btn btn-warning" value="Enviar">
			</form>
			<h4 id="datos" class="text-center text-success"></h4>
		</div>
	</div>


	<script src="../js/jquery-1.12.0.min.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>