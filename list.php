<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>
<div class="row" style="margin:25px">
    <div class="col-lg-9">
        <div class="card dashboard-shadow">
        <form class="search">
                <div class="row" style>
                    <div class="col-11">
                        <input type="text" class="form-control" placeholder="Buscar pastes...">
                    </div>
                    <div class="col-1">
                        <button class="btn btn-larg btn-block btn-success">Buscar</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive text-left">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Visitas</th>
                            <th scope="col" class="text-center">Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'conn.php';
                            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            
                            if(!$conn) {
                                die("Conexión fallida: ". mysqli_connect_error());
                            }
                            $limit = 10;  
                        
                            $query = "SELECT * FROM pastes ORDER BY id DESC LIMIT $limit";
                            
                            $result = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <th scope='row'>$row[id]</th>
                                            <td>$row[title]</td>
                                            <td>$row[views]</td>
                                            <td class='text-center'><a href='view.php?viewID=$row[viewID]' target='_blank' class='btn btn-secondary mr-2'>Ver Paste</a>
                                            <a class='btn btn-warning mr-2'>Editar Paste</a>
                                            <a class='btn btn-danger mr-2'>Eliminar</a></td>
                                            </tr>";
                                }           
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="alert alert-info fade show" role="alert">
            La búsqueda funciona por medio de los <strong>NOMBRES!</strong> de los pastes no por su contenido!
        </div>
    </div>
</div>