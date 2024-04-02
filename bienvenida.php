<?php
// Inicializar la sesión
session_start();
 
// Cverifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: inicio.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Joy Barber - Reserva de Citas</title>
    <link rel="stylesheet" type="text/css" href="Estilos/estilo.css">
</head>
<body>
    <header>
        <h1>Bienvenido a Joy Barber</h1>
    </header>
    <div class="page-header">
        <h1>Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenid@ a nuestro sitio.</h1>
        
    </div>
    <p>
        <a href="cierre.php" class="btn btn-danger">Cierra la sesión</a>
    </p>
    <div>
    
    <section id="cortes">
        <h2>Elige tu corte</h2>
        <div class="imagen-corte">
            <a href="formulario.php"> 
                <img src="Imagenes/jersey.jpg" alt="Corte de pelo 1">
            </a>
            <p>Descripción del corte 1</p>
        </div>
        <div class="imagen-corte">
            <a href="formulario.php"> 
                <img src="Imagenes/7.jpg" alt="Corte de pelo 2">
            </a>
            <p>Descripción del corte 2</p>
        </div>
        <!-- Agrega más imágenes de cortes aquí con sus respectivos enlaces -->
    </section>

    <section id="calendario">
        <h2>Calendario de Disponibilidad</h2>
        <!-- Agrega aquí un calendario interactivo para mostrar disponibilidad -->
    </section>

    <footer>
        <p>&copy; 2023 Joy Barber</p>
    </footer>
</body>
</html>
