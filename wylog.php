<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['blad']);
    unset($_SESSION['id']);
    session_destroy();
    header('Location: index.php');
?>
