<?php
    
    session_start();

    //adicionando novas informações, caso existam
    if ($_POST) {
        $_SESSION["cadastros"][] = $_POST;
    }

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

                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($_SESSION["cadastros"] as $chave=>$cadastro) { ?>
                        <tr>
                            <td><a href="pagina-individual.php?id=<?php echo $chave ?>"><?php echo $cadastro["nome"] ?></a></td>
                            <td><?php echo $cadastro["categoria"] ?></td>
                            <td><?php echo $cadastro["preco"] ?></td>
                    <?php } ?>
                </tbody>

            </table>
        </section>

        <!-- Formulario para cadastrar produtos -->
        <form class="col-5 d-flex flex-column fundo-cinza" method="post" action="">
            <h2>Cadastrar produtos</h2>
            <div class="form-group">
                <label for="nome_id">Nome</label>
                <input type="text" name="nome" id="nome_id" class="form-control">
            </div>
            <!-- FIXME: ajustar ara list buttom -->
            <div class="form-group">
                <label for="categoria_id">Categoria</label>
                <input type="text" name="categoria" id="categoria_id" class="form-control">
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