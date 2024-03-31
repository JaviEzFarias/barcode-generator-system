<?php
// Verificar si se recibió el ID del producto
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    $conexion = mysqli_connect('localhost', 'root', '', 'barcode');

    // Obtener los datos del producto
    $sql = "SELECT * FROM tabla WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $codigo = $fila['codigo'];
        $nombre = $fila['nombre'];
    } else {
        echo "No se encontró el producto con el ID proporcionado.";
        exit;
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    echo "No se recibió el ID del producto.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta individual</title>
</head>
<body>
    <div style="display: flex; justify-content: center;">
        <svg id="barcode"></svg>
    </div>

    <!-- JavaScript -->
    <script src="../js/JsBarcode.all.min.js"></script>
    <script>
        // Generar código de barras
        JsBarcode("#barcode", "<?php echo $codigo; ?>", {
            format: "CODE128",
            lineColor: "#000",
            width: 2,
            height: 30,
            displayValue: true
        });

        // Imprimir la página automáticamente al cargar
        window.print();
    </script>
</body>
</html>
