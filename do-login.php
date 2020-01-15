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
            die("Conexión fallida: ". mysqli_connect_error());
        }
        
        //Obtenemos el usuario y el password
        $user = $_POST['user'];
        $password = $_POST['password'];
        
        //Preparamos la consulta
        $query = "SELECT user, password, level, premium FROM users WHERE user = '$user' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        //Guardamos el hash en una variable
        $passwordHash = $row['password'];
        
if(password_verify($password, $passwordHash)) {
    $_SESSION['loggedin'] =true;
    $_SESSION['name'] = $row['user'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (1*60*60);
    echo "<meta http-equiv='refresh' content='0;url=dashboard.php'/>";
} else {
    echo "<div class='alert alert-danger' role='alert'>
    ¡Diantres, algo anda mal! <a href='login.php'>Prueba otra vez!</a>
    </div>";
}
        
mysqli_close($conn);
?>
    </div>
</div>
<?php require_once('header.php');?>