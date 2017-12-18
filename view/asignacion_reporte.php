<!DOCTYPE html>
<?php
require_once '../model/Desarrollador.php';
require_once '../model/Proyectos.php';
require_once '../model/AsignacionDet.php';
require_once '../model/CrudModel.php';
require_once '../model/AsignacionModel.php';
session_start();
$asignacionCab = $_SESSION['asignacionCab'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema Gestor de Proyectos - Asignacion</title>
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
                <h3>Factura</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">INICIO</a>
                <a class="btn btn-success" href="javascript:window.print()">Imprimir</a>
            </div>
            <p>
            <table>
                <tr>
                    <td>Código proyecto:</td>
                    <td><?php echo $asignacionCab->getCod_proyecto(); ?></td>
                </tr>
                <tr>
                    <td>Proyecto:</td>
                    <td><?php echo $asignacionCab->getProyectoCab(); ?></td>
                </tr>
                <tr>
                    <td>Fecha inicio proyecto:</td>
                    <td><?php echo $asignacionCab->getFechaInicio(); ?></td>
                </tr>
                <tr>
                    <td>Fecha fin proyecto:</td>
                    <td><?php echo $asignacionCab->getFechaFin(); ?></td>
                </tr>
            </table>

        </p>
        <table data-toggle="table">
            <thead>
                <tr>
                    <th>Cédula Desarrollador</th>
                    <th>Nombres Desarrollador</th>
                    <th>Email</th>
                    <th>Código Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
//verificamos si existe en sesion el listado de DESARROLLADORES:
                if (isset($_SESSION['listaAsignacionDet'])) {
                    $listaAsignacionDet = unserialize($_SESSION['listaAsignacionDet']);
                    foreach ($listaAsignacionDet as $desa) {
                        echo "<tr>";
                        echo "<td>" . $desa->getCedula_Des() . "</td>";
                        echo "<td>" . $desa->getNombres_Des() . "</td>";
                        echo "<td>" . $desa->getEmailDet() . "</td>";
                        echo "<td>" . $desa->getCodCategoriaDet() . "</td>";
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
