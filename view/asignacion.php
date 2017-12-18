<!DOCTYPE html>

<?php
include_once '../model/CrudModel.php';
include_once '../model/Categoria.php';
include_once '../model/Database.php';
include_once '../model/Desarrollador.php';
include_once '../model/Proyectos.php';
include_once '../model/AsignacionModel.php';

session_start();

$crudModel = new CrudModel();
$asignacionModel = new AsignacionModel();
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>ASIGNACION</title>
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
                <h3>ASIGNACION</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>

            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="guardar_asignacion">
                <table>
                    <tr>
                        <td>Proyecto:</td>
                        <td> 
                            <select name="proyectoAsigna">
                                <?php
                                $listaProyec = $crudModel->getProyectos();
                                foreach ($listaProyec as $cat) {
                                    echo "<option value='" . $cat->getCodProyecto() . "'>" . $cat->getProyecto() . "</option>";
                                }
                                ?>  
                            </select>                           
                        </td>
                        <td>Fecha inicio:</td>
                        <td>
                            <input type="date" name="fechaInicio"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                        <td >
                            <input type="submit" value="Crear Asignacion">                    
                        </td>
                    </tr>
                    <tr>
                        <td>Jefe proyecto:</td>
                        <td> 
                            <select name="jefeProyecto">
                                <?php
                                $listaJefes = $crudModel->getCategoriaExperto('E004');
                                foreach ($listaJefes as $cat) {
                                    echo "<option value='" . $cat->getCedulaDes() . "'>" . $cat->getNombresDes() . "</option>";
                                }
                                ?>
                            </select>                             
                        </td>
                        <td>Fecha fin:</td>
                        <td>
                            <input type="date" name="fechaFin"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                </table>
            </form>
        </p>
        <p>
        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="adicionar_desarrollador">
            <table>
                <tr>
                    <td>Desarrollador:</td>
                    <td> 
                        <select name="cedulaDesarrolladorAdicionar">
                            <?php
                            $lista = $crudModel->getDesarrolladores();
                            foreach ($lista as $cat) {
                                echo "<option value='" . $cat->getCedulaDes() . "'>" . $cat->getNombresDes() . "</option>";
                            }
                            ?>
                        </select>                           
                    </td>

                    <td>
                        <input type="submit" value="Adicionar Desarrollador">                            
                    </td>
                </tr>
            </table>
        </form>
    </p>


    <table data-toggle="table">
        <thead>
            <tr>
                <th>CEDULA DESARROLLADOR</th>
                <th>NOMBRES DESARROLLADOR</th>
                <th>EMAIL</th>
                <th>CODIGO CATEGORÍA</th> 
                <th>ELIMINAR</th>
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
                    echo "<td><a href='../controller/controller.php?opcion=eliminar_detalle&cedulaDesarrollador=" . $desa->getCedula_Des() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
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