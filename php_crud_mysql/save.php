<?php 
    
    include("db.php");
    
    //si existe a traves de POST un valor llamado save, means that trying to save
    if (isset($_POST['save'])) {
        //lo que reciba a traves de POST a traves del name'' guardarlo en $
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $query = "INSERT INTO deportes(deporte,horario) VALUES ('$title', '$description')";
        //almacenar datos recibidos
        //cadena de conexion, consulta
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed");
        }

        $_SESSION["message"] = 'Registro guardado';
        $_SESSION["message_type"] = 'success';

        header("Location: index.php");
    }

?>