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
                             Caiopicciarelli           <!--<php echo $user_data['nome']; ?>-->
                        </h6>
                        <p>
                            Caio@gmail.com                           <!--<php echo $user_data['email']; ?>-->
                        </p>
                    </div>
                </div>
                <div class="top-info-user">
                    <div class="top-info-user-text">
                        <h6>
                            Turma: 3DS            <!--<php echo $user_data['turma']; ?>-->
                        </h6>
                        <p>
                            CPF: 999999999                <!--<php echo $user_data['cpf']; ?>-->
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
                <h1>Gerenciar Estoque</h1>
            </div>
                <div class="content-estoque">

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



    <script type="module" src="./assets/js/estoque.js"></script>
</body>

</html

