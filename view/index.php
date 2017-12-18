<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema Gestor de Proyectos</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <img src="images/banner_gestor.jpg">
            <div class="row">
                <h3><strong>SISTEMA GESTOR DE PROYECTOS</strong></h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../controller/controller.php?opcion=listar_desarrollador">DESARROLLADORES</a>
                <a class="btn btn-success" href="../controller/controller.php?opcion=listar_proyectos">PROYECTOS</a>
                <a class="btn btn-success" href="../controller/controller.php?opcion=listar_asignaciones">LISTA DE ASIGNACIONES</a>
                <a class="btn btn-success" href="../controller/controller.php?opcion=nueva_asignacion">NUEVA ASIGNACION</a>
                <a class="btn btn-success" href="../phpdocs/index.html">PHP DOCS</a>
            </div>
        </div>
    </body>
</html>