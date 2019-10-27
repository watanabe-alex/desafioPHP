<?php

    session_start();

    if ($_POST) {
        //exclui o id enviado via POST da sessão
        var_dump($_POST["id"]);
        unset($_SESSION["cadastros"][$_POST["id"]]);
    }

    header("Location: index.php");

?>