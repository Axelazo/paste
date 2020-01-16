<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>

<?php
    include 'conn.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            
    if(!$conn) {
        die("Conexión fallida: ". mysqli_connect_error());
    }
                        
    $query = "SELECT * FROM pastes";
                            
    $result = mysqli_query($conn, $query);
                            
    $count = mysqli_num_rows($result);

?>
<div class="row" style="margin:25px">
    <div class="col-lg-12">
        <div id="quote" class="alert alert-secondary alert-dismissible fade show" role="alert">
        </div>
    </div>
</div>
<div class="row" style="margin:25px">
    <div class="col-lg-4">
        <div class="card dashboard-total dashboard-shadow">
            <div class="card-header">CANTIDAD TOTAL</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <i class="material-icons dashboard-total-color" style="font-size: 65px">insert_drive_file</i>
                    </div>
                    <div class="col-lg-10">
                        <h6 class="card-title dashboard-total-color">ACTUALMENTE HAY:</h6>
                        <h2 class="card-text"><?php echo $count;?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card dashboard-reported dashboard-shadow">
            <div class="card-header">PASTES REPORTADOS</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <i class="material-icons dashboard-reported-color" style="font-size: 65px">error</i>
                    </div>
                    <div class="col-lg-10">
                        <h6 class="card-title dashboard-reported-color">ACTUALMENTE HAY:</h6>
                        <h2 class="card-text">0 pastes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card dashboard-warn dashboard-shadow">
            <div class="card-header">PASTES PENDIENTES</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <i class="material-icons dashboard-warn-color" style="font-size: 65px">warning</i>
                    </div>
                    <div class="col-lg-10">
                        <h6 class="card-title dashboard-warn-color">ACTUALMENTE HAY:</h6>
                        <h2 class="card-text">0 pastes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin:25px">
    <div class="col-lg-6">
        <div class="card dashboard-shadow">
            <div class="card-header">ÚLTIMOS PASTES</div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <?php
                            
                            include 'conn.php';
                            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            
                            if(!$conn) {
                                die("Conexión fallida: ". mysqli_connect_error());
                            }
                            
                            $query = "SELECT * FROM pastes ORDER BY id DESC LIMIT 10";
                            
                            $result = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <th scope='row'>$row[id]</th>
                                            <td>$row[title]</td>
                                            </tr>";
                                }           
                            } else {
                                echo "0 results";
                            }
/*                        
                            $query = "SELECT * FROM pastes ORDER BY views ASC LIMIT 5";
                            
                            $queryres = mysqli_query($conn, $query);
                            
                            $result = array();
                        
                            if(mysqli_num_rows($queryres) > 0) {
                                while($rows = mysqli_fetch_assoc($queryres)) {
                                    $title = $rows['title'];
                                    $views = $rows['views'];
                                }
                            }
                            */
                            mysqli_close($conn);
                            ?>
</tbody>
</table>
</div>
</div>
</div>
<div class="col-lg-6">
    <div class="card dashboard-shadow">
        <div class="card-header">PASTES MÁS VISITADOS</div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['#1', '#2', '#3', '#4', '#5', '#6'],
                datasets: [{
                    label: '# de visitas',
                    data: [200, 90, 30, 138, 256, 334],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</div>
</div>