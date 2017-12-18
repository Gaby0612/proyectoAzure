<!DOCTYPE html>
<?php
include_once '../model/Proyectos.php';
session_start();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PROYECTOS</title>
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
                <h3>PROYECTOS</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>

            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="crear_proyecto">
                <table>
                    <tr>
                        <td>Código Proyecto:</td>
                        <td> 
                            <input type="text" name="codProyecto" maxlength="5" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Proyecto:</td>
                        <td>
                            <input type="text" name="proyecto" maxlength="100" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha Recepción:</td>
                        <td>
                            <input type="date" name="fechaRecepcion"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha Entrega:</td>
                        <td>
                            <input type="date" name="fechaEntrega"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Crear">                            
                        </td>

                    </tr>
                </table>

            </form>
        </p>

        <table data-toggle="table">
            <thead>
                <tr>
                    <th>CÓDIGO PROYECTO</th>
                    <th>PROYECTO</th>
                    <th>FECHA RECEPCIÓN</th>
                    <th>FECHA ENTREGA</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //verificamos si existe en sesion el listado de clientes:
                if (isset($_SESSION['listaProyectos'])) {
                    $listaProyectos = unserialize($_SESSION['listaProyectos']);
                    foreach ($listaProyectos as $pro) {
                        echo "<tr>";
                        echo "<td>" . $pro->getCodProyecto() . "</td>";
                        echo "<td>" . $pro->getProyecto() . "</td>";
                        echo "<td>" . $pro->getFechaRecepcion() . "</td>";
                        echo "<td>" . $pro->getFechaEntrega() . "</td>";
                        echo "<td><a href='../controller/controller.php?opcion=editar_proyecto&codProyecto=" . $pro->getCodProyecto() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                        echo "<td><a href='../controller/controller.php?opcion=eliminar_proyecto&codProyecto=" . $pro->getCodProyecto() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
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
