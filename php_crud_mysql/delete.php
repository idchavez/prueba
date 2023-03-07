<?php

    include('db.php');

    //validamos si estamos recibiendo el id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM deportes WHERE id_deporte = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed");
        }

        $_SESSION['message'] = 'Registro eliminado';
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    }

?>