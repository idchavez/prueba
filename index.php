<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, pasword FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcom</title>
    <link rel="stylesheet" href="../ProyectoClub/assets/css/estilos.css">
</head>
<body>
    
<?php require 'partials/header.php' ?>
    
<?php if(!empty($user)): ?>
<br>Bienvenido <?= $user['email'] ?>
<br>You are successfully logged in
<br>
<a href="logout.php">Cerrar sesion</a>
<?php else: ?>
    <h1>Bienvenido </h1>
    <a href="login.php">Iniciar sesión</a> o
    <a href="signup.php">Registrarse</a>
<?php endif;?>
</body>
</html>