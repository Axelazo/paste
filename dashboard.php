<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<main class="container-fluid dashboard">
    <div class="row no-gutters" style="height:100%">
        <div class="col-lg-2 dashboard-sidebar text-left">
            <ul class="nav flex-column dashboard-sidebar-menu">
                <li class="nav-item">
                    <a id="stats" class="nav-link active" href="#dashboard"><i class="material-icons">dashboard</i><span class="nav-text">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a id="new" class="nav-link" href="#new"><i class="material-icons">note_add</i><span class="nav-text">Nuevo paste</span></a>
                </li>
                <li class="nav-item">
                    <a id="list" class="nav-link" href="#list"><i class="material-icons">view_list</i><span class="nav-text">Ver pastes</span></a>
                </li>
                <div class="separator">s</div>
                <li class="nav-item">
                    <a id="reported" class="nav-link" href="#reported"><i class="material-icons">error</i><span class="nav-text">Reportados</span></a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10" style="height: 100%; overflow-y: scroll;">
            <div id="content">
            </div>
        </div>
    </div>
</main>
<script type="text/javascript" src="js\jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js\popper.min.js"></script>
<script type="text/javascript" src="js\bootstrap.min.js"></script>
<script type="text/javascript" src="js\summernote.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>