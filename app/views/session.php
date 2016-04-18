<?php
/**
 * Funcion Nueva
 */
session_start();
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Formulario de validación de usuario</title>
</head>
<body>
<form action=".php" method="POST">
  <fieldset>
    <p>
        <label for="username">Usuario</label>
        <input id="username" type="text" name="username" size="18" />
    </p>
    <p>
        <label for="passwd">Contraseña</label>
        <input id="passwd" type="password" name="password" size="18"  />
    </p>
    <p>
        <label for="remember">Recuérdame</label>
        <input id="remember" type="checkbox" name="remember" value="yes"/>
    <input type="submit" name="Submit" class="button" value="Identificarse" />
    </p>
  </fieldset>
</form>
</body>
</html>