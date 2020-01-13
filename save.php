<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>


<?php
	include 'conn.php';
//Conectar a la base de datos con los datos de la conexió
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$title=$_POST['title'];
	$content=$_POST['content'];

	$sql = "INSERT INTO pastes (title, content, views) VALUES ('$title', '$content', 0)";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>