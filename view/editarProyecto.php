<!DOCTYPE html>
<?php
include_once '../model/Proyectos.php';
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
        <?php
        $Proyectos = unserialize($_SESSION['Proyectos']);
        //print_r($factura);
        ?>

        <div class="container">
            <img src="images/banner_gestor.jpg">
            <div class="row">
                <h3>PROYECTOS</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/proyecto.php">Regresar</a>
            </div>

            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="actualizar_proyecto">
                <table>
                    <tr>
                        <td>Codigo Proyecto:</td>
                        <td> 
                            <?php echo $Proyectos->getCodProyecto(); ?>
                            <input type="hidden" name="codProyecto" value="<?php echo $Proyectos->getCodProyecto(); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Proyecto:</td>
                        <td>
                            <input value="<?php echo $Proyectos->getProyecto(); ?>" type="text" name="proyecto" maxlength="70" required="true">

                        </td>
                    </tr>
                    <tr>
                        <td>Fecha recepcion:</td>
                        <td>
                            <input value="<?php echo $Proyectos->getFechaRecepcion(); ?>" type="date" name="fechaRecepcion"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha entrega:</td>
                        <td>
                            <input value="<?php echo $Proyectos->getFechaEntrega(); ?>" type="date" name="fechaEntrega"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="ACTUALIZAR">                            
                        </td>

                    </tr>
                </table>

            </form>
        </p>
    </div>
</body>
</html>
