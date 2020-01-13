<?php require_once('header.php');?>
<div class="container registro d-flex justify-content-center">
    <div class="align-self-center">
        <form action="do-login.php" method="post" class="form-signin">
            <img class="mb-4" src="img/fotaza.jfif">
            <h1 class="mb-3">¡Inicia Sesión!</h1>
            <input name="user" id="user" type="text" class="form-control" placeholder="Usuario" required="">
            <input name="password" id="password" type="password" class="form-control" placeholder="Contraseña" required="">
            <button type="submit" class="mt-3 btn btn-large btn-primary btn-block">¡Iniciar Sesión</button>
            <label class="mt-2">¿No tienes una cuenta? <a href="register.php">¡Regístrate!</a></label>
        </form>
    </div>
</div>
<?php require_once('footer.php');?>