<?php
require_once '../model/AsignacionCab.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SisGesPro - lista de asignaciones</title>
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
                <h3>Lista de asignaciones</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>


            <table data-toggle="table" data-pagination="true">
                <thead>
                    <tr>
                        <th>CÓDIGO PROYECTO</th>
                        <th>JEFE PROYECTO</th>
                        <th>FECHA INICIO PROYECTO</th>
                        <th>FECHA FIN PROYECTO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //verificamos si existe en sesion el listado de asignaciones:
                    if (isset($_SESSION['listaAsignaciones'])) {
                        
                        $listado = unserialize($_SESSION['listaAsignaciones']);
                        foreach ($listado as $asignacion) {
                            echo "<tr>";
                            echo "<td>" . $asignacion->getCod_proyecto()  . "</td>";
                            echo "<td>" . $asignacion->getCedula_Jefe() . "</td>";
                            echo "<td>" . $asignacion->getFechaInicio() . "</td>";
                            echo "<td>" . $asignacion->getFechaFin() . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No se han cargado datos.";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
