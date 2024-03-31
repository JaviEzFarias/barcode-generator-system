<?php
// Verificar si se ha enviado la solicitud de borrado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Conectar a la base de datos
    $conexion = mysqli_connect('localhost', 'root', '', 'barcode');

    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Prevenir inyección SQL
    $id = mysqli_real_escape_string($conexion, $id);

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM tabla WHERE id='$id'";
    if (mysqli_query($conexion, $sql)) {
        // Redirigir de nuevo a la página principal
        header("Location: index.php");
        exit();
    } else {
        echo "Error al borrar el producto: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "No se ha proporcionado un ID de producto para borrar.";
}
?>
