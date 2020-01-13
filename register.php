<?php require_once('header.php');?>
<div class="container registro d-flex justify-content-center">
    <div class="align-self-center">
        <form action="do-register.php" method="post" class="form-signin">
            <img class="mb-4" src="img/fotaza.jfif">
            <h1 class="mb-3">¡Regístrate!</h1>
            <input name="email" id="email" type="email" class="form-control" placeholder="E-Mail" required="">
            <input name="user" id="user" type="text" class="form-control" placeholder="Usuario" required="">
            <input name="password" id="password" type="password" class="form-control" placeholder="Contraseña" required="">
            <button type="submit" class="mt-3 btn btn-large btn-primary btn-block">Registrar</button>
            <label class="mt-2">¿Ya tienes una cuenta? <a href="login.php">¡Inicia Sesión!</a></label>
        </form>
    </div>
</div>
<?php require_once('footer.php');?>