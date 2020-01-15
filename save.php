<?php

	include 'conn.php';
//Conectar a la base de datos con los datos de la conexión
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$title=$_POST['title'];
	$content=$_POST['content'];

	function randomViewIDgenerator($length) {
		$key = "";

		$pool = array_merge(range(0,9), range('j', 'z'),range('J', 'Z'));
	
		for($i=0; $i < $length; $i++) {
			$key .= $pool[mt_rand(0, count($pool) - 1)];
		}
		$id = $key;

		$query = "SELECT * FROM pastes WHERE viewID = '$id'";

		global $conn;
		$result = mysqli_query($conn, $query);
                            
		if (mysqli_num_rows($result) > 0) {
			return randomViewIDgenerator($length);
		} else {
			return $id;
		}
	}

	$viewID = randomViewIDgenerator(6);

	$sql = "INSERT INTO pastes (viewID, title, content, views, reported) VALUES ('$viewID','$title', '$content', 0, 0)";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200,"viewId"=>$viewID));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>