<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Editar producto</title>
</head>
<body>
    <div class="container is-fluid">
        <br>
        <div class="col-xs-12">
            <h1>Editar producto</h1>
            <br>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $conexion=mysqli_connect('localhost','root','','barcode');
                $sql="SELECT * FROM tabla WHERE id = $id";
                $resultado=mysqli_query($conexion,$sql);
                $fila=mysqli_fetch_assoc($resultado);
            ?>
            <form action="guardar_edicion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre'] ?>">
                </div>
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $fila['codigo'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
            <?php } else { ?>
            <p>No se encontró el producto.</p>
            <?php } ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
