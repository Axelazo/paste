<?php require_once('header.php');?>
<div class="container registro d-flex justify-content-center">
    <div class="align-self-center">
        <?php 
//Incluir los datos de la conexión
include 'conn.php';

//Conectar a la base de datos con los datos de la conexió
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//Si la conexión falla
if(!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}
//Variable con sentencia para consultar email a la base de datos
$checkEmail = "SELECT * FROM users WHERE email = '$_POST[email]' ";
$checkUser = "SELECT * FROM users WHERE user = '$_POST[user]' ";
//Variable $result contiene la consulta de la sentencia
$emailResult = mysqli_query($conn, $checkEmail);
$userResult = mysqli_query($conn, $checkUser);
//Variable $count con el resultado de la consulta 
$emailCount = mysqli_num_rows($emailResult);
$userCount =  mysqli_num_rows($userResult);

//Si el correo ya existe se mostrará una alerta
if($emailCount == 1) {
    //Alerta correo ya existente
    
    echo "<a class='btn btn-large btn-success btn-bloc md-5' href='register.php'>Ir atrás</a><div class='alert alert-danger' role='alert'>
    ¡El email ya existe en la base de datos, por favor <a href='login.php'>Inicia Sesión!</a>
    </div>
    
    ";
    
}
        
//Si el correo ni el usuario existe
else {
    $email = $_POST['email'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (email, user, password, level, premium) VALUES ('$email', '$user', '$passHash', 3, 0)";
    
    if(mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success' role='alert'>
        ¡Tu cuenta ha sido creada con éxito, ahora puedes <a href='login.php'>Iniciar Sesión!</a>
        </div>
        ";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        ¡Error ".$query."!
        <br>".mysqli_error($conn)."
        </div>
        ";
    }
}
        
mysqli_close($conn);
?>
    </div>
</div>
<?php require_once('header.php');?>