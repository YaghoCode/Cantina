<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();


if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    // Tenta buscar como administrador
    $query_admin = "SELECT nome, cpf, email, adm FROM administradores WHERE cpf = '$cpf'";
    $result_admin = mysqli_query($con, $query_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {
        $user_data = mysqli_fetch_assoc($result_admin);
        // Permite acesso
    } else {
        // Não é admin, redireciona
        header("Location: ./cardapio.php");
        exit;
    }
} else {
    header("Location: ./login.php");
    exit;
}

// Estatísticas do estoque

$query = "SELECT * from estoque";
$query_run = mysqli_query($con, $query);
$total_products = mysqli_num_rows($query_run);
$query_low = "SELECT * from estoque WHERE quantidade < 5";
$low_products_count = mysqli_num_rows($low_products = mysqli_query($con, $query_low));
$query_total_value = "SELECT SUM(preco * quantidade) AS total_value FROM estoque";
$total_value_result = mysqli_query($con, $query_total_value);
$total_value_row = mysqli_fetch_assoc($total_value_result);
$total_value_result = 'R$ ' . number_format($total_value_row['total_value'], 2, ',', '.');
$query_users = "SELECT * from cliente";
$query_run_user = mysqli_query($con, $query_users);
$total_clientes = mysqli_num_rows($query_run_user);

?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['cadastrar-produto'])) {
        // Sanitização dos dados
        $nome = filter_input(INPUT_POST, 'nome-produto', FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, 'descricao-produto', FILTER_SANITIZE_SPECIAL_CHARS);
        $preco = filter_input(INPUT_POST, 'preco-produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $quantidade = filter_input(INPUT_POST, 'quantidade-produto', FILTER_SANITIZE_NUMBER_INT);
        $categoria = filter_input(INPUT_POST, 'categoria-produto', FILTER_SANITIZE_SPECIAL_CHARS);
        $nomearquivo = $_FILES['imagem-produto']['name'];
        $ext = pathinfo($nomearquivo, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $tempName = $_FILES['imagem-produto']['tmp_name'];
        $TargetPath = "/xampp/htdocs/cantinarepositorio/subpages/imgbd/" . $nomearquivo;
        echo $nomearquivo;
        // Inserção no banco de dados
        // Quando a gente fez isso embaixo???
        if (in_array($ext, $allowedTypes)) {
            if (move_uploaded_file($tempName, $TargetPath)) {
                $sql = "INSERT INTO estoque (Nome, Descricao, Preco, Quantidade, Categoria, img) VALUES ('$nome', '$descricao', '$preco', '$quantidade', '$categoria', '$nomearquivo')";
                if (mysqli_query($con, $sql)) {
                    // Redireciona após sucesso
                    header("Location: /cantinarepositorio/subpages/estoque.php");
                    exit;
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } else {
            throw new Exception();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesAdmin/estoque.css">
    <title>FURA FILA - Estoque</title>
</head>

<body>
    <!-- header, navbar -->
    <header>
        <nav class="navbar">
            <div class="nav-links">
                <div class="nav-logo">
                    <div class="aside-icon">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
                <div class="nav-items">
                    <ul>
                        <li>
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <div class="btn-voltar-home">
                        <button type="button" class="btn-js-redirect" data-href="/cantinarepositorio/main/index.php">
                            <a href="/cantinarepositorio/main/index.php"><i class="fa-solid fa-house"></i>Home</a>
                        </button>
                    </div>
                    <div class="btn-user" id="btn-user-nav">
                        <button>
                            <i class="fa-regular fa-user"></i> Perfil
                        </button>
                    </div>
                </div>
        </nav>
    </header>

    <!--POPUP DO USER-->
    <div class="overlay-pop-up-user" id="overlay-pop-up-user">

    </div>
    <div class="pop-up-user" id="pop-up-user">
        <button class="btn-fechar-pop-up-user" id="btn-close-user-nav">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="content-pop-user">
            <div class="content-top-user">
                <div class="content-top-left-user">
                    <div class="content-top-left-user-img">
                        <img src="./assets/img/CocaCola.png" alt="">
                    </div>
                </div>
                <div class="content-top-right-user">
                    <div class="content-top-right-user-text">
                        <div class="content-top-right-user-text-name">
                            <h3>
                                <?php echo $user_data['nome'] ?>
                            </h3>
                        </div>
                        <div class="content-top-right-user-text-email">
                            <h6>
                                <?php
                                echo $user_data['email'] ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-mid-user">
                <div class="content-mid-user-row">
                    <div class="content-mid-user-row-left">
                        <div class="content-mid-user-row-left-icon">
                            <i class="fa-regular fa-credit-card"></i>
                        </div>
                    </div>
                    <div class="content-mid-user-row-right">
                        <div class="content-mid-user-row-right-text">
                            <h1>
                                CPF:
                            </h1>
                            <h3>
                                <?php

                                echo $user_data['cpf']; ?>

                            </h3>
                        </div>
                    </div>
                </div>
                <div class="content-mid-user-row">
                    <div class="content-mid-user-row-left">
                        <div class="content-mid-user-row-left-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    </div>
                    <div class="content-mid-user-row-right">
                        <div class="content-mid-user-row-right-text">
                            <h1>
                                Tipo de conta:
                            </h1>
                            <h3>
                                <?php
                                if ($user_data['adm'] == '1') {
                                    echo 'Administrador Principal';
                                } else {
                                    echo 'Funcionario ';
                                } ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-user">
                <div class="content-bottom-user-row">
                    <button type="button" class="btn-logout-pop-up">
                        <a href="/cantinarepositorio/subpages/logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Aside-->
    <div class="aside-options">
        <div class="aside-top">
            <div class="btn-close-aside">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="aside-top-logo">
                <img src="/cantinarepositorio/main/assets/img/logo-footer.png" alt="">
            </div>
        </div>
        <div class="aside-bottom">
            <div class="aside-bottom-title">
                <h6>Menu principal</h6>
            </div>
            <div class="aside-lista">
                <ul>
                    <li id="btn-estoque"><i class="fa-solid fa-box-open"></i> Estoque</li>
                    <li id="btn-clientes"><i class="fa-solid fa-users"></i> Clientes</li>
                    <li id="btn-pedidos"><i class="fa-solid fa-clipboard-list"></i> Pedidos</li>
                    <li id="btn-configuracoes" <?php if ($user_data['adm'] != 1) {
                                                    echo 'style="display:none;"';
                                                } ?>;>
                        <i class="fa-solid fa-gear"></i> Configurações
                    </li>

                </ul>
            </div>
        </div>
    </div>
    </div>

    <main>
        <!--Modal adicionar item ao cardapio e estoque-->
        <!--tabela novo produto-->

        <div class="modal-novo-produto" id="modal-novo-p">
            <div class="modal-content">
                <div class="modal-content-left">
                    <div class="modal-title">
                        <h1>
                            Crie um novo produto:
                        </h1>
                    </div>
                    <!--Form de cadastrar produto-->
                    <div class="modal-form-produto">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                            class="form-novo-produto" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titulo">Título do Produto:</label>
                                <input type="text" id="titulo" name="nome-produto" class="form-control"
                                    placeholder="Digite o título do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição do Produto:</label>
                                <input type="text" id="descricao" name="descricao-produto" class="form-control"
                                    placeholder="Digite a descrição do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="number" id="preco" name="preco-produto" class="form-control"
                                    placeholder="Digite o preço do produto" step="0.01" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" id="quantidade" name="quantidade-produto" class="form-control"
                                    placeholder="Digite a quantidade disponível" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <select id="categoria" name="categoria-produto" class="form-control" required>
                                    <option value="Salgados">Salgados</option>
                                    <option value="Folhados">Folhados</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="cadastrar-produto" class="btn btn-primary">Criar
                                    Produto</button>
                            </div>
                    </div>
                </div>
                <div class="modal-content-right">
                    <div class="btn-close-modal">
                        <button id="btn-close-modal-p">
                            <i class="fa-solid fa-xmark" id="btn-close-modal-p"></i>
                        </button>
                    </div>
                    <div class="upload-imagem">
                        <label for="label-imagem">Escolha uma imagem para o produto:</label>
                        <input type="file" id="imagem-produto" name="imagem-produto" accept="image/*"
                            style="display: none;">
                        <div class="preview-imagem">
                            <button id="btn-remove-preview" class="btn-remove-preview" style="display: none;">
                                <h1>&times;</h1>
                            </button>
                            <img id="preview" src="#" alt="Pré-visualização da imagem" style="display: none;">
                        </div>
                        <label for="imagem-produto" class="btn-upload">
                            <i class="fa-solid fa-upload"></i> Escolher Imagem
                        </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Main conteudo estoque-->

        <div class="container-estoque" id="conteudo-estoque">
            <div class="title-estoque">
                <div class="title-estoque-text">
                    <h1>Gerenciar Estoque</h1>
                    <p>Controle e monitore seus produtos.</p>
                </div>
                <div class="btn-adicionar-estoque">
                    <button id="btn-adicionar-produto"><i class="fa-solid fa-plus"></i> Adicionar Produto</button>
                </div>
            </div>
            <div class="content-estoque">
                <div class="content-estoque-top">
                    <div class="cards-estoque-stats">
                        <div class="title-cards-stats">
                            <div class="title-cards-stats-text">
                                <h1>Total de produtos: </h1>
                            </div>
                            <div class="title-cards-stats-icon">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="cards-number-stats">
                            <h1><?php echo $total_products; ?></h1> <!--PHP-->
                        </div>
                    </div>
                    <div class="cards-estoque-stats" id="cards-estoque-low">
                        <div class="title-cards-stats">
                            <div class="title-cards-stats-text">
                                <h1>Produtos com estoque baixo: </h1>
                            </div>
                            <div class="title-cards-stats-icon">
                                <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i>
                            </div>
                        </div>
                        <div class="cards-number-stats">
                            <h1><?php echo $low_products_count; ?></h1> <!--PHP-->
                        </div>
                    </div>
                    <div class="cards-estoque-stats" id="cards-estoque-total">
                        <div class="title-cards-stats">
                            <div class="title-cards-stats-text">
                                <h1>Valor total em estoque:</h1>
                            </div>
                            <div class="title-cards-stats-icon">
                                <i class="fa-solid fa-dollar-sign" style="color: #14ff18;"></i>
                            </div>
                        </div>
                        <div class="cards-number-stats">
                            <h1><?php echo $total_value_result; ?></h1> <!--PHP-->
                        </div>
                    </div>
                </div>
                <div class="content-estoque-bottom">
                    <div class="estoque-options">
                        <button id="dropdownButton" class="btn btn-secondary dropdown-toggle d-flex align-items-center"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-2" aria-hidden="true"></i>
                            <span id="dropdownLabel">Todos os Produtos</span>
                        </button>

                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><a class="dropdown-item active" id="btn-all-produtos" href="#" data-value="all">Todos os
                                    Produtos</a></li>
                            <li><a class="dropdown-item" id="btn-low-produtos" href="#" data-value="low">Estoque
                                    Baixo</a></li>
                            <li><a class="dropdown-item" id="btn-salgados-produtos" href="#"
                                    data-value="snacks">Salgados</a></li>
                            <li><a class="dropdown-item" id="btn-folhados-produtos" href="#"
                                    data-value="snacks2">Folhados</a></li>
                            <li><a class="dropdown-item" id="btn-doces-produtos" href="#" data-value="sweets">Doces</a>
                            </li>
                            <li><a class="dropdown-item" id="btn-bebidas-produtos" href="#"
                                    data-value="drinks">Bebidas</a></li>
                            <li><a class="dropdown-item" id="btn-outros-produtos" href="#"
                                    data-value="others">Outros</a></li>
                        </ul>
                    </div>
                    <div class="table-estoque-all" id="table-all">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "SELECT * from estoque";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-toggle-cardapio">
                                                    <i class="fa-solid fa-thumbtack"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-baixo" id="table-low">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from estoque WHERE Quantidade < 5";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-salgados" id="table-salgados">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from estoque WHERE Categoria = 'Salgados'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-toggle-cardapio">
                                                    <i class="fa-solid fa-thumbtack"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-folhados" id="table-folhados">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "SELECT * from estoque WHERE Categoria = 'Folhados'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-doces" id="table-doces">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "SELECT * from estoque WHERE Categoria = 'Doces'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-toggle-cardapio">
                                                    <i class="fa-solid fa-thumbtack"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-bebidas" id="table-bebidas">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from estoque WHERE Categoria = 'Bebidas'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-toggle-cardapio">
                                                    <i class="fa-solid fa-thumbtack"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-estoque-outros" id="table-outros">
                        <table>
                            <thead>
                                <tr>
                                    <td>Imagem</td>
                                    <td>Produto</td>
                                    <td>Categoria</td>
                                    <td>Estoque</td>
                                    <td>Preço</td>
                                    <td>Valor Total</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "SELECT * from estoque WHERE Categoria = 'Outros'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
                                ?>
                                        <tr>
                                            <td> <img src="./imgbd/<?php echo $item['img']; ?>" alt=""> </td> <!--Img Item-->
                                            <td>
                                                <h6><?php echo $item['Nome']; ?></h6>
                                            </td> <!--Name Item-->
                                            <td>
                                                <h6><?php echo $item['Categoria']; ?></h6>
                                            </td> <!--Categoria Item-->
                                            <td>
                                                <h6><?php echo $item['Quantidade']; ?></h6>
                                            </td> <!--Quantidade no Estoque-->
                                            <td>
                                                <h6>R$ <?php echo $item['preco']; ?></h6>
                                            </td> <!--Preço Item-->
                                            <td>
                                                <h6><?php echo $item['valor_total']; ?></h6>
                                            </td> <!--Preço X quantidade em estoque-->
                                            <td id="table-acoes">
                                                <button class="btn-visualizar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn-editar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-toggle-cardapio">
                                                    <i class="fa-solid fa-thumbtack"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAIS ESTOQUE -->

        <!--Modal Cardapio visualizar-->

        <?php
        $query = "SELECT * from estoque";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
                $preco = 'R$ ' . number_format($item['preco'], 2, ',', '.');
                $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
        ?>
                <div class="modal-overlay-estoque" id="modal-<?= $item['id'] ?>">
                    <div class="modal-estoque-visualizar-item" id="modal-visualizar-item">
                        <div class="modal-estoque-top">
                            <div class="modal-estoque-title">
                                <h1>Detalhes do Produto:</h1>
                            </div>
                            <div class="modal-estoque-btn-close">
                                <button class="btn-close-modal-estoque" id="btn-close-modal-estoque"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>
                        <div class="modal-estoque-mid">
                            <div class="modal-estoque-imagem">
                                <img src="./imgbd/<?php echo $item['img'] ?>" alt=""> <!--Php image item-->
                            </div>
                        </div>
                        <div class="modal-estoque-bottom">
                            <div class="modal-description-estoque">
                                <div class="modal-estoque-description-produto">
                                    <div class="modal-estoque-description-produto-title">
                                        <h1>Produto:</h1>
                                    </div>
                                    <div class="modal-estoque-description-produto-php">
                                        <h2><?php echo $item['Nome'] ?></h2> <!--PHP name item-->
                                    </div>
                                </div>
                                <div class="modal-estoque-description-descrisao">
                                    <div class="modal-estoque-description-descrisao-title">
                                        <h1>Descrisão Produto:</h1>
                                    </div>
                                    <div class="modal-estoque-description-descrisao-php">
                                        <h2> <?php echo $item['Descricao'] ?></h2> <!--PHP descrisao item-->
                                    </div>
                                </div>
                                <div class="modal-estoque-description-categoria">
                                    <div class="modal-estoque-description-categoria-title">
                                        <h1>Categoria:</h1>
                                    </div>
                                    <div class="modal-estoque-description-categoria-php">
                                        <h2><?php echo $item['Categoria'] ?></h2> <!--PHP CATEGORIA ITEM-->
                                    </div>
                                </div>
                                <div class="modal-estoque-description-quantidade">
                                    <div class="modal-estoque-description-quantidade-title">
                                        <h1>Estoque:</h1>
                                    </div>
                                    <div class="modal-estoque-description-quantidade-php">
                                        <h2><?php echo $item['Quantidade'] ?></h2> <!--PHP Estoque ITEM-->
                                    </div>
                                </div>
                                <div class="modal-estoque-description-preco">
                                    <div class="modal-estoque-description-preco-title">
                                        <h1>Preço:</h1>
                                    </div>
                                    <div class="modal-estoque-description-preco-php">
                                        <h2><?php echo $preco ?></h2> <!--PHP Preço ITEM-->
                                    </div>
                                </div>
                                <div class="modal-estoque-description-total">
                                    <div class="modal-estoque-description-total-title">
                                        <h1>Valor Total:</h1>
                                    </div>
                                    <div class="modal-estoque-description-total-php">
                                        <h2><?php echo $item['valor_total'] ?></h2> <!--PHP total valor ITEM-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php }
        } ?>

        <script>
            // modal estoque table produtos visualizar button
            document.addEventListener('DOMContentLoaded', () => {
                const buttons = document.querySelectorAll('.btn-visualizar-item');

                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-id');
                        const modal = document.getElementById('modal-' + modalId);
                        console.log(modal)

                        if (modal && !modal.classList.contains('active')) {
                            modal.classList.add('active');
                        }
                    });
                });

                document.querySelectorAll('.modal-overlay-estoque').forEach(overlay => {
                    const closeButton = overlay.querySelectorAll('.btn-close-modal-estoque');


                    closeButton.forEach(btnFechar => {
                        btnFechar.addEventListener('click', () => {
                            overlay.classList.remove('active');
                        })
                    });

                    overlay.addEventListener('click', (e) => {
                        if (e.target === overlay) {
                            overlay.classList.remove('active');
                        }
                    });
                });
            });
        </script>
        <!--Modal estoque deletar item-->

        <?php
        $query = "SELECT * from estoque";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
        ?>
                <div class="overlay-modal-estoque-deletar-item">

                </div>
                <div class="modal-estoque-deletar-item" id="modal-deletar-item-<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                    <div class="modal-deletar-content-top">
                        <h1>Tem certeza?</h1>
                        <p>Esta ação não pode ser desfeita. O produto "<?php echo $item['Nome'] ?>" será permanentemente
                            removido do estoque.</p>
                    </div>
                    <div class="modal-deletar-content-bottom">
                        <button class="activeButtonCancelar" id="btn-cancelar-deletar-item">
                            Cancelar
                        </button>
                        <button class="activeButtonExcluir" data-id="<?= $item['id'] ?>">
                            Excluir
                        </button>
                    </div>
                </div>

        <?php }
        } ?>

        <script>
            // function abrir e fechar modal deletar item

            const modalDeletarItem = document.getElementById('modal-deletar-item');
            const btnCancelarExcluir = document.querySelectorAll('.activeButtonCancelar');
            const btnDeletarItem = document.querySelectorAll('.btn-deletar-item');

            btnDeletarItem.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const produtoId = btn.getAttribute('data-id');
                    const modalDeletar = document.getElementById('modal-deletar-item-' + produtoId);
                    const overlayModaldeletaritem = document.querySelector('.overlay-modal-estoque-deletar-item')
                    if (modalDeletar) {
                        modalDeletar.style.display = 'flex';
                        overlayModaldeletaritem.style.display = 'flex';
                    }
                });
            });


            btnCancelarExcluir.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal-estoque-deletar-item');
                    const overlayModaldeletaritem = document.querySelector('.overlay-modal-estoque-deletar-item')
                    if (modal) {
                        modal.style.display = 'none';
                        overlayModaldeletaritem.style.display = 'none';
                    }
                });
            });

            // modal deletar estoque button
            document.querySelectorAll('.activeButtonExcluir').forEach(button => {
                button.addEventListener('click', () => {
                    const produtoId = button.getAttribute('data-id');
                    console.log('ID enviado:', produtoId);
                    fetch('/cantinarepositorio/subpages/delete_item.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(produtoId)
                        })
                        .then(response => response.json())
                        .then(data => { // Corrigido: Adicionado parênteses ao redor de "data"
                            if (data.success) {
                                alert('Produto removido!');
                                location.reload();
                            } else {
                                alert('Erro ao remover produto!');
                            }
                        })
                        .catch(error => {
                            console.error('Erro na requisição:', error);
                            alert('Erro ao tentar remover o produto.');
                        });
                });
            });
        </script>



        <!--Modal estoque editar item-->
        <?php
        $query = "SELECT * from estoque";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
                $preco = 'R$ ' . number_format($item['preco'], 2, ',', '.');
                $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
        ?>
                <!-- MODAL EDITAR ITEM -->
                <div class="overlay-editar-produto" id="overlayEditar-<?= $item['id'] ?>">
                    <div class="modal-editar-produto" id="modalEditar-<?= $item['id'] ?>">
                        <button type="button" class="btn-fechar-editar" data-id="<?= $item['id'] ?>" title="Fechar modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <h2 class="editar-produto-titulo">Editar Produto:</h2>
                        <form id="formEditarProduto-<?= $item['id'] ?>" method="POST" action="atualizar_item.php"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" />

                            <div class="editar-produto-imagem-box">
                                <img src="./imgbd/<?php echo $item['img'] ?>" alt="Imagem do produto" />
                            </div>

                            <div class="editar-produto-trocar-img">
                                <div>
                                    <h3>Trocar Imagem</h3>
                                    <p>Ative para fazer upload de uma nova imagem</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" id="toggleTrocarImagem-<?= $item['id'] ?>" name="trocar_imagem" />
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <!-- Espaço do upload (controlado pelo JS, inicia oculto) -->
                            <div class="editar-produto-upload" id="editarProdutoUpload-<?= $item['id'] ?>"
                                style="display: none;">
                                <div class="upload-container">
                                    <label for="inputNovaImagem-<?= $item['id'] ?>" class="upload-label">
                                        <i class="fa-solid fa-upload"></i> Escolher Imagem
                                    </label>
                                    <span class="upload-nome" id="uploadNome-<?= $item['id'] ?>">Nenhum arquivo
                                        selecionado</span>
                                    <input type="file" id="inputNovaImagem-<?= $item['id'] ?>" name="nova_imagem"
                                        accept="image/*">
                                </div>

                                <div class="" id="previewContainer-<?= $item['id'] ?>"
                                    style="margin-top:10px; display:none;justify-content:center;align-items:center;">
                                    <img id="editarProdutoPreviewImg-<?= $item['id'] ?>" src="" alt="Prévia da nova imagem"
                                        style="width:25%; border-radius:8px; object-fit:cover;margin-top:1vh;">
                                </div>
                            </div>

                            <div class="editar-produto-inputs-duplo">
                                <div class="input-grupo">
                                    <label>Produto *</label>
                                    <input type="text" name="produto" value="<?= htmlspecialchars($item['Nome']) ?>" required />
                                </div>
                                <div class="input-grupo">
                                    <label>Categoria *</label>
                                    <select name="categoria" required>
                                        <option value="Salgados" <?= $item['Categoria'] == "Salgados" ? 'selected' : '' ?>>Salgados
                                        </option>
                                        <option value="Folhados" <?= $item['Categoria'] == "Folhados" ? 'selected' : '' ?>>Folhados
                                        </option>
                                        <option value="Doces" <?= $item['Categoria'] == "Doces" ? 'selected' : '' ?>>Doces</option>
                                        <option value="Bebidas" <?= $item['Categoria'] == "Bebidas" ? 'selected' : '' ?>>Bebidas
                                        </option>
                                        <option value="Outros" <?= $item['Categoria'] == "Outros" ? 'selected' : '' ?>>Outros
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-grupo full">
                                <label>Descrição *</label>
                                <textarea name="descricao" required><?= htmlspecialchars($item['Descricao']) ?></textarea>
                            </div>

                            <div class="editar-produto-inputs-duplo">
                                <div class="input-grupo">
                                    <label>Estoque *</label>
                                    <input type="number" name="quantidade" min="0" value="<?= $item['Quantidade'] ?>"
                                        required />
                                </div>
                                <div class="input-grupo">
                                    <label>Preço *</label>
                                    <input type="number" step="0.01" name="preco" min="0.1" value="<?= $item['preco'] ?>"
                                        required />
                                </div>
                            </div>
                            <div class="input-grupo-btn">
                                <button type="button" class="btn-cancelar-editar" data-id="<?= $item['id'] ?>">Cancelar</button>
                                <button type="submit" class="btn-salvar-editar"><i class="fa-solid fa-floppy-disk"></i> Salvar
                                    Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Abrir modal
                document.querySelectorAll('.btn-editar-item').forEach(button => {
                    button.addEventListener('click', () => {
                        const itemId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlayEditar-${itemId}`);
                        const modal = document.getElementById(`modalEditar-${itemId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });

                // Fechar modal (botão X e Cancelar)
                document.querySelectorAll('.btn-fechar-editar, .btn-cancelar-editar').forEach(button => {
                    button.addEventListener('click', () => {
                        const itemId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlayEditar-${itemId}`);
                        const modal = document.getElementById(`modalEditar-${itemId}`);
                        if (overlay && modal) {
                            overlay.classList.remove('active');
                            modal.classList.remove('active');
                        }
                    });
                });

                // Fechar clicando fora
                document.querySelectorAll('.overlay-editar-produto').forEach(overlay => {
                    overlay.addEventListener('click', e => {
                        if (e.target === overlay) {
                            overlay.classList.remove('active');
                            const itemId = overlay.id.replace('overlayEditar-', '');
                            const modal = document.getElementById(`modalEditar-${itemId}`);
                            if (modal) modal.classList.remove('active');
                        }
                    });
                });

                // Toggle trocar imagem
                document.querySelectorAll('[id^="toggleTrocarImagem-"]').forEach(toggle => {
                    toggle.addEventListener('change', () => {
                        const id = toggle.id.split('-')[1];
                        const uploadBox = document.getElementById(`editarProdutoUpload-${id}`);
                        const inputFile = document.getElementById(`inputNovaImagem-${id}`);
                        const nomeArquivo = document.getElementById(`uploadNome-${id}`);
                        const preview = document.getElementById(`editarProdutoPreviewImg-${id}`);
                        const previewContainer = document.getElementById(`previewContainer-${id}`);

                        uploadBox.style.display = toggle.checked ? 'block' : 'none';

                        inputFile.addEventListener('change', e => {
                            const file = e.target.files[0];
                            if (file) {
                                nomeArquivo.textContent = file.name;
                                const reader = new FileReader();
                                reader.onload = () => {
                                    preview.src = reader.result;
                                    previewContainer.style.display = 'flex';
                                };
                                reader.readAsDataURL(file);
                            } else {
                                nomeArquivo.textContent = 'Nenhum arquivo selecionado';
                                previewContainer.style.display = 'none';
                            }
                        });
                    });
                });
            });
        </script>

        <!--Modal toggle cardapio-->
        <div class="overlay-modal-toggle-cardapio">
            <div class="modal-toggle-cardapio">
                <div class="modal-toggle-cardapio-content">
                    <button class="btn-fechar-modal-toggle">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toggle-content-title">
                        <h1>Exibir produto no cardápio:</h1>
                    </div>
                    <div class="toggle-content-top">
                        <div class="toggle-content-top-left">
                            <div class="toggle-content-top-left-img"> <!--produto imagem-->
                                <img src="./assets/img/CocaCola.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="toggle-content-bottom">
                        <div class="toggle-content-bottom-left">
                            <div class="toggle-content-bottom-left-info">
                                <h1>
                                    Nome produto: <span>Esfiha de Carne</span>
                                </h1>
                                <h1>
                                    Tipo: <span>Salgados</span>
                                </h1>
                            </div>
                        </div>
                        <div class="toggle-content-bottom-right">
                            <div class="toggle-item">
                                <label class="switch">
                                    <input type="checkbox" id="toggle-main">
                                    <span class="slider"></span>
                                </label>
                                <span>Exibir na página principal</span>
                            </div>

                            <div class="toggle-item">
                                <label class="switch">
                                    <input type="checkbox" id="toggle-cardapio">
                                    <span class="slider"></span>
                                </label>
                                <span>Exibir no cardápio</span>
                            </div>
                            <h2 class="obs-toggle-item"><span>Obs:</span> Na página principal o limite maximo de itens
                                por seção é 3, ou seja, no maximo 3 itens na seção salgados, 3 itens na seção folhados e
                                etc.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const modalToggleCardapio = document.querySelector('.modal-toggle-cardapio');
            const overlayModalToggleCardapio = document.querySelector('.overlay-modal-toggle-cardapio');
            const btnFecharModalToggle = document.querySelector('.btn-fechar-modal-toggle');
            const btnToggleCardapio = document.querySelectorAll('.btn-toggle-cardapio');

            btnToggleCardapio.forEach((btn) => {
                btn.addEventListener('click', () => {
                    modalToggleCardapio.classList.add('active');
                    overlayModalToggleCardapio.classList.add('active');
                });
            });

            btnFecharModalToggle.addEventListener('click', () => {
                modalToggleCardapio.classList.remove('active');
                overlayModalToggleCardapio.classList.remove('active');
            });
        </script>


        <!--Paginas com display none-->
        <div class="container-clientes" id="conteudo-clientes">
            <div class="title-clientes">
                <div class="title-clientes-text">
                    <h1>Gerenciar Clientes</h1>
                    <p>Gerencie e controle seus clientes e cadastros.</p>
                </div>
            </div>
            <div class="content-clientes">
                <div class="content-clientes-top">
                    <div class="cards-clientes-stats">
                        <div class="title-clientes-cards-stats">
                            <div class="title-clientes-cards-stats-text">
                                <h1>Total de clientes:</h1>
                            </div>
                            <div class="cards-clientes-stats-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                        <div class="cards-clientes-number-stats">
                            <h1><?php echo $total_clientes; ?></h1>
                        </div>
                    </div>
                    <div class="cards-clientes-stats" id="cards-clientes-ativos">
                        <div class="title-clientes-cards-stats">
                            <div class="title-clientes-cards-stats-text">
                                <h1>Clientes Ativos:</h1>
                            </div>
                            <div class="cards-clientes-stats-icon">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                        </div>
                        <div class="cards-clientes-number-stats">
                            <h1>5</h1>
                        </div>
                    </div>
                    <div class="cards-clientes-stats" id="cards-clientes-total-p">
                        <div class="title-clientes-cards-stats">
                            <div class="title-clientes-cards-stats-text">
                                <h1>Total de pedidos:</h1>
                            </div>
                            <div class="cards-clientes-stats-icon">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                        </div>
                        <div class="cards-clientes-number-stats">
                            <h1>109</h1>
                        </div>
                    </div>
                </div>
                <div class="content-clientes-bottom">
                    <div class="clientes-filtro">
                        <div class="clientes-filtro-options">
                            <button class="btn-filtro-clientes-all active">
                                Todos
                            </button>
                            <button class="btn-filtro-clientes-a">
                                A
                            </button>
                            <button class="btn-filtro-clientes-z">
                                Z
                            </button>
                            <button class="btn-filtro-clientes-1-pedido">
                                Ativo
                            </button>
                            <button class="btn-filtro-clientes-0-pedido">
                                Inativo
                            </button>
                        </div>
                    </div>
                    <div class="table-clientes-all">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome:</td>
                                    <td>Email:</td>
                                    <td>CPF:</td>
                                    <td>Sala</td>
                                    <td>Pedidos:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody> <!--Lista de clientes-->
                                <?php
                                $query = "SELECT * from cliente";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $cliente) {
                                ?>
                                        <tr>
                                            <td>
                                                <h6><?php echo $cliente['nome']; ?></h6>
                                            </td> <!--nome cliente-->
                                            <td>
                                                <h6><?php echo $cliente['email']; ?></h6>
                                            </td> <!--email cliente-->
                                            <td>
                                                <h6><?php echo $cliente['cpf']; ?></h6>
                                            </td> <!--cpf cliente-->
                                            <td>
                                                <h6><?php echo $cliente['turma']; ?></h6> <!--turma -->
                                            </td>
                                            <td>
                                                <span>Ainda não fizemos</span>
                                            </td> <!--numero de pedidos feito do cliente-->
                                            <td>
                                                <strong>Ativo</strong>
                                            </td>
                                            <td style="display: flex;gap:1vh;">
                                                <button class="editar-cliente-adm" data-id="<?= $cliente['cpf'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="deletar-cliente-adm" data-id="<?= $cliente['cpf'] ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-clientes-filtro-a">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome:</td>
                                    <td>Email:</td>
                                    <td>CPF:</td>
                                    <td>Sala</td>
                                    <td>Pedidos:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-clientes-filtro-z">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome:</td>
                                    <td>Email:</td>
                                    <td>CPF:</td>
                                    <td>Sala</td>
                                    <td>Pedidos:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-clientes-filtro-ativo">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome:</td>
                                    <td>Email:</td>
                                    <td>CPF:</td>
                                    <td>Sala</td>
                                    <td>Pedidos:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-clientes-filtro-inativo">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome:</td>
                                    <td>Email:</td>
                                    <td>CPF:</td>
                                    <td>Sala</td>
                                    <td>Pedidos:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const botoesFiltro = document.querySelectorAll(".clientes-filtro-options button");
                const contentClientes = document.querySelector(".content-clientes-bottom");
                if (!contentClientes) return;

                // Seleciona todas as tabelas dentro de content-clientes-bottom
                const tabelas = Array.from(contentClientes.querySelectorAll("table"));

                // 🔹 Função de animação (fade)
                function fadeOut(el) {
                    el.style.transition = "opacity 0.3s ease";
                    el.style.opacity = "0";
                    setTimeout(() => {
                        el.style.display = "none";
                    }, 300);
                }

                function fadeIn(el) {
                    el.style.display = "";
                    el.style.opacity = "0";
                    el.style.transition = "opacity 0.3s ease";
                    setTimeout(() => {
                        el.style.opacity = "1";
                    }, 10);
                }

                // 🔹 Ordenar por nome
                function ordenarPorNome(tbody, ordem = "asc") {
                    const linhas = Array.from(tbody.querySelectorAll("tr"));
                    linhas.sort((a, b) => {
                        const nomeA = a.querySelector("td:nth-child(1) h6")?.textContent.trim().toLowerCase() || "";
                        const nomeB = b.querySelector("td:nth-child(1) h6")?.textContent.trim().toLowerCase() || "";
                        return ordem === "asc" ? nomeA.localeCompare(nomeB) : nomeB.localeCompare(nomeA);
                    });
                    linhas.forEach(linha => tbody.appendChild(linha));
                }

                // 🔹 Filtrar clientes por número de pedidos
                function filtrarPorPedidos(tbody, tipo = "todos") {
                    const linhas = Array.from(tbody.querySelectorAll("tr"));
                    linhas.forEach(linha => {
                        const qtd = parseInt(linha.querySelector("td:nth-child(5) span")?.textContent || "0");
                        const deveMostrar =
                            tipo === "ativo" ? qtd >= 5 :
                            tipo === "inativo" ? qtd < 5 :
                            true;

                        if (deveMostrar) fadeIn(linha);
                        else fadeOut(linha);
                    });
                }

                // 🔹 Mostrar todos
                function mostrarTodos(tbody) {
                    const linhas = tbody.querySelectorAll("tr");
                    linhas.forEach(linha => fadeIn(linha));
                }

                // 🔹 Controle dos botões
                botoesFiltro.forEach(botao => {
                    botao.addEventListener("click", () => {
                        botoesFiltro.forEach(b => b.classList.remove("active"));
                        botao.classList.add("active");

                        tabelas.forEach(tabela => {
                            const tbody = tabela.querySelector("tbody");
                            if (!tbody) return;

                            if (botao.classList.contains("btn-filtro-clientes-all")) {
                                mostrarTodos(tbody);
                            } else if (botao.classList.contains("btn-filtro-clientes-a")) {
                                mostrarTodos(tbody);
                                ordenarPorNome(tbody, "asc");
                            } else if (botao.classList.contains("btn-filtro-clientes-z")) {
                                mostrarTodos(tbody);
                                ordenarPorNome(tbody, "desc");
                            } else if (botao.classList.contains("btn-filtro-clientes-1-pedido")) {
                                filtrarPorPedidos(tbody, "ativo");
                            } else if (botao.classList.contains("btn-filtro-clientes-0-pedido")) {
                                filtrarPorPedidos(tbody, "inativo");
                            }
                        });
                    });
                });

                // Exibir todos ao carregar
                tabelas.forEach(tabela => {
                    const tbody = tabela.querySelector("tbody");
                    if (tbody) mostrarTodos(tbody);
                });
            });
        </script>

        <?php
        $query = "SELECT * from cliente";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $cliente) {
        ?>
                <!--Modal editar clientes-->
                <div class="modal-overlay-clientes-editar" id="overlayEditarCliente-<?= $cliente['cpf'] ?>">
                    <div class="modal-clientes-editar" id="modalEditarCliente-<?= $cliente['cpf'] ?>">
                        <div class="modal-clientes-editar-content">
                            <button class="btn-fechar-modal-editar-cliente" data-id="<?= $cliente['cpf'] ?>">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <div class="editar-content-top">
                                <div class="editar-content-top-title">
                                    <div class="editar-content-top-title-text">
                                        <h1>Configurações da Conta</h1>
                                        <p>Gerencie as informações pessoais do seu cliente.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="editar-content-bottom">
                                <div class="form-editar-clientes-adm">

                                    <!--form editar cliente estoque-->
                                    <form action="atualizar_cliente.php" method="POST" class="form-editar-clientes-adm-inner">
                                        <input type="hidden" id="cpfid_editar_clientes_admin-<?= $cliente['cpf'] ?>"
                                            name="cpfid" value="<?= $cliente['cpf'] ?>" />
                                        <div class="form-editar-clientes-adm-row">
                                            <div class="form-editar-clientes-adm-group">
                                                <div class="form-editar-clientes-title">
                                                    <div class="form-editar-clientes-title-text">
                                                        <h1>Informações Pessoais:</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-editar-clientes-adm-row">
                                            <div class="form-editar-clientes-adm-group">
                                                <label for="nome">Nome:</label>
                                                <input type="text" id="nome_editar_clientes_admin-<?= $cliente['cpf'] ?>"
                                                    name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required
                                                    minlength="4"> <!--nome usuario no value-->
                                            </div>
                                            <div class="form-editar-clientes-adm-group">
                                                <label for="cpf">CPF:</label>
                                                <input class="cpf-cliente-editar" type="text" name="cpf"
                                                    id="cpf_editar_clientes_admin-<?= $cliente['cpf'] ?>"
                                                    value="<?= htmlspecialchars($cliente['cpf']) ?>" disabled>
                                                <!--cpf usuario no value-->
                                            </div>
                                        </div>
                                        <div class="form-editar-clientes-adm-row">
                                            <div class="form-editar-clientes-adm-group">
                                                <label for="nome">Email:</label>
                                                <input type="text" name="email"
                                                    id="email_editar_clientes_admin-<?= $cliente['email'] ?>"
                                                    value="<?= htmlspecialchars($cliente['email']) ?>"
                                                    pattern="[^@\s]+@[^@\s]+\.[^@\s]+" minlength="5" required>
                                                <!--email usuario no value-->
                                            </div>
                                            <div class="form-editar-clientes-adm-group">
                                                <label for="turma">Turma:</label>
                                                <select id="turma_editar_clientes_admin-<?= $cliente['turma'] ?>" name="turma"
                                                    class="form-control" required>
                                                    <option value="1DS" <?= $cliente['turma'] == "1DS" ? 'selected' : '' ?>> 1DS
                                                    </option>
                                                    <option value="2DS" <?= $cliente['turma'] == "2DS" ? 'selected' : '' ?>> 2DS
                                                    </option>
                                                    <option value="3DS" <?= $cliente['turma'] == "3DS" ? 'selected' : '' ?>>3DS
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-editar-clientes-adm-row-btn">
                                            <div class="form-editar-clientes-adm-group-btn">
                                                <button class="btn-editar-clientes-adm-cancelar">
                                                    Cancelar
                                                </button>
                                                <button type="submit">
                                                    Salvar Alterações
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        <?php
            }
        }
        ?>


        <script>
            //abrir modal editar cliente
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.editar-cliente-adm').forEach(button => {
                    button.addEventListener('click', () => {
                        const clienteId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlayEditarCliente-${clienteId}`);
                        const modal = document.getElementById(`modalEditarCliente-${clienteId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });
            });

            //Fechar modal no X
            document.querySelectorAll('.btn-fechar-modal-editar-cliente').forEach(button => {
                button.addEventListener('click', () => {
                    const clienteId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlayEditarCliente-${clienteId}`);
                    const modal = document.getElementById(`modalEditarCliente-${clienteId}`);
                    if (overlay && modal) {
                        overlay.classList.remove('active');
                        modal.classList.remove('active');
                    }
                });
            });

            document.querySelectorAll('.btn-close-modal-editar-admin, .form-editar-adm-btn-cancelar').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal-editar-admin');
                    if (modal) {
                        modal.classList.remove('active');
                        const admId = modal.id.replace('modaladm-', '');
                        const overlay = document.getElementById(`overlayEditarAdmin-${admId}`);
                        if (overlay) overlay.classList.remove('active');
                    }
                });
            });
        </script>


        <!--Modal excluir cliente adm-->
        <?php
        $query = "SELECT * from cliente";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $cliente) {
        ?>
                <div class="modal-overlay-excluir-cliente-adm" id="overlay-deletar-cliente-<?= $cliente['cpf'] ?>"
                    data-id="<?= $cliente['cpf'] ?>">
                    <div class="modal-excluir-cliente-adm" id="modal-deletar-cliente-<?= $cliente['cpf'] ?>"
                        data-id="<?= $cliente['cpf'] ?>">
                        <div class="modal-excluir-cliente-adm-top">
                            <h1>Tem certeza?</h1>
                            <p>
                                Esta ação não pode ser desfeita. A conta do cliente "<?php echo $cliente['nome'] ?>",
                                de CPF "<?php echo $cliente['cpf'] ?>" será deletada permanentemente.
                            </p>
                        </div>
                        <div class="modal-excluir-cliente-adm-bottom">
                            <form action="/cantinarepositorio/subpages/deletar_cliente.php" method="POST">
                                <input type="hidden" name="cpf" value="<?= $cliente['cpf'] ?>">
                                <button type="submit" class="btn-confirmar-deletar-cliente">Excluir</button>
                                <button type="button" class="btn-cancelar-deletar-cliente"
                                    data-id="<?= $cliente['cpf'] ?>">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>

        <script>
            //Abrir modal excluir cliente
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.deletar-cliente-adm').forEach(button => {
                    button.addEventListener('click', () => {
                        const clienteId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay-deletar-cliente-${clienteId}`);
                        const modal = document.getElementById(`modal-deletar-cliente-${clienteId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });

                document.querySelectorAll('.btn-cancelar-deletar-cliente').forEach(button => {
                    button.addEventListener('click', () => {
                        const clienteId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay-deletar-cliente-${clienteId}`);
                        const modal = document.getElementById(`modal-deletar-cliente-${clienteId}`);
                        if (overlay && modal) {
                            overlay.classList.remove('active');
                            modal.classList.remove('active');
                        }
                    });
                });
            });
        </script>

        <div class="container-pedidos" id="conteudo-pedidos">
            <div class="title-pedidos">
                <div class="title-pedidos-text">
                    <h1>Gerenciar Pedidos</h1>
                    <p>Controle e organize os pedidos de seus clientes.</p>
                </div>
            </div>
            <div class="content-pedidos">
                <div class="content-pedidos-top">
                    <div class="cards-pedidos-stats">
                        <div class="title-pedidos-cards-stats">
                            <div class="title-pedidos-cards-stats-text">
                                <h1>Pedidos de hoje:</h1>
                            </div>
                            <div class="cards-pedidos-stats-icon">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                        </div>
                        <div class="cards-pedidos-number-stats">
                            <h1>23</h1>
                        </div>
                    </div>
                    <div class="cards-pedidos-stats" id="cards-pedidos-pendentes">
                        <div class="title-pedidos-cards-stats">
                            <div class="title-pedidos-cards-stats-text">
                                <h1>Pedidos pendentes:</h1>
                            </div>
                            <div class="cards-pedidos-stats-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                        </div>
                        <div class="cards-pedidos-number-stats">
                            <h1>23</h1>
                        </div>
                    </div>
                    <div class="cards-pedidos-stats" id="cards-pedidos-faturamento">
                        <div class="title-pedidos-cards-stats">
                            <div class="title-pedidos-cards-stats-text">
                                <h1>Faturamento hoje:</h1>
                            </div>
                            <div class="cards-pedidos-stats-icon">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                        </div>
                        <div class="cards-pedidos-number-stats">
                            <h1>R$ 1256,00</h1>
                        </div>
                    </div>
                </div>

                <div class="content-pedidos-bottom">
                    <div class="pedidos-options">
                        <div class="pedidos-options-days">
                            <button class="btn-pedidos-todos active">
                                Todos
                            </button>
                            <button class="btn-pedidos-hoje">
                                Hoje
                            </button>
                            <button class="btn-pedidos-passados">
                                Passados
                            </button>
                            <button class="btn-pedidos-futuros">
                                Futuros
                            </button>
                        </div>
                    </div>
                    <div class="table-pedidos-todos"> <!--display flex-->
                        <table>
                            <thead>
                                <tr>
                                    <td>Pedido:</td>
                                    <td>CPF Cliente:</td>
                                    <td>Itens:</td>
                                    <td>Total:</td>
                                    <td>Data:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody> <!--lista de pedidos-->
                                <?php
                                $query = "SELECT * from pedido";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $pedido) {
                                ?>
                                        <tr>
                                            <td>
                                                <h6># <?php echo $pedido['id']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['cpf']; ?></h6>
                                            </td>
                                            <td><span><?php echo $pedido['quantidade_itens']; ?></span></td>
                                            <td>
                                                <h6>R$ <?php echo $pedido['preco_total']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['data_pedido']; ?></h6>
                                            </td>
                                            <td><strong><?php echo $pedido['status']; ?></strong></td>
                                            <td style="display: flex; gap:1vh;">
                                                <button class="btn-pedido-concluido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                </button>
                                                <button class="btn-visualizar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                <button class="btn-cancelar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabela: Hoje -->
                    <div class="table-pedidos-hoje" style="display:none;">
                        <table>
                            <thead>
                                <tr>
                                    <td>Pedido:</td>
                                    <td>CPF Cliente:</td>
                                    <td>Itens:</td>
                                    <td>Total:</td>
                                    <td>Data:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM pedido WHERE data_pedido = CURDATE()";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $pedido) {
                                ?>
                                        <tr>
                                            <td>
                                                <h6># <?php echo $pedido['id']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['cpf']; ?></h6>
                                            </td>
                                            <td><span><?php echo $pedido['quantidade_itens']; ?></span></td>
                                            <td>
                                                <h6>R$ <?php echo $pedido['preco_total']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['data_pedido']; ?></h6>
                                            </td>
                                            <td><strong><?php echo $pedido['status']; ?></strong></td>
                                            <td style="display: flex; gap:1vh;">
                                                <button class="btn-pedido-concluido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                </button>
                                                <button class="btn-visualizar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                <button class="btn-cancelar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabela: Passados -->
                    <div class="table-pedidos-passados" style="display:none;">
                        <table>
                            <thead>
                                <tr>
                                    <td>Pedido:</td>
                                    <td>CPF Cliente:</td>
                                    <td>Itens:</td>
                                    <td>Total:</td>
                                    <td>Data:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM pedido WHERE data_pedido < CURDATE()";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $pedido) {
                                ?>
                                        <tr>
                                            <td>
                                                <h6># <?php echo $pedido['id']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['cpf']; ?></h6>
                                            </td>
                                            <td><span><?php echo $pedido['quantidade_itens']; ?></span></td>
                                            <td>
                                                <h6>R$ <?php echo $pedido['preco_total']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['data_pedido']; ?></h6>
                                            </td>
                                            <td><strong><?php echo $pedido['status']; ?></strong></td>
                                            <td style="display: flex; gap:1vh;">
                                                <button class="btn-pedido-concluido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                </button>
                                                <button class="btn-visualizar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                <button class="btn-cancelar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabela: Futuros -->
                    <div class="table-pedidos-futuros" style="display:none;">
                        <table>
                            <thead>
                                <tr>
                                    <td>Pedido:</td>
                                    <td>CPF Cliente:</td>
                                    <td>Itens:</td>
                                    <td>Total:</td>
                                    <td>Data:</td>
                                    <td>Status:</td>
                                    <td>Ações:</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM pedido WHERE data_pedido > CURDATE()";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $pedido) {
                                ?>
                                        <tr>
                                            <td>
                                                <h6># <?php echo $pedido['id']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['cpf']; ?></h6>
                                            </td>
                                            <td><span><?php echo $pedido['quantidade_itens']; ?></span></td>
                                            <td>
                                                <h6>R$ <?php echo $pedido['preco_total']; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $pedido['data_pedido']; ?></h6>
                                            </td>
                                            <td><strong><?php echo $pedido['status']; ?></strong></td>
                                            <td style="display: flex; gap:1vh;">
                                                <button class="btn-pedido-concluido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                </button>
                                                <button class="btn-visualizar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                <button class="btn-cancelar-pedido-adm" data-id="<?= $pedido['id'] ?>">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--JS QUE ORGANIZA A TABELA-->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                function ordenarTabelaPedidos(tabelaSelector, ordem = "asc") {
                    const tabela = document.querySelector(tabelaSelector);
                    if (!tabela) return;

                    const tbody = tabela.querySelector("tbody");
                    const linhas = Array.from(tbody.querySelectorAll("tr"));

                    linhas.sort((a, b) => {
                        // Pega o número do pedido dentro do primeiro <td>
                        const numA = parseInt(a.querySelector("td h6").textContent.replace("#", "").trim());
                        const numB = parseInt(b.querySelector("td h6").textContent.replace("#", "").trim());

                        if (ordem === "asc") {
                            return numA - numB; // menor para maior
                        } else {
                            return numB - numA; // maior para menor
                        }
                    });

                    // Reinsere as linhas já ordenadas
                    linhas.forEach(linha => tbody.appendChild(linha));
                }

                // 🧩 Chama a função para a tabela principal (pode repetir para outras)
                [".table-pedidos-todos table", ".table-pedidos-hoje table", ".table-pedidos-passados table", ".table-pedidos-futuros table"]
                .forEach(selector => ordenarTabelaPedidos(selector, "desc"));
            });
        </script>

        <!--modal-concluir-pedido-->
        <?php
        $query = "SELECT * from pedido";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $pedido) {
                // Nova consulta para obter informações do cliente
                $cpf_cliente = $pedido['cpf']; // Supondo que o CPF do cliente está armazenado no pedido
                $cliente_query = "SELECT * FROM cliente WHERE cpf = '$cpf_cliente'";
                $cliente_query_run = mysqli_query($con, $cliente_query);
                $cliente = mysqli_fetch_assoc($cliente_query_run); // Obtém os dados do cliente
        ?>

                <div class="modal-overlay-concluir-pedido-adm" id="overlay_concluir_pedido-<?= $pedido['id'] ?>">
                    <div class="modal-concluir-pedido-adm" id="modal_concluir_pedido-<?= $pedido['id'] ?>">
                        <div class="modal-concluir-pedido-adm-top">
                            <h1>Tem certeza?</h1>
                            <p>Esta ação não pode ser desfeita. O Pedido:
                                <span class="concluir-pedido-codigo">"#<?php echo $pedido['id']; ?>"</span>, do(a) cliente:
                                <span class="concluir-pedido-cliente-nome">"<?php echo $cliente['nome']; ?>"</span> será mudado para fase:
                                "Concluído". E o cliente poderá retira-lo na cantina.
                            </p>
                        </div>
                        <div class="modal-concluir-pedido-adm-bottom">
                            <button type="button" class="btn-cancelar-concluir-pedido" data-id="<?= $pedido['id'] ?>">Cancelar</button>

                            <form method="POST" action="/cantinarepositorio/subpages/atualizar_status_pedido.php" style="display:inline;">
                                <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                                <input type="hidden" name="status" value="Concluído">
                                <button type="submit" class="btn-concluir-pedido">Concluir Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            //abrir modal concluir pedido
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.btn-pedido-concluido-adm').forEach(button => {
                    button.addEventListener('click', () => {
                        const pedidoId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay_concluir_pedido-${pedidoId}`);
                        const modal = document.getElementById(`modal_concluir_pedido-${pedidoId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });
            });

            //Fechar modal no X concluir pedido
            document.querySelectorAll('.btn-cancelar-concluir-pedido').forEach(button => {
                button.addEventListener('click', () => {
                    const pedidoId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlay_concluir_pedido-${pedidoId}`);
                    const modal = document.getElementById(`modal_concluir_pedido-${pedidoId}`);
                    if (overlay && modal) {
                        overlay.classList.remove('active');
                        modal.classList.remove('active');
                    }
                });
            });
        </script>

        <!--Modal Cancelar pedido adm-->

        <?php
        $query = "SELECT * from pedido";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $pedido) {
                // Nova consulta para obter informações do cliente
                $cpf_cliente = $pedido['cpf']; // Supondo que o CPF do cliente está armazenado no pedido
                $cliente_query = "SELECT * FROM cliente WHERE cpf = '$cpf_cliente'";
                $cliente_query_run = mysqli_query($con, $cliente_query);
                $cliente = mysqli_fetch_assoc($cliente_query_run); // Obtém os dados do cliente
        ?>

                <div class="modal-overlay-cancelar-pedido-adm" id="overlay_cancelar_pedido-<?= $pedido['id'] ?>">
                    <div class="modal-cancelar-pedido-adm" id="modal_cancelar_pedido-<?= $pedido['id'] ?>">
                        <div class="modal-cancelar-pedido-adm-top">
                            <h1>Tem certeza?</h1>
                            <p>Esta ação não pode ser desfeita. O Pedido:
                                <span class="cancelar-pedido-codigo">"#<?php echo $pedido['id']; ?>"</span>, do(a) cliente:
                                <span class="cancelar-pedido-cliente-nome">"<?php echo $cliente['nome']; ?>"</span> será
                                cancelado.
                            </p>
                        </div>
                        <div class="modal-cancelar-pedido-adm-bottom">
                            <button type="button" class="btn-cancelar-cancelamento-pedido" data-id="<?= $pedido['id'] ?>">Cancelar</button>

                            <form method="POST" action="/cantinarepositorio/subpages/atualizar_status_pedido.php" style="display:inline;">
                                <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                                <input type="hidden" name="status" value="Cancelado">
                                <button type="submit" class="btn-concluir-cancelamento-pedido">Cancelar Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            //abrir modal cancelar pedido
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.btn-cancelar-pedido-adm').forEach(button => {
                    button.addEventListener('click', () => {
                        const pedidoId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay_cancelar_pedido-${pedidoId}`);
                        const modal = document.getElementById(`modal_cancelar_pedido-${pedidoId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });

                //Fechar modal no X visualizar pedido
                document.querySelectorAll('.btn-cancelar-cancelamento-pedido').forEach(button => {
                    button.addEventListener('click', () => {
                        const pedidoId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay_cancelar_pedido-${pedidoId}`);
                        const modal = document.getElementById(`modal_cancelar_pedido-${pedidoId}`);
                        if (overlay && modal) {
                            overlay.classList.remove('active');
                            modal.classList.remove('active');
                        }
                    });
                });
            });
        </script>

        <!--modal visualizar pedido-->
        <?php
        $query = "SELECT * from pedido";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $pedido) {
                // Nova consulta para obter informações do cliente
                $cpf_cliente = $pedido['cpf']; // Supondo que o CPF do cliente está armazenado no pedido
                $cliente_query = "SELECT * FROM cliente WHERE cpf = '$cpf_cliente'";
                $cliente_query_run = mysqli_query($con, $cliente_query);
                $cliente = mysqli_fetch_assoc($cliente_query_run); // Obtém os dados do cliente
        ?>

                <div class="modal-overlay-visualizar-pedido" id="overlay_modal_pedido-<?= $pedido['id'] ?>">
                    <div class="modal-visualizar-pedido" id="modal_pedido-<?= $pedido['id'] ?>">
                        <button class="btn-fechar-modal-visualizar" data-id="<?= $pedido['id'] ?>">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="content-modal-visualizar-pedido">
                            <div class="content-modal-visualizar-top">
                                <div class="content-modal-visualizar-top-title">
                                    <h1>Detalhes do Pedido:</h1>
                                </div>
                                <div class="content-modal-visualizar-top-tagFiltro">
                                    <h6><?php echo $pedido['status']; ?></h6>
                                    <!--php status pedido-->
                                </div>
                            </div>
                            <div class="content-modal-visualizar-mid">
                                <div class="content-modal-visualizar-mid-row">
                                    <div class="content-modal-visualizar-mid-group">
                                        <div class="mid-group-numero-pedido">
                                            <h1>Número do pedido:</h1>
                                            <span># <?php echo $pedido['id']; ?></span>
                                            <!--php number pedido-->
                                        </div>
                                        <div class="mid-group-data-pedido">
                                            <h1>Data:</h1>
                                            <span><?php echo $pedido['data_pedido']; ?></span>
                                            <!--php data pedido-->
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group">
                                        <div class="mid-group-turno-pedido">
                                            <h1>Turno:</h1>
                                            <span>Manhã</span><!--php turno pedido-->
                                        </div>
                                    </div>
                                </div>
                                <div class="content-modal-visualizar-mid-row">
                                    <div class="content-modal-visualizar-mid-group-user">
                                        <div class="mid-group-info-user">
                                            <h1>Informações do Cliente:</h1>
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group-user">
                                        <div class="mid-group-info">
                                            <h1>Nome:</h1>
                                            <span><?php echo $cliente['nome']; ?></span>
                                        </div>
                                        <div class="mid-group-info">
                                            <h1>Turma: </h1>
                                            <span><?php echo $cliente['turma']; ?></span>
                                        </div>
                                        <div class="mid-group-info">
                                            <h1>CPF: </h1>
                                            <span><?php echo $pedido['cpf']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-modal-visualizar-mid-row" style="border: none;">
                                    <div class="content-modal-visualizar-mid-group-pedido" style="margin-bottom: 4vh;">
                                        <div class="mid-group-info-pedido">
                                            <h1>Resumo do pedido:</h1>
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group-pedido">
                                        <div class="mid-group-info-table-pedido">
                                            <div class="tabela-scroll">
                                                <div class="tabela-items-pedido">
                                                    <div class="tabela-items-pedido-produto">
                                                        <h4><?php echo $pedido['nome_itens']; ?></h4><!--nome do produto-->
                                                    </div>
                                                </div>
                                                <div class="tabela-items-pedido">
                                                    <div class="tabela-items-pedido-produto">
                                                        <h3><?php echo $pedido['quantidade_itens']; ?></h3>
                                                        <!--quantidade produto-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-modal-visualizar-bottom">
                                <div class="visualizar-bottom-preco">
                                    <h1>Total:</h1>
                                    <span>R$<?php echo $pedido['preco_total']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>

        <script>
            //abrir modal visualizar pedido
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.btn-visualizar-pedido-adm').forEach(button => {
                    button.addEventListener('click', () => {
                        const pedidoId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlay_modal_pedido-${pedidoId}`);
                        const modal = document.getElementById(`modal_pedido-${pedidoId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });
            });

            //Fechar modal no X visualizar pedido
            document.querySelectorAll('.btn-fechar-modal-visualizar').forEach(button => {
                button.addEventListener('click', () => {
                    const pedidoId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlay_modal_pedido-${pedidoId}`);
                    const modal = document.getElementById(`modal_pedido-${pedidoId}`);
                    if (overlay && modal) {
                        overlay.classList.remove('active');
                        modal.classList.remove('active');
                    }
                });
            });
        </script>


        <!--Configurações do ADM-->
        <div class="container-configuracoes" id="conteudo-configuracoes">
            <div class="title-configuracoes">
                <div class="title-configuracoes-text">
                    <h1>Gerenciar funcionários</h1>
                    <p>Gerencie sua conta e crie novos administradores.</p>
                </div>
            </div>
            <div class="content-configuracoes">
                <div class="content-top-config">
                    <div class="table-admin">
                        <div class="table-admin-title">
                            <div class="table-admin-title-text">
                                <h1>Administradores</h1>
                                <p>Selecione um administrador para editar suas informações ou alterar senha.</p>
                            </div>
                        </div>
                        <div class="table-admins">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nome</td>
                                        <td>Email</td>
                                        <td>CPF</td>
                                        <td>Função</td>
                                        <td>Ações</td>
                                    </tr>
                                </thead>
                                <?php

                                $query = "SELECT * FROM administradores";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $usuario) {

                                ?>
                                        <tr>
                                            <td>
                                                <h6><?php echo $usuario['nome'] ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $usuario['email'] ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo $usuario['cpf'] ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php if ($usuario['adm'] == 1) {
                                                        echo 'Administrador Principal';
                                                    } else {
                                                        echo 'Funcionário';
                                                    } ?></h6>
                                            </td>
                                            <td>
                                                <button class="btn-editar-senha-admin" data-id="<?= $usuario['cpf'] ?>">
                                                    <i class="fa-solid fa-key"></i>
                                                </button>
                                                <button class="btn-editar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-deletar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Form criar novo admin-->
                <div class="content-mid-config">
                    <div class="form-criar-adm">
                        <div class="form-criar-adm-title">
                            <div class="form-criar-adm-title-text">
                                <h1>Criar Novo Administrador</h1>
                                <p>Adicione um novo usuário com permissões de administrador.</p>
                            </div>
                        </div>
                        <div class="form-criar-adm-content">
                            <form method="POST" action="./criar_admin.php" class="form-criar-adiminstrador">
                                <div class="form-criar-adm-row">
                                    <div class="form-criar-adm-group">
                                        <label for="nome">Nome:</label>
                                        <input type="text" name="nome_criar_admin" id="nome_criar_admin"
                                            placeholder="Nome do administrador" required minlength="4">
                                    </div>
                                    <div class="form-criar-adm-group">
                                        <label for="cpf">CPF:</label>
                                        <input type="text" name="cpf" id="cpf_criar_admin"
                                            placeholder="CPF do administrador" required maxlength="11" pattern="\d{11}">
                                    </div>
                                </div>

                                <div class="form-criar-adm-row">
                                    <div class="form-criar-adm-group">
                                        <label for="password">Senha:</label>
                                        <div class="input-wrapper">
                                            <input type="password" name="senha_criar_admin" id="senha_criar_admin"
                                                placeholder="Senha do administrador" minlength="6" required>
                                            <span class="toggle-senha" data-target="senha_criar_admin"><i
                                                    class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-criar-adm-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email_criar_admin" id="email_criar_admin"
                                            placeholder="Email do administrador" required
                                            pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                                    </div>
                                </div>

                                <div class="form-criar-adm-row-btn">
                                    <div class="form-criar-adm-group-btn">
                                        <button type="submit" class="form-criar-adm-btn-mandar">
                                            <i class="fa-solid fa-user-plus"></i>
                                            Criar Administrador
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        // Mostrar / ocultar senha
                        document.querySelectorAll('.toggle-senha').forEach(toggle => {
                            toggle.addEventListener('click', () => {
                                const targetId = toggle.getAttribute('data-target');
                                const input = document.getElementById(targetId);
                                if (input.type === 'password') {
                                    input.type = 'text';
                                    toggle.innerHTML = '<i class="fa-regular fa-eye"></i>';
                                } else {
                                    input.type = 'password';
                                    toggle.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>


        <!--Modal editar info admin-->
        <?php
        $query = "SELECT * from administradores";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $usuario) {
        ?>
                <div class="modal-overlay-editar-admin" id="overlayEditarAdmin-<?= $usuario['cpf'] ?>">
                    <div class="modal-editar-admin" id="modaladm-<?= $usuario['cpf'] ?>">
                        <button class="btn-close-modal-editar-admin">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="form-editar-adm">
                            <div class="form-editar-adm-title">
                                <div class="form-editar-adm-title-text">
                                    <h1>
                                        Informações da Conta
                                    </h1>
                                    <p>
                                        Edite as informações da sua conta de administrador.
                                    </p>
                                </div>
                            </div>
                            <div class="form-editar-adm-content">
                                <form action="/cantinarepositorio/subpages/atualizar_admin.php" method="post"
                                    class="form-editar-administrador">
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <input type="hidden" name="cpfid" value="<?= $usuario['cpf'] ?>" />
                                            <label for="nome">Nome:</label>
                                            <input type="text" name="nome" id="nome_admin_<?= $usuario['cpf'] ?>"
                                                value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                                            <!--TEXT NAME ADMIN CONTA PHP EM VALUE-->
                                        </div>
                                        <div class="form-adm-group">
                                            <label for="CPF">CPF:</label>
                                            <input type="text" name="cpf" id="CPF_admin_<?= $usuario['cpf'] ?>"
                                                value="<?= htmlspecialchars($usuario['cpf']) ?>" disabled>
                                            <i class="fa-solid fa-ban" style="color: #ff0000;"></i>
                                            <!--CPF text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <label for="Email">Email:</label>
                                            <input type="email" name="email" id="Email_admin_<?= $usuario['cpf'] ?>"
                                                value="<?= htmlspecialchars($usuario['email']) ?>" required>
                                            <!--Email text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <label for="funcao">Função</label>
                                        <select id="funcao_<?= $usuario['cpf'] ?>" name="funcao" required>
                                            <option value="1" selected>Administrador Principal</option>
                                            <option value="0">Administrador Secundário</option>
                                        </select><!--TEXT funcao ADMIN CONTA PHP EM VALUE-->
                                    </div>
                                    <div class="form-adm-row-btn">
                                        <div>
                                            <button class="form-editar-adm-btn-cancelar">
                                                Cancelar
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" class="form-editar-adm-btn-mandar">
                                                <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal mudar senha admin -->
                <div class="modal-overlay-senha-admin" id="overlaySenhaAdmin-<?= $usuario['cpf'] ?>">
                    <div class="modal-senha-admin" id="modalSenhaAdmin-<?= $usuario['cpf'] ?>">
                        <button class="btn-close-modal-senha-admin">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="form-senha-adm">
                            <div class="form-senha-adm-title">
                                <div class="form-senha-adm-title-text">
                                    <h1>Alterar Senha - Administrador</h1>
                                    <p>Atualize a senha do administrador selecionado.</p>
                                </div>
                            </div>
                            <div class="form-senha-adm-content">
                                <form action="./alterar_senha_admin.php" method="POST" class="form-senha-administrador"
                                    id="formAlterarSenhaAdmin">
                                    <input type="hidden" name="cpf" value="<?= $usuario['cpf'] ?>" />
                                    <div class="form-senha-adm-row">
                                        <div class="form-senha-adm-group">
                                            <label for="senha_admin">Senha Atual:</label>
                                            <div class="input-wrapper">
                                                <input type="password" name="senha_atual"
                                                    id="senha_admin_<?= $usuario['cpf'] ?>" required inputmode="none">
                                                <span class="toggle-senha" data-target="senha_admin"><i
                                                        class="fa-regular fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-senha-adm-row">
                                        <div class="form-senha-adm-group">
                                            <label for="senha_admin_nova">Nova senha:</label>
                                            <div class="input-wrapper">
                                                <input type="password" name="nova_senha"
                                                    id="senha_admin_nova_<?= $usuario['cpf'] ?>" required minlength="6"
                                                    inputmode="none">
                                                <span class="toggle-senha" data-target="senha_admin_nova"><i
                                                        class="fa-regular fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-senha-adm-group">
                                            <label for="senha_admin_nova_confirmacao">Confirmar Nova Senha:</label>
                                            <div class="input-wrapper">
                                                <input type="password" name="confirmar_senha"
                                                    id="senha_admin_nova_confirmacao_<?= $usuario['cpf'] ?>" required
                                                    inputmode="none">
                                                <span class="toggle-senha" data-target="senha_admin_nova_confirmacao"><i
                                                        class="fa-regular fa-eye-slash"></i></span>
                                            </div>
                                            <div class="erro-senha" id="erroSenhaAdmin">As senhas não coincidem.</div>
                                        </div>
                                    </div>

                                    <div class="form-senha-adm-row-btn">
                                        <div class="form-senha-adm-group-btn">
                                            <button class="btn-cancelar-nova-senha-admin">Cancelar</button>
                                            <button type="submit" class="btn-mudar-senha-admin" disabled>Alterar Senha</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            //abrir modal editar admin
            document.querySelectorAll('.btn-editar-admin').forEach((button) => {
                button.addEventListener('click', () => {
                    const admId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlayEditarAdmin-${admId}`);
                    const modal = document.getElementById(`modaladm-${admId}`);
                    if (overlay && modal) {
                        overlay.classList.add('active');
                        modal.classList.add('active');
                    }
                });
            });

            document.querySelectorAll('.btn-close-modal-editar-admin, .form-editar-adm-btn-cancelar').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal-editar-admin');
                    if (modal) {
                        modal.classList.remove('active');
                        const admId = modal.id.replace('modaladm-', '');
                        const overlay = document.getElementById(`overlayEditarAdmin-${admId}`);
                        if (overlay) overlay.classList.remove('active');
                    }
                });
            });


            // Fechar modal de senha do admin (botão X e Cancelar)
            document.querySelectorAll('.btn-close-modal-senha-admin, .btn-cancelar-nova-senha-admin').forEach(btn => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal-senha-admin');
                    if (modal) {
                        modal.classList.remove('active');
                        const admId = modal.id.replace('modalSenhaAdmin-', '');
                        const overlay = document.getElementById(`overlaySenhaAdmin-${admId}`);
                        if (overlay) overlay.classList.remove('active');
                    }
                });
            });
            //Senha do admin

            //Atualizar Icone olhinho
            function atualizarIcone(inp, span) {
                if (inp.type === 'password') {
                    span.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
                } else {
                    span.innerHTML = '<i class="fa-regular fa-eye"></i>';
                }
            }

            // Abrir modal de senha do admin
            document.querySelectorAll('.btn-editar-senha-admin').forEach(button => {
                button.addEventListener('click', () => {
                    const admId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlaySenhaAdmin-${admId}`);
                    const modal = document.getElementById(`modalSenhaAdmin-${admId}`);
                    if (overlay && modal) {
                        overlay.classList.add('active');
                        modal.classList.add('active');
                    }

                    // Seleciona os inputs do modal correspondente
                    const form = modal.querySelector('.form-senha-administrador');
                    const senhaAtual = modal.querySelector(`#senha_admin_${admId}`);
                    const novaSenha = modal.querySelector(`#senha_admin_nova_${admId}`);
                    const confirmarSenha = modal.querySelector(`#senha_admin_nova_confirmacao_${admId}`);
                    const erroSenha = modal.querySelector('#erroSenhaAdmin');
                    const btnAlterar = modal.querySelector('.btn-mudar-senha-admin');
                    const campos = [senhaAtual, novaSenha, confirmarSenha];

                    // Toggle de senha (olhinho)
                    modal.querySelectorAll('.toggle-senha').forEach(span => {
                        const inp = modal.querySelector(`#${span.dataset.target}_${admId}`);
                        atualizarIcone(inp, span);
                        span.addEventListener('click', (e) => {
                            e.preventDefault();
                            inp.type = (inp.type === 'password') ? 'text' : 'password';
                            atualizarIcone(inp, span);
                        });
                    });

                    // Validação de senha
                    campos.forEach(campo => {
                        campo.addEventListener('input', () => {
                            const todasPreenchidas = campos.every(c => c.value.trim() !== '');
                            const senhasIguais = novaSenha.value === confirmarSenha.value;
                            if (!senhasIguais && confirmarSenha.value.length > 0) {
                                erroSenha.style.display = 'block';
                            } else {
                                erroSenha.style.display = 'none';
                            }
                            btnAlterar.disabled = !(todasPreenchidas && senhasIguais);
                        });
                    });
                });
            });
        </script>


        <!--Modal deletar admin -->
        <div class="modal-overlay-deletar-admin" id="overlayExcluirAdmin">
            <div class="modal-deletar-admin" id="modalExcluirAdmin">
                <div class="modal-deletar-admin-top">
                    <h1>Tem certeza?</h1>
                    <p>
                        Esta ação não pode ser desfeita. A conta Administrador
                        "<span class="deletar-admin-nome"></span>",
                        de CPF "<span class="deletar-admin-cpf"></span>" será deletada para sempre.
                    </p>
                </div>
                <div class="modal-deletar-admin-bottom">
                    <button type="button" class="btn-cancelar-deletar-admin">Cancelar</button>
                    <button type="button" class="btn-confirmar-deletar-admin">Excluir</button>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalOverlay = document.getElementById('overlayExcluirAdmin');
                const modal = document.getElementById('modalExcluirAdmin');
                const btnAbrirModal = document.querySelectorAll('.btn-deletar-admin'); // botões na tabela
                const btnCancelar = modal.querySelector('.btn-cancelar-deletar-admin');
                const btnConfirmar = modal.querySelector('.btn-confirmar-deletar-admin');
                const nomeSpan = modal.querySelector('.deletar-admin-nome');
                const cpfSpan = modal.querySelector('.deletar-admin-cpf');

                // abre modal e preenche dados
                btnAbrirModal.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const cpf = btn.getAttribute('data-id');
                        // tenta extrair nome a partir da linha da tabela
                        let nome = '';
                        const row = btn.closest('tr');
                        if (row) {
                            const nomeCell = row.querySelector('td h6') || row.querySelector('td:first-child h6');
                            if (nomeCell) nome = nomeCell.textContent.trim();
                        }
                        nomeSpan.textContent = nome || '—';
                        cpfSpan.textContent = cpf;
                        btnConfirmar.setAttribute('data-cpf', cpf);

                        modalOverlay.classList.add('active');
                        modal.classList.add('active');
                    });
                });

                // cancelar
                btnCancelar.addEventListener('click', () => {
                    modal.classList.remove('active');
                    modalOverlay.classList.remove('active');
                });

                // confirmar exclusão
                btnConfirmar.addEventListener('click', () => {
                    const cpf = btnConfirmar.getAttribute('data-cpf');
                    if (!cpf) return;

                    btnConfirmar.disabled = true;
                    fetch('/cantinarepositorio/subpages/deletar_admin.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'cpf=' + encodeURIComponent(cpf)
                        })
                        .then(r => r.json())
                        .then(res => {
                            btnConfirmar.disabled = false;
                            if (res.success) {
                                modal.classList.remove('active');
                                modalOverlay.classList.remove('active');
                                if (res.logout) {
                                    // redireciona para página pública (logout)
                                    window.location.href = '/cantinarepositorio/main/index.php';
                                } else {
                                    location.reload();
                                }
                            } else {
                                alert(res.message || 'Erro ao deletar administrador');
                            }
                        })
                        .catch(() => {
                            btnConfirmar.disabled = false;
                            alert('Erro de rede ao deletar administrador');
                        });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Torna o botão inteiro clicável quando há um <a> dentro dele
                document.querySelectorAll('button').forEach(btn => {
                    const a = btn.querySelector('a[href]');
                    if (!a) return;
                    // evita comportamento padrão do <a> quando clicado apenas no texto
                    a.style.pointerEvents = 'none';
                    // adiciona redirecionamento ao botão inteiro
                    btn.addEventListener('click', (e) => {
                        // permite que botões tipo "submit" continuem funcionando em formulários
                        if (btn.type && btn.type.toLowerCase() === 'submit') return;
                        const href = a.getAttribute('href');
                        if (!href) return;
                        window.location.href = href;
                    });
                });
            });
        </script>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="./assets/js/pageAdmin/estoque.js"></script>
</body>

</html>