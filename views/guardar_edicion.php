<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron los datos necesarios
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['codigo'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];

        // Conexión a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'barcode');

        // Consulta SQL para actualizar los datos
        $sql = "UPDATE tabla SET nombre='$nombre', codigo='$codigo' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error al guardar los cambios: " . mysqli_error($conexion);
        }

        // Cerrar conexión
        mysqli_close($conexion);
    } else {
        echo "No se recibieron los datos necesarios para guardar los cambios.";
    }
} else {
    echo "Acceso denegado.";
}
?>
