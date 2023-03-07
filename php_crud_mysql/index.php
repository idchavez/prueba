<?php include("db.php") ?>

<?php include("includes/header.php") ?>
    
<div class="container p-4">

    <div class="row">
        
        <div class="col-md-4">
            <!--comprobando si existe-->
            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION["message_type"]?>
                 alert-dismissible fade show" role="alert">
                <!--mostrar-->
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!--limpia los datos en sesion(borra el text alert)-->
            <?php session_unset(); } ?>
            <!--Tarjeta de bootstrap-->
            <div class="card card-body">
                <!--a traves de POST envia los datos del form a save.php-->
                <form action="save.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Deporte" >
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control" placeholder="Horario"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save" value="Send">
                </form>
            </div>
        </div>

        <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Deporte</th>
                            <th>Horario</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM deportes";
                        $result_tasks = mysqli_query($conn, $query);
                        //obtiene una a una las tareas en bd y las muestra por filas
                        while($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <!--Columnas bd-->
                            <td><?php echo $row['deporte'] ?></td>
                            <td><?php echo $row['horario'] ?></td>
                            <td>
                                <!--reedirecionar + id de la tarea a editar
                                ? significa una consulta
                                -->
                                <a href="edit.php?id=<?php echo $row['id_deporte']?>" class="btn btn-secondary">
                                   <i class="fas fa-marker"></i> 
                                </a>
                                <a href="delete.php?id=<?php echo $row['id_deporte']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    
    </div>

</div>

<?php include("includes/footer.php") ?>