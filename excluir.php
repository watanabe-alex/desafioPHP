<?php

    session_start();

    if ($_POST) {
        //exclui o id enviado via POST da sessão
        //se conseguir deletar o arquivo, apaga o registro também
        if (unlink($_SESSION["cadastros"][$_POST["id"]]["foto"])) {
            unset($_SESSION["cadastros"][$_POST["id"]]);
        }
    }

    header("Location: index.php");

?>