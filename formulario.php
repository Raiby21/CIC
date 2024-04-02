<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar Cita</title>
    <link rel="stylesheet" href="servidores/estilos/estilos.css" type="text/css">
</head>
<body>
    <div class="form">
        <h2>Reservar Cita</h2>
        <p>Por favor, complete los siguientes campos para reservar su cita:</p>
        <form action="reservar.php" method="post">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Cédula</label>
                <input type="text" name="cedula" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Hora</label>
                <input type="time" name="hora" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Método de Pago</label>
                <select name="pago" class="form-control" required>
                    <option value="tarjeta">Tarjeta de Crédito</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Reservar">
            </div>
        </form>
    </div>    
</body>
</html>
