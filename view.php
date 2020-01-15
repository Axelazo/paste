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
                            
                            $row = mysqli_fetch_assoc($result);
                
                            $title = $row['title'];
                            $content = $row['content'];
                            $views = $row['views'];
                            $views++;
                            $query = "UPDATE pastes SET views = views+1 WHERE pastes.viewID = '$viewID'";
                            mysqli_query($conn, $query);
                
                            mysqli_close($conn);
                            ?>
                <div class="card-header text-left"><?php echo $title;?>
                </div>
                <div class="card-body view-body"><?php echo $content;?>
                </div>
                <div class="card-footer">
                    Visitas: <?php echo $views;?><a class='btn btn-danger mr-2 float-right'>Reportar</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once('footer.php');?>