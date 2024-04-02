<?php
// Inicializar la sesión
session_start();
 
// Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: bienvenida.php");
  exit;
}
 
//Incluir archivo de la base de datos
require_once "servidores/bases_Datos/config.php";
 
// Definir variables e inicializar con valores vacíos
$username = $password = "";
$username_err = $password_err = "";
 
//Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Comprobar si el nombre de usuario está vacío
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Comprobar si la contraseña está vacía
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        // Preparar una declaración selec
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parámetro
            $param_username = $username;
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                // Guardar resultado
                mysqli_stmt_store_result($stmt);
                
                // Verifique si existe el nombre de usuario, si es así, verifique la contraseña
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Vincular variables de resultado
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // La contraseña es correcta, así que inicie una nueva sesión
                            session_start();
                            
                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirigir al usuario a la página de welcome
                            header("location: bienvenida.php");
                        } else{
                            // Mostrar un mensaje de error si la contraseña no es válida
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else{
                    // Mostrar un mensaje de error si el nombre de usuario no existe
                    $username_err = "No existe cuenta registrada con este usuario.";
                }
            } else{
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
        
        // Declaración de cierre
        mysqli_stmt_close($stmt);
    }
    
    // Cerrando conexión
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar</title>
    <link rel="stylesheet" href="servidores/estilos/estilos.css" type="text/css">
</head>
<body>
    <div class="form">
        <h2>Iniciar Sesión </h2>
        <p>Por favor, Ingrese sus usuario y contraseña </p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>¿No tienes una cuenta? <a href="registrarse.php">Regístrate ahora</a>.</p>
        </form>
    </div>    
</body>
</html>