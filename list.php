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
        </div>
    </div>
    <div class="col-lg-3">
        <div class="alert alert-info fade show" role="alert">
            La búsqueda funciona por medio de los <strong>NOMBRES!</strong> de los pastes no por su contenido!
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card dashboard-shadow">
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
                                            <td class='text-center'><a href='view.php?id=$row[id]' target='_blank' class='btn btn-secondary mr-2'>Ver Paste</a><button type='button' class='btn btn-success mr-2' value='$row[id]'>Editar</button><button type='button' class='btn btn-danger'>Eliminar</button></td>
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
            <nav aria-label="Page navigation example float-right">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>