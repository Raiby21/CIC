<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barberia";

// Establecer la conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Definir variables e inicializar con valores vacíos
$nombre = $apellido = $cedula = $fecha = $hora = $pago = "";
$nombre_err = $apellido_err = $cedula_err = $fecha_err = $hora_err = $pago_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Resto de validación de datos (nombre, apellido, cédula, fecha, hora, pago)
    
    // ... (mantén tu código de validación actual para estas variables)

    // Si no hay errores de validación, puedes continuar con la inserción en la base de datos
    if (empty($nombre_err) && empty($apellido_err) && empty($cedula_err) && empty($fecha_err) && empty($hora_err) && empty($pago_err)) {
        // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla 'citas'
        $sql = "INSERT INTO citas (nombre, apellido, cedula, fecha, hora, pago) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $nombre, $apellido, $cedula, $fecha, $hora, $pago);
            
            // Establecer los valores de los parámetros
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $pago = $_POST["pago"];
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Los datos se han insertado correctamente, puedes redirigir al usuario a una página de confirmación o hacer lo que necesites aquí.
                header("location: confirmacion.php");
                exit();
            } else {
                echo "Error al insertar los datos en la base de datos.";
            }
            
            // Cerrar la declaración
            $stmt->close();
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
