<?php
    session_start();

    if(!$_SESSION['id']) {
        $_SESSION['nao_autenticado'] = true;
        $_SESSION['mensagem'] = "Você não tem permissão para acessar essa página.";

        $url = "Location: ./index.php";
        header($url);
        exit();
    }
?>