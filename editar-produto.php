<?php
    
    session_start();

    //adicionando novas informações, caso existam
    if ($_POST) {
        
        $id = $_POST["id"];
        $produto = $_POST;

        //ajustando categoria
        if ($produto["categoria"] == "Outra...") {
            $produto["categoria"] = $produto["categoria_outra"];
        }
        unset($produto["categoria_outra"]);

        //altera informações que mudaram nos campos diferentes de foto
        foreach ($_SESSION["cadastros"][$id] as $chave=>$valor) {
            if ($chave!="foto") {
                if ($valor != $produto[$chave]) { //se valores diferentes, temos que atualizar
                    $_SESSION["cadastros"][$id][$chave] = $produto[$chave];
                }
            }
        }

        //atualiza a foto
        if ($_FILES) {
            //dados da imagem
            $endTemporario = $_FILES["foto"]["tmp_name"];
            $endImagem = "img/".$_FILES["foto"]["name"];
            //se conseguir salvar o arquivo, altera informações do caminho da foto e deleta foto antiga
            if (move_uploaded_file($endTemporario, $endImagem)) {
                unlink($_SESSION["cadastros"][$id]["foto"]);
                $_SESSION["cadastros"][$id]["foto"] = $endImagem;
            }
        }

    }

    header("Location: index.php");

?>