<?php
include 'conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn) {
    die("Conexión fallida: ". mysqli_connect_error());
}

$query = "SELECT * FROM pastes ORDER BY views DESC LIMIT 6";
                            
$results = mysqli_query($conn, $query);

while($result = mysqli_fetch_assoc($results)) {
    $data[] = $result;
}

echo json_encode($data);

?>