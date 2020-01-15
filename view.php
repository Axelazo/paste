<?php require_once('header.php');?>
<main>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-12 align-self-center">
            <div class="card dashboard-shadow">
                <?php
                            
                            include 'conn.php';
                            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            
                            if(!$conn) {
                                die("Conexión fallida: ". mysqli_connect_error());
                            }
                
                            $viewID = $_GET['viewID'];
                            
                            $query = "SELECT * FROM pastes WHERE viewID = '$viewID'";
                            
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $title = $row['title'];
                                $content = $row['content'];
                                $views = $row['views'];
                                $views++;
                                $query = "UPDATE pastes SET views = views+1 WHERE pastes.viewID = '$viewID'";
                                mysqli_query($conn, $query);

                                echo "<div class='card-header text-left'>$title</div>
                                <div class='card-body view-body'>$content</div>
                                <div class='card-footer'>
                                    Visitas:$views<a class='btn btn-danger mr-2 float-right'>Reportar</a>
                                </div>";
                            } else {
                                echo"<div class='alert alert-primary' role='alert' style='margin:0'>
                                    El id: <strong>$viewID</strong> no existe!
                                </div>";
                            }

                
                            mysqli_close($conn);
                            ?>
            </div>
        </div>
    </div>
</main>
<?php require_once('footer.php');?>