<!-- TODO:
    - melhorar o cheque de informações para cadastro
    - revisar enunciado do exercício
 -->

<?php
    
    session_start();

    //adicionando novas informações, caso existam
    if ($_POST && $_FILES) {
        //dados da imagem
        $endTemporario = $_FILES["foto"]["tmp_name"];
        $endImagem = "img/".$_FILES["foto"]["name"];

        //se conseguir salvar o arquivo, adiciona informações em session
        if (move_uploaded_file($endTemporario, $endImagem)) {
            $produto = $_POST;
            $produto["foto"] = $endImagem;

            //ajustando categoria
            if ($produto["categoria"] == "Outra...") {
                $produto["categoria"] = $produto["categoria_outra"];
            }
            unset($produto["categoria_outra"]);

            //adiciona informações em session
            $_SESSION["cadastros"][] = $produto;

        }
    }

    //monta lista de categorias já cadastradas
    $categorias = [];
    if (isset($_SESSION["cadastros"])) { //se existe produtos cadatrados, pega as categorias
        foreach($_SESSION["cadastros"] as $produto) {
            if (!in_array($produto["categoria"], $categorias)) {
                $categorias[] = $produto["categoria"];
            }
        }
    }
    $categorias[] = "Outra...";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <main class="container mt-5 d-flex justify-content-between">
        <!-- Tabela de produtos -->
        <section class="col-6">
            <h1>Todos os produtos</h1>
            <table class="table">
                <!-- nome das colunas -->
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    </tr>
                </thead>
                <!-- valores -->
                <tbody>
                    <?php if (isset($_SESSION["cadastros"])) {
                        foreach($_SESSION["cadastros"] as $chave=>$cadastro) { ?>
                            <tr>
                                <td><a href="pagina-individual.php?id=<?php echo $chave ?>"><?php echo $cadastro["nome"] ?></a></td>
                                <td><?php echo $cadastro["categoria"] ?></td>
                                <td><?php echo $cadastro["preco"] ?></td>
                            </tr>
                        <?php } 
                    }?>
                </tbody>

            </table>
        </section>

        <!-- Formulario para cadastrar produtos -->
        <form class="col-5 d-flex flex-column fundo-cinza" method="post" enctype="multipart/form-data" action="">
            <h2>Cadastrar produtos</h2>
            <div class="form-group">
                <label for="nome_id">Nome</label>
                <input type="text" name="nome" id="nome_id" class="form-control">
            </div>
            <div class="form-group">
                <label for="categoria_id" class="label-categoria">Categoria</label>
                <div class="row m-0">
                    <select name="categoria" class="col-6">
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value=<?php echo '"'.$categoria.'"' ?>><?php echo $categoria ?></option> 
                        <?php } ?>
                    </select>
                    <input type="text" name="categoria_outra" id="categoria_outra_id" class="form-control col-6" placeholder="Se outra, digite aqui...">
                </div>
            </div>
            <div class="form-group">
              <label for="descricao_id">Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao_id" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="quantidade_id">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade_id" class="form-control">
            </div>
            <div class="form-group">
                <label for="preco_id">Preço</label>
                <input type="number" name="preco" id="preco_id" class="form-control">
            </div>
            <div class="form-group">
              <label for="foto_id">Foto do produto</label>
              <input type="file" class="form-control-file" name="foto" id="foto_id">
            </div>
            <button type="submit" class="btn btn-primary align-self-end">Enviar</button>
        </form>
    
    </main>

</body>
</html>