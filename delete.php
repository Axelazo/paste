<?php
include 'conn.php';
//Conectar a la base de datos con los datos de la conexión
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $viewID=$_POST['viewID'];
    
	$sql = "DELETE from pastes WHERE pastes.viewID = '$viewID'";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>