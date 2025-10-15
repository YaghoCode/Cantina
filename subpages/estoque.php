<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();


if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
    $query = "SELECT nome, admin, cpf, turma, email FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    if ($result && mysqli_num_rows($result) > 0) {
        if ($user_data['admin'] != 1) {
            header("Location: ./cardapio.php");
            exit;
        }
    } else {
        header("Location: ./login.php");
        exit;
    }
}


$query = "SELECT * from estoque";
$query_run = mysqli_query($con, $query);
$total_products = mysqli_num_rows($query_run);
$query_low = "SELECT * from estoque WHERE quantidade < 5";
$low_products_count = mysqli_num_rows($low_products = mysqli_query($con, $query_low));
$query_total_value = "SELECT SUM(preco * quantidade) AS total_value FROM estoque";
$total_value_result = mysqli_query($con, $query_total_value);
$total_value_row = mysqli_fetch_assoc($total_value_result);
$total_value_result = 'R$ ' . number_format($total_value_row['total_value'], 2, ',', '.');
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
    <link rel="stylesheet" type="text/css" href="./assets/css/estoque.css">
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
                        <button>
                            <a href="/cantinarepositorio/main/index.php"><i class="fa-solid fa-caret-left"></i>Home</a>
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
                                    <?php echo $user_data['email'] ?>
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
                                    <?php echo $user_data['cpf'] ?>
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
                                    Administrador Principal
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-bottom-user">
                    <div class="content-bottom-user-row">
                        <button class="btn-logout-pop-up">
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
                        <li id="btn-configuracoes"><i class="fa-solid fa-gear"></i> Configurações</li>
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
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-novo-produto" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titulo">Título do Produto:</label>
                                <input type="text" id="titulo" name="nome-produto" class="form-control" placeholder="Digite o título do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição do Produto:</label>
                                <input type="text" id="descricao" name="descricao-produto" class="form-control" placeholder="Digite a descrição do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="number" id="preco" name="preco-produto" class="form-control" placeholder="Digite o preço do produto" step="0.01" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" id="quantidade" name="quantidade-produto" class="form-control" placeholder="Digite a quantidade disponível" min="0" required>
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
                                <button type="submit" name="cadastrar-produto" class="btn btn-primary">Criar Produto</button>
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
                            <button id="btn-remove-preview" class="btn-remove-preview"
                                style="display: none;">
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
                    <div class="cards-estoque-stats">
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
                    <div class="cards-estoque-stats">
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
                        <button id="dropdownButton" class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-2" aria-hidden="true"></i>
                            <span id="dropdownLabel">Todos os Produtos</span>
                        </button>

                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><a class="dropdown-item active" id="btn-all-produtos" href="#" data-value="all">Todos os Produtos</a></li>
                            <li><a class="dropdown-item" id="btn-low-produtos" href="#" data-value="low">Estoque Baixo</a></li>
                            <li><a class="dropdown-item" id="btn-salgados-produtos" href="#" data-value="snacks">Salgados</a></li>
                            <li><a class="dropdown-item" id="btn-folhados-produtos" href="#" data-value="snacks2">Folhados</a></li>
                            <li><a class="dropdown-item" id="btn-doces-produtos" href="#" data-value="sweets">Doces</a></li>
                            <li><a class="dropdown-item" id="btn-bebidas-produtos" href="#" data-value="drinks">Bebidas</a></li>
                            <li><a class="dropdown-item" id="btn-outros-produtos" href="#" data-value="others">Outros</a></li>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                                <h6>R$: <?php echo $item['preco']; ?></h6>
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
                                <button class="btn-close-modal-estoque" id="btn-close-modal-estoque"><i class="fa-solid fa-xmark"></i></button>
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

                <div class="modal-estoque-deletar-item" id="modal-deletar-item-<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                    <div class="modal-deletar-content-top">
                        <h1>Tem certeza?</h1>
                        <p>Esta ação não pode ser desfeita. O produto "<?php echo $item['Nome'] ?>" será permanentemente removido do estoque.</p>
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
                    const modalOverlayGeral = document.querySelector('.modal-overlay-geral');

                    if (modalDeletar) {
                        modalDeletar.style.display = 'flex';
                        modalOverlayGeral.classList.add('active');
                    }
                });
            });


            btnCancelarExcluir.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal-estoque-deletar-item');
                    const modalOverlayGeral = document.querySelector('.modal-overlay-geral');
                    if (modal) {
                        modal.style.display = 'none';
                        modalOverlayGeral.classList.remove('active');
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
                        .then(data => {
                            if (data.success) {
                                alert('Produto removido!');
                                location.reload();
                            } else {
                                alert('Erro ao remover produto!');
                            }
                        });
                });
            });
        </script>




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
                        <button type="button" class="btn-fechar-editar" data-id="<?= $item['id'] ?>" title="Fechar modal"><i class="fa-solid fa-xmark"></i></button>
                        <h2 class="editar-produto-titulo">Editar Produto:</h2>
                        <form id="formEditarProduto-<?= $item['id'] ?>" method="POST" action="atualizar_item.php" enctype="multipart/form-data">
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
                            <div class="editar-produto-upload" id="editarProdutoUpload-<?= $item['id'] ?>" style="display: none;">
                                <div class="upload-container">
                                    <label for="inputNovaImagem-<?= $item['id'] ?>" class="upload-label">
                                        <i class="fa-solid fa-upload"></i> Escolher Imagem
                                    </label>
                                    <span class="upload-nome" id="uploadNome-<?= $item['id'] ?>">Nenhum arquivo selecionado</span>
                                    <input type="file" id="inputNovaImagem-<?= $item['id'] ?>" name="nova_imagem" accept="image/*">
                                </div>

                                <div class="" id="previewContainer-<?= $item['id'] ?>" style="margin-top:10px; display:none;justify-content:center;align-items:center;">
                                    <img id="editarProdutoPreviewImg-<?= $item['id'] ?>" src="" alt="Prévia da nova imagem" style="width:25%; border-radius:8px; object-fit:cover;margin-top:1vh;">
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
                                        <option value="Salgados" <?= $item['Categoria'] == "Salgados" ? 'selected' : '' ?>>Salgados</option>
                                        <option value="Folhados" <?= $item['Categoria'] == "Folhados" ? 'selected' : '' ?>>Folhados</option>
                                        <option value="Doces" <?= $item['Categoria'] == "Doces" ? 'selected' : '' ?>>Doces</option>
                                        <option value="Bebidas" <?= $item['Categoria'] == "Bebidas" ? 'selected' : '' ?>>Bebidas</option>
                                        <option value="Outros" <?= $item['Categoria'] == "Outros" ? 'selected' : '' ?>>Outros</option>
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
                                    <input type="number" name="quantidade" min="0" value="<?= $item['Quantidade'] ?>" required />
                                </div>
                                <div class="input-grupo">
                                    <label>Preço *</label>
                                    <input type="number" step="0.01" name="preco" min="0.1" value="<?= $item['preco'] ?>" required />
                                </div>
                            </div>
                            <div class="input-grupo-btn">
                                <button type="button" class="btn-cancelar-editar" data-id="<?= $item['id'] ?>">Cancelar</button>
                                <button type="submit" class="btn-salvar-editar"><i class="fa-solid fa-floppy-disk"></i> Salvar Alterações</button>
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



        <!--Paginas com display none-->
        <div class="container-clientes" id="conteudo-clientes">
            <div class="title-clientes">
                <h1>Gerenciar Clientes</h1>
            </div>
            <div class="content-clientes">

            </div>
        </div>

        <div class="container-pedidos" id="conteudo-pedidos">
            <div class="title-pedidos">
                <h1>Gerenciar pedidos</h1>
            </div>
            <div class="content-pedidos">

            </div>
        </div>

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
                                        <td>Telefone</td>
                                        <td>Função</td>
                                        <td>Ações</td>
                                    </tr>
                                </thead>
                                <?php

                                $query = "SELECT * FROM cliente WHERE admin = 1";
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
                                                <h6><?php if ($usuario['adminplus'] == 1) {
                                                        echo 'Administrador Principal';
                                                    } else {
                                                        echo 'Adminstrador';
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
                <div class="content-mid-config">
                    <div class="form-criar-adm">
                        <div class="form-criar-adm-title">
                            <div class="form-criar-adm-title-text">
                                <h1>Criar Novo Administrador</h1>
                                <p>Adicione um novo usuário com permissões de administrador.</p>
                            </div>
                        </div>
                        <div class="form-criar-adm-content">
                            <form action="" class="form-criar-adiminstrador">
                                <div class="form-criar-adm-row">
                                    <div class="form-criar-adm-group">
                                        <label for="nome">Nome:</label>
                                        <input type="text" id="nome_criar_admin" placeholder="Nome do administrador" required>
                                    </div>
                                    <div class="form-criar-adm-group">
                                        <label for="cpf">CPF:</label>
                                        <input type="text" id="cpf_criar_admin" placeholder="CPF do administrador" required>
                                    </div>
                                </div>
                                <div class="form-criar-adm-row">
                                    <div class="form-criar-adm-group">
                                        <label for="password">CPF:</label>
                                        <input type="password" id="senha_criar_admin" placeholder="Senha do administrador" required>
                                    </div>
                                    <div class="form-criar-adm-group">
                                        <label for="email">Email:</label>
                                        <input type="text" id="email_criar_admin" placeholder="Email do administrador" required>
                                    </div>
                                </div>
                                <div class="form-criar-adm-row-btn">
                                    <div class="form-criar-adm-group-btn">
                                        <button>
                                            <i class="fa-solid fa-user-plus"></i>
                                            Criar Administrador
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay-editar-admin">
            <!--Modal editar info admin-->
            <?php
            $query = "SELECT * from cliente";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $usuario) {
            ?>
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
                                <form action="" class="form-editar-administrador">
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <label for="nome">Nome:</label>
                                            <input type="text" id="nome_admin" value="<?php $usuario['nome'] ?>" required> <!--TEXT NAME ADMIN CONTA PHP EM VALUE-->
                                        </div>
                                        <div class="form-adm-group">
                                            <label for="CPF">CPF:</label>
                                            <input type="CPF" id="CPF_admin" value="55132867832" disabled><i class="fa-solid fa-ban" style="color: #ff0000;"></i> <!--CPF text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <label for="telefone">Telefone:</label>
                                            <input type="text" id="telefone_admin" value="(11) 99999-9999" required> <!--TEXT telefone ADMIN CONTA PHP EM VALUE-->
                                        </div>
                                        <div class="form-adm-group">
                                            <label for="Email">Email:</label>
                                            <input type="Email" id="Email_admin" value="admin@gmail.com" required> <!--Email text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <label for="funcao">Função</label>
                                        <select id="funcao" name="funcao" required>
                                            <option value="Administrador Principal" selected>Administrador Principal</option>
                                            <option value="Administrador Secundário">Administrador Secundário</option>
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
<?php
                }
            }
?>

<script>
    //abrir modal editar admin
    document.addEventListener('DOMContentLoaded', () => {

        const overlayEditarAdmin = document.querySelector('.modal-overlay-editar-admin');
        const btnEditarAdmin = document.querySelectorAll('.btn-editar-admin');
        const btnCloseEditarAdmin = document.querySelectorAll('.btn-close-modal-editar-admin');
        const btnCancelarEditarAdmin = document.querySelectorAll('.form-editar-adm-btn-cancelar');

        document.querySelectorAll('.btn-editar-admin').forEach((button) => {
            button.addEventListener('click', () => {
                const admId = button.getAttribute('data-id')
                const modal = document.getElementById(`modaladm-${admId}`);
                if (modal) {
                    modal.classList.add('active');
                    overlayEditarAdmin.classList.add('active');
                    console.log(modal, admId);
                }
            })
        });

        btnCloseEditarAdmin.forEach((btn6) => {
            btn6.addEventListener('click', () => {
                modalEditarAdmin.classList.remove('active');
                overlayEditarAdmin.classList.remove('active');
            })
        });

        btnCancelarEditarAdmin.forEach((btn7) => {
            btn7.addEventListener('click', () => {
                modalEditarAdmin.classList.remove('active');
                overlayEditarAdmin.classList.remove('active');
            })
        });
    });
</script>

<!-- Modal mudar senha admin -->
<div class="modal-overlay-senha-admin">
    <div class="modal-senha-admin">
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
                <form action="" class="form-senha-administrador" id="formAlterarSenhaAdmin">
                    <div class="form-senha-adm-row">
                        <div class="form-senha-adm-group">
                            <label for="senha_admin">Senha Atual:</label>
                            <div class="input-wrapper">
                                <input type="password" id="senha_admin" required>
                                <span class="toggle-senha" data-target="senha_admin"><i class="fa-regular fa-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-senha-adm-row">
                        <div class="form-senha-adm-group">
                            <label for="senha_admin_nova">Nova senha:</label>
                            <div class="input-wrapper">
                                <input type="password" id="senha_admin_nova" required minlength="6">
                                <span class="toggle-senha" data-target="senha_admin_nova"><i class="fa-regular fa-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="form-senha-adm-group">
                            <label for="senha_admin_nova_confirmacao">Confirmar Nova Senha:</label>
                            <div class="input-wrapper">
                                <input type="password" id="senha_admin_nova_confirmacao" required>
                                <span class="toggle-senha" data-target="senha_admin_nova_confirmacao"><i class="fa-regular fa-eye-slash"></i></span>
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
<script>
    const modalSenhaAdmin = document.querySelector('.modal-senha-admin');
    const overlaySenhaAdmin = document.querySelector('.modal-overlay-senha-admin');
    const btnSenhaAdmin = document.querySelectorAll('.btn-editar-senha-admin');
    const btnCloseSenhaAdmin = document.querySelectorAll('.btn-close-modal-senha-admin');
    const btnCancelarSenhaAdmin = document.querySelectorAll('.btn-cancelar-nova-senha-admin');

    btnSenhaAdmin.forEach((btn8) => {
        btn8.addEventListener('click', () => {
            modalSenhaAdmin.classList.add('active');
            overlaySenhaAdmin.classList.add('active');
        });
    });

    [...btnCloseSenhaAdmin, ...btnCancelarSenhaAdmin].forEach(btn => {
        btn.addEventListener('click', () => {
            // Fecha o modal
            modalSenhaAdmin.classList.remove('active');
            overlaySenhaAdmin.classList.remove('active');

            // Se for o botão "Cancelar", recarrega a página
            if (btn.classList.contains('btn-cancelar-nova-senha-admin')) {
                window.location.reload(); // 🔄 Recarrega a página
            }
        });
    });

    const form = document.getElementById('formAlterarSenhaAdmin');
    const senhaAtual = document.getElementById('senha_admin');
    const novaSenha = document.getElementById('senha_admin_nova');
    const confirmarSenha = document.getElementById('senha_admin_nova_confirmacao');
    const erroSenha = document.getElementById('erroSenhaAdmin');
    const btnAlterar = document.querySelector('.btn-mudar-senha-admin');
    const campos = [senhaAtual, novaSenha, confirmarSenha];

    document.querySelectorAll('.toggle-senha').forEach(span => {
        const inp = document.getElementById(span.dataset.target);

        // Função que mantém o ícone sincronizado com o estado do input
        const atualizarIcone = () => {
            if (inp.type === 'password') {
                span.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                span.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        };

        // Inicializa o ícone corretamente
        atualizarIcone();

        // Clique no ícone alterna o tipo e atualiza
        span.addEventListener('click', (e) => {
            e.preventDefault();
            const currentSpan = e.currentTarget;
            const targetInput = document.getElementById(currentSpan.dataset.target);

            // Alterna tipo
            targetInput.type = (targetInput.type === 'password') ? 'text' : 'password';
            atualizarIcone();
        });
    });

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
</script>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="./assets/js/estoque.js"></script>
</body>

</html>