<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$query_lista = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="col-md-12 col-sm-12 col-xs-12">

        <table id="tabla_principal" class="table table-principal">
            <thead class="table-header">
                <tr>
                    <th>Check</th>
                    <th>Subcheck</th>
                    <th>Categoria / Subcategoria</th>
                    <th>ACME</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="table-body " id="table_principal_body">
                <?php /* $consulta = $catalogo->obtenerLista($query_lista);
                //echo $query_lista;
                while ($row = mysqli_fetch_array($consulta)) { */
                ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                <?php

           /*      } */

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>