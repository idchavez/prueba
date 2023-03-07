<?php

    include('db.php');

    //validamos si estamos recibiendo el id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM deportes WHERE id_deporte = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $title = $row['deporte'];
            $description = $row['horario'];
        }   
    }
    //Actualizando
    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = "UPDATE deportes set deporte = '$title', horario = '$description' WHERE id_deporte = $id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = 'Registro actualizado correctamente';
        $_SESSION['message_type'] = 'info';
        header("Location: index.php");
    }

?>
<?php include("includes/header.php")?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <!--Enviamos un id del registro que vamos a actualizar-->
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" value="<?php echo $title; ?>"
                        class="form-control" placeholder="Update Title">
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control"
                        placeholder="Update description"><?php echo $description;?></textarea>
                    </div>
                    <button class="btn btn-success" name="update">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php")?>