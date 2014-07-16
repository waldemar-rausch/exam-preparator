<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="de">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<section class="login">
			<div class="titulo">
				Bitte einloggen
			</div>
			<form action="/check.php" id="examTest" method="post" enctype="application/x-www-form-urlencoded">
		    	<input type="text" name="nickName" placeholder="Benutzername" data-icon="U">
		        <input type="password" name="password" placeholder="Passwort" data-icon="x">
                <input type="submit" value="anmelden" class="enviar">
		    </form>
</section>
	</body>
</html>