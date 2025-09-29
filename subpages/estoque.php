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
                            Caiopicciarelli <!--<php echo $user_data['nome']; ?>-->
                        </h6>
                        <p>
                            Caio@gmail.com <!--<php echo $user_data['email']; ?>-->
                        </p>
                    </div>
                </div>
                <div class="top-info-user">
                    <div class="top-info-user-text">
                        <h6>
                            Turma: 3DS <!--<php echo $user_data['turma']; ?>-->
                        </h6>
                        <p>
                            CPF: 999999999 <!--<php echo $user_data['cpf']; ?>-->
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
                            <li><a class="dropdown-item active" href="#" data-value="all">Todos os Produtos</a></li>
                            <li><a class="dropdown-item" href="#" data-value="low">Estoque Baixo</a></li>
                            <li><a class="dropdown-item" href="#" data-value="snacks">Salgados</a></li>
                            <li><a class="dropdown-item" href="#" data-value="snacks2">Folhados</a></li>
                            <li><a class="dropdown-item" href="#" data-value="sweets">Doces</a></li>
                            <li><a class="dropdown-item" href="#" data-value="drinks">Bebidas</a></li>
                            <li><a class="dropdown-item" href="#" data-value="others">Outros</a></li>
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
                                    <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td> <img src="" alt=""> </td> <!--Img Item-->
                                        <td> <h6>Coca-Cola 2L</h6> </td> <!--Name Item-->
                                        <td> <h6>Bebidas</h6> </td> <!--Categoria Item-->
                                        <td> <h6>15</h6> </td> <!--Quantidade no Estoque-->
                                        <td> <h6>15,00</h6> </td> <!--Preço Item-->
                                        <td> <h6>245,00</h6> </td> <!--Preço X quantidade em estoque-->
                                        <td id="table-acoes"> <button id="btn-editar-item">
                                                <i class="fa-solid fa-eye"></i>
                                             </button> 
                                                <button id="btn-visualizar-item">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                    <button id="btn-deletar-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                        <div class="table-estoque-baixo" id="table-low">

                        </div>
                            <div class="table-estoque-salgados" id="table-salgados">

                            </div>
                                <div class="table-estoque-folhados" id="table-folhados">

                                </div>
                                    <div class="table-estoque-doces" id="table-doces">

                                    </div>
                                        <div class="table-estoque-bebidas" id="table-bebidas">

                                        </div>
                                            <div class="table-estoque-outros" id="table-outros">

                                            </div>
                </div>
            </div>
        </div>

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