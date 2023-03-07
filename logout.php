<?php

    session_start();

    session_unset();//quitar sesion

    session_destroy();

    header('Location: /ProyectoClub');
?>