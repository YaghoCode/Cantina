<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();


if(isset($_SESSION['cpf'])){
    $cpf = $_SESSION['cpf'];
    $query = "SELECT nome, cpf FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
  
    if($result && mysqli_num_rows($result) == 0){
      header("Location: .login.php");
      exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/estoque.css">
    <title>FURA FILA - Estoque</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="nav-links">
                <div class="nav-logo">
                    <img src="./assets/img/img comidas/logoCantina.png" alt="">
                </div>

                <div class="nav-items">
                    <ul>
                        <li>
                            <h1>
                                <a href="#inicio" style="text-decoration: none; color: #e3261b">Gerenciamento de Estoque
                                    e Pedidos</a>
                            </h1>
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <div class="btn-user" id="btn-user-nav">
                        <i class="fa-regular fa-user"></i>
                    </div>


                    <div class="pop-up-user" id="pop-up-user">

                        <div class="content-pp-user">

                            <div class="top-content">

                                <div class="icon-user">
                                    <i>
                                        <i class="fa-solid fa-user"></i> <!--PHP ICONS IMAGES-->
                                    </i>
                                </div>

                                <div class="btn-close-pp">
                                    <i>
                                        <i class="fa-solid fa-xmark" id="btn-close-user-nav"></i>
                                    </i>
                                </div>
                            </div>

                            <div class="bottom-content">
                                <div class="info-user">
                                    <div class="name-user">
                                        <h4>
                                            <Span>ALUNO:</Span> Admin1<!--ADICIONAR PHP-->
                                        </h4>
                                    </div>
                                    <div class="turma-user">
                                        <h4>
                                            <Span>TURMA:</Span> Cantina <!--Adicionar PHP-->
                                        </h4>
                                    </div>
                                </div>
                                <div class="edit-user">
                                    <i class="fa-solid fa-pen"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="main-container">
            <div class="main-title">
                <div class="pedidos-title">
                    <button id="btn-pedidos">
                        Pedidos
                    </button>
                </div>
                <div class="estoque-title">
                    <button id="btn-estoque">
                        Ajustes do Estoque
                    </button>
                </div>
            </div>
            <div class="main-content-pedidos" id="content-pedidos">

            </div>
            <div class="main-content-estoque" id="content-estoque">
                <div class="content-estoque-buttons">
                    <div class="estoque-btn-novo-produto">
                        <button id="btn-adicionar-produto">
                            Adicionar Produto +
                        </button>
                    </div>
                </div>
                <div class="table-estoque">

                </div>
            </div>
        </div>


        <!--FUNCAO CLICK DO BOTAO "NOVO"-->

        <!--Alert Modal login-->
        <div class="modal-novo-produto" id="modal-novo-p">
            <div class="modal-content">
                <div class="modal-content-left">
                    <div class="modal-title">
                        <h1>
                            Crie um novo produto:
                        </h1>
                    </div>
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
                                    <option value="Salgados">Salgado</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Folhados">Folhado</option>
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



    </main>


    <script type="module" src="./assets/js/estoque.js"></script>
</body>

</html

    <?php
     if($_SERVER["REQUEST_METHOD"] === "POST") {
        
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
            } }}


    $query = "SELECT * from estoque";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){

        foreach($query_run as $item){
            echo $item['id'];
        }
    }
    ?>