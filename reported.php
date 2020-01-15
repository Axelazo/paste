<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>
<div class="row" style="margin:25px">
    <div class="col-lg-9">
        <div class="card dashboard-shadow">
            <div class="table-responsive text-left">
                <table class="table">
                    <tbody>
                        <?php
                            include 'conn.php';
                            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            
                            if(!$conn) {
                                die("Conexión fallida: ". mysqli_connect_error());
                            }
                            $limit = 10;  
                        
                            $query = "SELECT * FROM pastes WHERE reported = 1 ORDER BY id";
                            
                            $result = mysqli_query($conn, $query);
                            
                            $count = 0;

                            if (mysqli_num_rows($result) > 0) {
                                echo "
                                <thead>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Título</th>
                                    <th scope='col'>Visitas</th>
                                    <th scope='col' class='text-center'>Modificar</th>
                                </tr>
                                </thead>
                                
                                ";
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td>
                                                <div class='alert alert-danger' role='alert'>
                                                    <strong><i class='material-icons' style='font-size:18px'>info</i> Reportado</strong>
                                                </div>
                                            </td>
                                            <th scope='row'>$row[id]</th>
                                            <td>$row[title]</td>
                                            <td>$row[views]</td>
                                            <td class='text-center'>
                                                <a href='view.php?viewID=$row[viewID]' target='_blank' class='btn btn-secondary mr-2'><i class='material-icons' style='font-size:18px'>remove_red_eye</i> Ver Paste</a>
                                                <a class='btn btn-warning mr-2'><i class='material-icons' style='font-size:18px'>edit</i> Editar Paste</a>
                                                <a class='btn btn-danger mr-2 deletePaste'><i class='material-icons' style='font-size:18px'>delete</i> Eliminar</a>
                                            </td>
                                        </tr>";
                                }           
                            } else {
                                echo "  <div class='alert alert-primary' role='alert'>
                                            No hay pastes creados!
                                        </div>";
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="deleteModalBody"class="modal-body">
                    ¿Estás seguro que deseas <strong>ELIMINAR</strong> el paste?<br>¡No hay vuelta atrás!
            </div>
            <div class="modal-footer">
                <button id="deletePaste" type="button" class="btn btn-danger" data-dismiss="modal">Borrar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var p_viewID;
    $(document).ready(function() {

        $(".deletePaste").click(function () {
            var splitID = $(this).parent().children([0]).attr("href");
            p_viewID = splitID.split('=',5)[1];
            console.log(p_viewID);
            $("#deleteModal").modal();
        });

    });

    $("#deletePaste").click(function(){
            console.log(p_viewID);
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {
                    viewID: p_viewID,
                },
                async: true,
                success: function(dataResult) {
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                    $("#deleteModal").modal("hide");
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $.ajax({
                        url: "list.php",
                        async: true,
                        }).done(function (data) { // data what is sent back by the php page
                        $("#content").html(data); // display data
                        });
                    } else if (dataResult.statusCode == 201) {
                    alert("error");
                    }
                }
            });
        });

</script>