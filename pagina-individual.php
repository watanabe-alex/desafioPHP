<?php
    
    session_start();

    //pega informações do produto pelo id passado via get
    $id = $_GET["id"];
    $produto = $_SESSION["cadastros"][$id];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <main class="d-flex justify-content-center">

        <div class="container fundo-cinza m-5">

            <!-- botões para voltar e excluir -->
            <div class="d-flex justify-content-between">
                <a class="btn btn-light ml-5" href="index.php">Voltar para lista de produtos</a>
                <div>
                    <form action="excluir.php" method="post"> 
                        <input type="hidden" name="id" value=<?php echo $id ?>>
                        <button class="btn btn-light" type="submit">Excluir</button>
                    </form>
                </div>
            </div>

            <!-- imagem e informações -->
            <div class="row mt-5 ml-5">

                <!-- imagem -->
                <div class="div-imagem col-5">
                    <img src=<?php echo $produto["foto"] ?> alt="imagem-do-produto" class="imagem-produto">
                </div>
                <!-- informações -->
                <div class="col-6">
                    <h2 class="h1 pb-3"><?php echo $produto["nome"] ?></h2>
                    <p class="texto-label">Categoria</p>
                    <p><?php echo $produto["categoria"] ?></p>
                    <p class="texto-label">Descrição</p>
                    <p><?php echo $produto["descricao"] ?></p>
                    <div class="row pt-4">
                        <div class="col-6">
                            <p class="texto-label">Quantidade em estoque</p>
                            <p><?php echo $produto["quantidade"] ?></p>
                        </div>
                        <div class="col-6">
                            <p class="texto-label">Preço</p>
                            <p><b><?php echo "R$ ".$produto["preco"] ?></b></p>
                        </div>
                    </div>

                    <!-- botão para editar produto -->
                    <form class="mt-5" action="pagina-editar-produto.php" method="post">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button type="submit" class="btn btn-secondary">Editar</button>
                    </form>

                </div>             
            </div>      
        </div>

    </main>

</body>
</html>