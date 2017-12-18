<!DOCTYPE html>
<?php
include_once '../model/CrudModel.php';
include_once '../model/Desarrollador.php';
include_once '../model/Categoria.php';
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
        $Desarrollador = unserialize($_SESSION['Desarrollador']);
        //print_r($factura);
        ?>

        <div class="container">
            <img src="images/banner_gestor.jpg">
            <div class="row">
                <h3>DESARROLLADORES</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/desarrolladores.php">Regresar</a>
            </div>

            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="actualizar_desarrollador">
                <table>
                    <tr>
                        <td>Cédula:</td>
                        <td> 
                            <?php echo $Desarrollador->getCedulaDes(); ?>
                            <input type="hidden" name="cedulaDes" value="<?php echo $Desarrollador->getCedulaDes(); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre y Apellido:</td>
                        <td>
                            <input value="<?php echo $Desarrollador->getNombresDes(); ?>" type="text" name="nombresDes" maxlength="70" required="true">

                        </td>
                    </tr>
                    <tr>
                        <td>Fecha nacimiento:</td>
                        <td>
                            <input value="<?php echo $Desarrollador->getFechaNacimiento(); ?>" type="date" name="fechaNacimiento"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td>
                            <input value="<?php echo $Desarrollador->getTelefono(); ?>" type="text" name="telefono" maxlength="10"required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Direccion:</td>
                        <td>
                            <input value="<?php echo $Desarrollador->getDireccion(); ?>" type="text" name="direccion" maxlength="100" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input value="<?php echo $Desarrollador->getEmail(); ?>" type="text" name="email" maxlength="50" required="true">
                        </td>
                    </tr>   
                    <tr>
                        <td>Categoría:</td>
                        <td>
                            <select name="codCategoria">
                                <?php
                                $crudModel = new CrudModel();
                                $listaCategorias = $crudModel->getCategorias();
                                foreach ($listaCategorias as $cat) {
                                    if ($cat->getCodCategoria() == $Desarrollador->getCodCategoria())
                                        echo "<option selected=true value='" . $cat->getCodCategoria() . "'>" . $cat->getCategoria() . "</option>";
                                    else
                                        echo "<option value='" . $cat->getCodCategoria() . "'>" . $cat->getCategoria() . "</option>";
                                }
                                ?>                                  
                            </select>
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
