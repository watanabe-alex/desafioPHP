<?php

    session_start();

    //monta lista de categorias já cadastradas
    $categorias = [];
    foreach($_SESSION["cadastros"] as $produto) {
        if (!in_array($produto["categoria"], $categorias)) {
            $categorias[] = $produto["categoria"];
        }
    }
    $categorias[] = "Outra...";

    $id = $_POST["id"];
    $produto = $_SESSION["cadastros"][$id];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <main class="d-flex justify-content-center">

        <!-- formulário para editar o produto carregado com as informações atuais -->
        <form class="d-flex flex-column fundo-cinza m-5" method="post" enctype="multipart/form-data" action="editar-produto.php">
            <h2>Editar produtos</h2>
            <input type="hidden" name="id" value=<?= $id ?>> <!-- informação do id para poder atualizar os dados -->
            <div class="form-group">
                <label for="nome_id">Nome</label>
                <input type="text" name="nome" id="nome_id" class="form-control" value=<?= $produto["nome"]; ?>>
            </div>
            <div class="form-group">
                <label for="categoria_id" class="label-categoria">Categoria</label>
                <div class="d-flex">
                    <select name="categoria">
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value=<?php echo '"'.$categoria.'"' ?> <?php if ($categoria == $produto["categoria"]) { echo "selected"; } ?>>
                                <?php echo $categoria ?>
                            </option> 
                        <?php } ?>
                    </select>
                    <input type="text" name="categoria_outra" id="categoria_outra_id" class="form-control" placeholder="Se outra, digite aqui...">
                </div>
            </div>
            <div class="form-group">
                <label for="descricao_id">Descrição</label>
                <textarea class="form-control" name="descricao" id="descricao_id" rows="3"><?= $produto["descricao"]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="quantidade_id">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade_id" class="form-control" value=<?= $produto["quantidade"]; ?>>
            </div>
            <div class="form-group">
                <label for="preco_id">Preço</label>
                <input type="number" name="preco" id="preco_id" class="form-control" value=<?= $produto["preco"]; ?>>
            </div>
            <div class="form-group">
                <label for="foto_id">Nova foto do produto</label>
                <input type="file" class="form-control-file" name="foto" id="foto_id">
            </div>
            <!-- botões para voltar e salvar -->
            <div class="d-flex justify-content-between">
                <a href="pagina-individual.php?id=<?php echo $id; ?>" class="btn btn-secondary align-self-end">Voltar</a>
                <button type="submit" class="btn btn-primary align-self-end">Salvar</button>
            </div>
        </form>
        
    </main>

</body>
</html>

