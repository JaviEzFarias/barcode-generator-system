<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Lista de productos</title>
</head>
<body>
    <div class="container is-fluid">
        <br>
        <div class="col-xs-12">
            <h1>Lista de productos</h1>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cod">
                    <span class="glyphicon glyphicon-plus"></span> Agregar producto  <i class="fa fa-user-plus"></i>
                </button>
                <a href="print.php" class="btn btn-secondary">Imprimir todo</a>
            </div>
            <br>
            <input type="text" id="codigoBusqueda" placeholder="Buscar por código">
            <br><br>
            <table class="table table-striped" id="table_id">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $conexion=mysqli_connect('localhost','root','','barcode');
                        $sql="SELECT * FROM tabla";
                        $resultado=mysqli_query($conexion,$sql);
                        $codbarra=array();
                    ?>
                    <?php while($fila=mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?php echo $fila['nombre'] ?></td>
                            <td><svg id='<?php echo "barcode".$fila['codigo']; ?>'></svg></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-edit" data-id="<?php echo $fila['id'] ?>" data-nombre="<?php echo $fila['nombre'] ?>" data-codigo="<?php echo $fila['codigo'] ?>">Editar</button>
                                <button type="button" class="btn btn-danger btn-delete" data-id="<?php echo $fila['id'] ?>">Borrar</button>
                                <button type="button" class="btn btn-success btn-print-individual" data-id="<?php echo $fila['id'] ?>">Imprimir</button>
                            </td>
                        </tr>
                        <?php $codbarra[]=$fila['codigo']; ?>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function arrayjsonbarcode(j){
            json=JSON.parse(j);
            arr=[];
            for (var x in json) {
                arr.push(json[x]);
            }
            return arr;
        }

        jsonvalor='<?php echo json_encode($codbarra) ?>';
        valores=arrayjsonbarcode(jsonvalor);

        for (var i = 0; i < valores.length; i++) {
            JsBarcode("#barcode" + valores[i], valores[i].toString(), {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 30,
                displayValue: true
            });
        }

        // Agregar funcionalidad de búsqueda
        $(document).ready(function() {
            $('#codigoBusqueda').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#table_id tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Editar fila
            $(".btn-edit").click(function() {
                var id = $(this).data("id");
                var nombre = $(this).data("nombre");
                var codigo = $(this).data("codigo");
                window.location.href = "editar.php?id=" + id + "&nombre=" + nombre + "&codigo=" + codigo;
            });

            // Borrar fila
            $(".btn-delete").click(function() {
                var id = $(this).data("id");
                if (confirm("¿Estás seguro de que deseas borrar este producto?")) {
                    // Enviar solicitud de borrado a borrar.php
                    $.post("borrar.php", {id: id}, function(data) {
                        // Recargar la página después de borrar el producto
                        location.reload();
                    });
                }
            });

            // Imprimir etiqueta individual
            $(".btn-print-individual").click(function() {
                var id = $(this).data("id");
                window.location.href = "print_individual.php?id=" + id;
            });
        });
    </script>

    <?php include "form.php"?>
</body>
</html>
