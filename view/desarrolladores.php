<!DOCTYPE html>
<?php
session_start();
include_once '../model/Desarrollador.php';
include_once '../model/CrudModel.php';
include_once '../model/Categoria.php';

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>DESARROLLADORES</title>
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
                <h3>DESARROLLADORES</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>

            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="crear_desarrollador">
                <table>
                    <tr>
                        <td>Cédula:</td>
                        <td> 
                            <input type="text" name="cedulaDes" maxlength="10" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre y Apellido:</td>
                        <td>
                            <input type="text" name="nombresDes" maxlength="70" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha nacimiento:</td>
                        <td>
                            <input type="date" name="fechaNacimiento"  required="true" autocomplete="off" required="" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td>
                            <input type="text" name="telefono" maxlength="10"required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Direccion:</td>
                        <td>
                            <input type="text" name="direccion" maxlength="100" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" name="email" maxlength="50" required="true">
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
                                    echo "<option value='" . $cat->getCodCategoria() . "'>" . $cat->getCategoria() . "</option>";
                                }
                                ?>                                  
                            </select>
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
                    <th>CEDULA</th>
                    <th>NOMBRES</th>
                    <th>FECHA NACIMIENTO</th>
                    <th>TELEFONO</th>
                    <th>DIRECCION</th>
                    <th>EMAIL</th>
                    <th>CATEGORIA</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //verificamos si existe en sesion el listado de clientes:
                if (isset($_SESSION['listaDesarrollador'])) {
                    $listaDesarrollador = unserialize($_SESSION['listaDesarrollador']);
                    foreach ($listaDesarrollador as $desa) {
                        echo "<tr>";
                        echo "<td>" . $desa->getCedulaDes() . "</td>";
                        echo "<td>" . $desa->getNombresDes() . "</td>";
                        echo "<td>" . $desa->getFechaNacimiento() . "</td>";
                        echo "<td>" . $desa->getTelefono() . "</td>";
                        echo "<td>" . $desa->getDireccion() . "</td>";
                        echo "<td>" . $desa->getEmail() . "</td>";
                        echo "<td>" . $desa->getCodCategoria() . "</td>";
                        echo "<td><a href='../controller/controller.php?opcion=editar_desarrollador&cedulaDes=" . $desa->getCedulaDes() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                        echo "<td><a href='../controller/controller.php?opcion=eliminar_desarrollador&cedulaDes=" . $desa->getCedulaDes() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
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
