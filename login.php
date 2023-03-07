<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /ProyectoClub/');
    }

    require 'database.php';

    if (!EMPTY(isset($_POST['email']) && !empty($_POST['pasword']))) {
        $records = $conn->prepare('SELECT id, email, pasword FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['pasword'], $results['pasword'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /ProyectoClub/admi.php');
        } else {
            $message = 'Sorry, those credential dont match';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../ProyectoClub/assets/css/estilos.css">
</head>
<body>

<?php require 'partials/header.php' ?>
    
<?php if (!empty($message)) : ?> 
    <p><?= $message ?></p>
<?php endif;?>

    <div class="contenedor">
    <form action="login.php" method="post">
    
    <div class="elemento">
        <label for="usuario">Usuario</label>
        <input type="text" placeholder="Ingresa tu email" name="email" required="true"/>
    </div>
    <div class="elemento">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Ingresa tu contraseña" name="pasword" required="true"/>
    </div>
    <div class="elemento">
        <input type="submit" value="Iniciar sesión">
    </div>
    <div class="elemento">
        <h4>¿No tienes una cuenta?</h4>
        <a href="signup.php">Regístrate</a>
    </div>

    </form>
</div>

</body>
</html>