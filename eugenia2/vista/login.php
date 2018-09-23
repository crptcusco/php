<?php
require_once '../config.php';
//echo RUTA.'template/header.php';
require_once RUTA . 'template/header.php';
?>
<div>
    <h1>Sistema de .....</h1>
</div>
<div class="row">
    <p class="ui-front">este es el mensaje de error</p>
    <form method="POST" action="../controlador/controlador_login.php">
        <input type="hidden" name="opcion" value="ingresar">
        <fieldset>
            <legend>Ingreso al Sistema</legend>
            <label>Usuario
                <input type="text" class="">
            </label>
            <label>Password
                <input type="password">
            </label>
            <input name="ingresar" type="submit" value="Ingresar" class="ui-button">
        </fieldset>
    </form>
</div>
<?php
require_once '../template/footer.php';
?>