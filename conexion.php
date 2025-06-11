<?php
// Oculta errores en producción (pero es útil activarlos mientras desarrollas)
error_reporting(0);

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "conexion");
if (!$conexion) {
    exit("Error al intentar conectarse al servidor MySQL.");
}

// Sanitizar y obtener los datos POST
$nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($conexion, $_POST["nombre"]) : "";
$telefono = isset($_POST["telefono"]) ? mysqli_real_escape_string($conexion, $_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? mysqli_real_escape_string($conexion, $_POST["email"]) : "";
$esMayorDeEdad = isset($_POST["esMayorDeEdad"]) ? mysqli_real_escape_string($conexion, $_POST["esMayorDeEdad"]) : "";

// Validación: campo email obligatorio
if (empty($email)) {
    exit("Fallo en el registro: Debes introducir tu dirección de email.");
}

// Insertar en la base de datos
$consulta = "INSERT INTO usuarios (nombre, telefono, email, esMayorDeEdad) 
             VALUES ('$nombre', '$telefono', '$email', '$esMayorDeEdad')";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si se insertó
if ($resultado && mysqli_affected_rows($conexion) > 0) {
    echo "Su registro se ha completado. ¡Gracias!";
} else {
    echo "Error: Su registro no se ha podido completar.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
