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
$query_low = "SELECT * from estoque WHERE quantidade < 1";
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
                        <i class="fa-solid fa-outdent"></i>
                    </div>
                </div>
                <div class="nav-items">
                    <ul>
                        <li>
                            <h1>
                                <a href="#inicio" style="text-decoration: none; color: inherit;">Página de Gerenciamento do Admin</a>
                            </h1>
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons" style="gap:3vh;">
                    <div class="btn-user" id="btn-user-nav">
                        <button>
                            <i class="fa-regular fa-user"></i> Perfil
                        </button>
                    </div>
                </div>
        </nav>
    </header>

    <!--POPUP DO USER-->

    <div class="pop-up-user" id="pop-up-user">
        <div class="btn-pp-close" id="btn-close-user-nav">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="content-pp-user">
            <div class="content-pp-top">
                <div class="top-circle-info-user">
                    <div class="top-circle-info-img">
                        <img src="" alt="">
                    </div>
                    <div class="top-circle-info-text">
                        <h6>
                            <?php echo $user_data['nome']; ?>
                        </h6>
                        <p>
                            <?php echo $user_data['email']; ?>
                        </p>
                    </div>
                </div>
                <div class="top-info-user">
                    <div class="top-info-user-text">
                        <p>
                            CPF: <?php echo $user_data['cpf']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="content-pp-bottom">
                <a href="/cantinarepositorio/subpages/logout.php">Logout</a>
            </div>
        </div>
    </div>
    </header>
    <div class="aside-options">
        <div class="aside-top">
            <div class="btn-close-aside">
                <i class="fa-solid fa-outdent"></i>
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

    <main>
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
                                                <button class="btn-editar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-deletar-item" data-id="<?= $item['id'] ?>" >
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
                                                <button class="btn-editar-item">
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
                                                <button class="btn-editar-item">
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
                                                <button class="btn-editar-item">
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
                                                <button class="btn-editar-item">
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
                                                <button class="btn-editar-item">
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
                                                <button class="btn-editar-item">
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

        <?php //Modal Cardapio
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
            foreach($query_run as $item) {
        ?>
            
            <div class="modal-estoque-deletar-item" id="modal-deletar-item-<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
            <div class="modal-deletar-content-top">
                <h1>Tem certeza?</h1>
                <p>Esta ação não pode ser desfeita. O produto "Esfiha de Carne" será permanentemente removido do estoque.</p>
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
              // modal deletar estoque button
        document.querySelectorAll('.activeButtonExcluir').forEach(button => {
            button.addEventListener('click', () => {
                const produtoId = button.getAttribute('data-id');
                console.log('ID enviado:', produtoId);
                fetch('/cantinarepositorio/subpages/delete_item.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
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
                <h1>Gerenciar funcionários</h1>
            </div>
            <div class="content-configuracoes">

            </div>
        </div>
    </main>



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
                            style="display: none;">&times;</button>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="./assets/js/estoque.js"></script>
</body>

</html