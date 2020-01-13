<?php session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Linksazos!</title>
    <meta name="author" content="Subidazas!">
    <meta name="description" content="Sección de enlaces">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/7oucgc5e4lwbnq7p2ebbp3f9eb9wgqmluaxxoc86wzxyey79/tinymce/5/tinymce.min.js" referrerpolicy="origin" />
    </script>
    <link rel="icon" type="image/x-icon" href="" />
</head>

<body class="text-center">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Subidazas!</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['loggedin'])) {
    $currentUser = $_SESSION['name'];
    echo"<a class='nav-link' href='logout.php'>"."(".$currentUser.") "."Cerrar Sesión</a>";
} else {
    echo "<a class='nav-link' href='login.php'>Iniciar Sesión</a>";
}
                            ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.subidazas.com">A Subidazas!</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>