<?php

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /ProyectoClub/');
}

    require 'database.php';

    $message = '';

    if (!empty(isset($_POST["email"]) && !empty($_POST['pasword']))) {
        $sql = "INSERT INTO users (email,pasword) VALUES (:email, :pasword)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['pasword'], PASSWORD_BCRYPT);
        $stmt->bindParam(':pasword',$password);

        if ($stmt->execute()) {
            $message = 'Successfully created new user';
        }else {
            $message = 'Sorry there must have been an issue creating your password';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../ProyectoClub/assets/css/estilos.css">
</head>
<body>
    <?php require 'partials/header.php' ?>
    
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif ?>

    <div class="contenedor">

    <form action="signup.php" method="post">
    
    <div class="elemento">
        <label for="usuario">Usuario</label>
        <input type="text" placeholder="Ingresa tu email" name="email" required="true"/>
    </div>
    <div class="elemento">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Ingresa tu contraseña" name="pasword" required="true"/>
    </div>
    <div class="elemento">
        <!--<label for="password">Contraseña</label>-->
        <input type="password" placeholder="Confirma tu contraseña" name="confirm_password"/>
    </div>
    <div class="elemento">
        <input type="submit" value="Enviar">
    </div>
    <div class="elemento">
        <h4>¿Tienes una cuenta?</h4>
        <a href="login.php">Inicia sesion</a>
    </div>

    </form>
    </div>
    
</body>
</html>