<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    // Tenta buscar como administrador
    $query_user = "SELECT nome, cpf, email, turma FROM cliente WHERE cpf = '$cpf'";
    $result_user = mysqli_query($con, $query_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);
        // Permite acesso
    } else {
        header("Location: ./login.php");
        exit;
    }
} else {
    header("Location: ./login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/pedidos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Meus Pedidos</title>

</head>

<body class="body">
    <header>
        <div class="navbar" id="meuspedidos">
            <div class="nav-links">
                <div class="nav-logo">
                    <img src="/cantinarepositorio/main/assets/img/logo3.png" alt="">
                </div>
                <div class="nav-items">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box2" viewBox="0 0 16 16">
                                <path
                                    d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                            </svg>
                            Meus Pedidos
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <div class="btn-home">
                        <button type="button">
                            <a href="/cantinarepositorio/main/index.php">
                                <i class="fa-solid fa-house"></i>Home
                            </a>
                        </button>
                    </div>
                    <div class="btn-user" id="btn-user-nav">
                        <button>
                            <i class="fa-regular fa-user"></i> Perfil
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="content-mid-user-row-right">
                        <div class="content-mid-user-row-right-text">
                            <h1>
                                Turma
                            </h1>
                            <h3>
                                <?php echo $user_data['turma'] ?>
                            </h3>
                        </div>
                    </div>
                </div>
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
            </div>
            <div class="content-bottom-user">
                <div class="content-bottom-user-row">
                    <button type="button" class="btn-pop-up-editar-adm">
                        <a href="/cantinarepositorio/subpages/editar_cliente_page.php">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Editar
                        </a>
                    </button>
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

    <!--Main-->

    <main>
        <div class="container-pedidos">
            <div class="container-pedidos-title">
                <h2>Pedidos</h2>
                <p>Veja seus pedidos antigos ou em andamento.</p>
            </div>

            <div class="content-pedidos">
                <div class="content-pedidos-header">
                    <div class="filtros-pedidos">
                        <button class="filtro active"><i class="bi bi-box2"></i>Todos</button>
                        <button class="filtro"><i class="bi bi-box-seam"></i>Preparando</button>
                        <!--colocar Sendo preparados e Á retirar no mesmo-->
                        <button class="filtro"><i class="bi bi-check-circle"></i>Concluidos</button>
                        <button class="filtro"><i class="bi bi-truck"></i>Cancelados</button>
                    </div>
                </div>

                <!-- Todos -->
                <div class="content-pedidos-body active">
                    <?php
                    $query = "SELECT * FROM pedido WHERE cpf = '$cpf' ORDER BY data_pedido DESC";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        foreach ($result as $pedido) {

                            //Sendo Preparado
                            if ($pedido['status'] == 'Sendo Preparado') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);  // ← JÁ ESTÁ CORRETO
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');

                                $query_items = "SELECT * FROM pedido_itens WHERE pedido_id = '" . $pedido['id'] . "'";
                                $result_items = mysqli_query($con, $query_items);

                                echo '
                            <div class="card"> <!--CARD PLACEHOLDER PEDIDO CONCLUIDO-->
                        <div class="card-top">
                            <button class="tag-filtro-preparando">
                                <i class="fa-solid fa-rotate-right"></i>
                                Sendo Preparado
                            </button>
                            <button class="tag-pedido">
                                Pedido: #' . $pedido['id'] . '
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>' . $dataFmt . '</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                 ';
                                foreach ($result_items as $itens) {
                                    echo '<div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>' . $itens['quantidade'] . 'x</h1> <!--Quantidade do item php-->
                                        <h2>' . $itens['nome_item'] . '</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$' . $itens['preco_item'] . '</p> <!--preço produto php--->
                                    </div>
                                </div>';
                                }

                                echo '

                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ ' . $total . ' </p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>';
                            }
                            if ($pedido['status'] == 'Cancelado') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);  // ← JÁ ESTÁ CORRETO
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');

                                $query_items = "SELECT * FROM pedido_itens WHERE pedido_id = '" . $pedido['id'] . "'";
                                $result_items = mysqli_query($con, $query_items);

                                echo '<div class="card">
                        <div class="card-top">
                            <button class="tag-filtro-cancelado">
                                <i class="fa-solid fa-xmark"></i>
                                Cancelado
                            </button>
                            <button class="tag-pedido">
                                Pedido: #' . $pedido['id'] . '
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>' . $dataFmt . '</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                   ';
                                foreach ($result_items as $itens) {
                                    echo '<div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>' . $itens['quantidade'] . 'x</h1> <!--Quantidade do item php-->
                                        <h2>' . $itens['nome_item'] . '</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$' . $itens['preco_item'] . '</p> <!--preço produto php--->
                                    </div>
                                </div>';
                                }

                                echo '
                    
                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ ' . $total . '</p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>';
                            }
                            if ($pedido['status'] == 'Concluído') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);  // ← JÁ ESTÁ CORRETO
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');

                                $query_items = "SELECT * FROM pedido_itens WHERE pedido_id = '" . $pedido['id'] . "'";
                                $result_items = mysqli_query($con, $query_items);

                                echo '
                            <div class="card"> <!--CARD PLACEHOLDER PEDIDO CONCLUIDO-->
                        <div class="card-top">
                            <button class="tag-filtro-concluido">
                                <i class="fa-solid fa-check"></i>
                                Concluído
                            </button>
                            <button class="tag-pedido">
                                Pedido: #' . $pedido['id'] . '
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>' . $dataFmt . '</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                 ';
                                foreach ($result_items as $itens) {
                                    echo '<div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>' . $itens['quantidade'] . 'x</h1> <!--Quantidade do item php-->
                                        <h2>' . $itens['nome_item'] . '</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$' . $itens['preco_item'] . '</p> <!--preço produto php--->
                                    </div>
                                </div>';
                                }

                                echo '

                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ ' . $total . ' </p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>';
                            }
                        }
                    } else {
                        echo '<p>Nenhum pedido encontrado.</p>';
                    }


                    ?>


                    
                    <div class="card"> <!--CARD PLACEHOLDER PEDIDO EM ANDAMENTO MAS JA FEITO POR PARTE DA CANTINA-->
                        <div class="card-top">
                            <button class="tag-filtro-preparado-parcialmente">
                                <i class="fa-solid fa-rotate-right"></i>
                                Á Retirar
                            </button>
                            <button class="tag-pedido">
                                Pedido: #1234
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>18/06/25</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                <div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <!-- mais itens aqui -->
                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                                <button class="visualizar-pedido">
                                    Visualizar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ 23,00</p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>

                </div>


                <!--SISTEMA DE FILTROS ABAIXO (acho)-->

                
                <!-- Preparando -->
                <div class="content-pedidos-body">
                    <?php
                    $query = "SELECT * FROM pedido WHERE cpf = '$cpf' ORDER BY data_pedido DESC";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        foreach ($result as $pedido) {
                            if ($pedido['status'] == 'Sendo Preparado') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');
                                echo '<div class="card"> <!--CARD PLACEHOLDER PEDIDO EM ANDAMENTO-->
                        <div class="card-top">
                            <button class="tag-filtro-preparando">
                                <i class="fa-solid fa-rotate-right"></i>
                                Sendo Preparado
                            </button>
                            <button class="tag-pedido">
                                Pedido: #' . $pedido['id'] . '
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>' . $dataFmt . '</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                            ';

                                    foreach ($result_items as $itens) {
                                        echo '<div class="pedido-items"> <!--cada produto do pedido php-->
                                        <div class="pedido-items-name">
                                            <h1>' . $itens['quantidade'] . 'x</h1> <!--Quantidade do item php-->
                                            <h2>' . $itens['nome_item'] . '</h2> <!--Nome do produto php--->
                                        </div>
                                        <div class="pedido-items-preco">
                                            <p>R$' . $itens['preco_item'] . '</p> <!--preço produto php--->
                                        </div>
                                    </div>';
                                    }

                                    echo '
                                </div>
                            </div>
                            <div class="card-bottom">
                                <div class="card-bottom-buttons">
                                    <button class="cancelar-pedido">
                                        Cancelar Pedido
                                    </button>
                                    <button class="visualizar-pedido">
                                        Visualizar Pedido
                                    </button>
                                </div>
                                <div class="card-bottom-preco-total">
                                    <p> R$ ' . $total . '</p> <!--preco total pedido php-->
                                </div>
                            </div>
                        </div>';
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Prontos -->
                <div class="content-pedidos-body">
                    <?php
                    $query = "SELECT * FROM pedido WHERE cpf = '$cpf' ORDER BY data_pedido DESC";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        foreach ($result as $pedido) {
                            if ($pedido['status'] == 'Concluido') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');
                                echo '<div class="card"> <!--CARD PLACEHOLDER PEDIDO CONCLUIDO-->
                        <div class="card-top">
                            <button class="tag-filtro-concluido">
                                <i class="fa-solid fa-check"></i>
                                Concluído
                            </button>
                            <button class="tag-pedido">
                                Pedido: #1234
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>18/06/25</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                <div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <!-- mais itens aqui -->
                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ 23,00</p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>';
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Entregues -->
                <div class="content-pedidos-body">
                    <?php
                    $query = "SELECT * FROM pedido WHERE cpf = '$cpf' ORDER BY data_pedido DESC";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        foreach ($result as $pedido) {
                            if ($pedido['status'] == 'Cancelado') {
                                $dataRaw = $pedido['data_pedido'] ?? '';
                                if ($dataRaw && ($ts = strtotime($dataRaw)) !== false) {
                                    $dataFmt = date('d/m/Y H:i', $ts);  // ← JÁ ESTÁ CORRETO
                                } else {
                                    $dataFmt = $dataRaw ? htmlspecialchars($dataRaw) : '--';
                                }
                                $total = number_format((float) ($pedido['preco_total'] ?? 0), 2, ',', '.');
                                echo '<div class="card"> <!--CARD PLACEHOLDER PEDIDO EM CANCELADO-->
                        <div class="card-top">
                            <button class="tag-filtro-cancelado">
                                <i class="fa-solid fa-xmark"></i>
                                Cancelado
                            </button>
                            <button class="tag-pedido">
                                Pedido: #' . $pedido['id'] . '
                            </button>
                        </div>
                        <div class="card-mid">
                            <div class="card-mid-dia-horario">
                                <h1>Turno: <span>Manhã</span></h1>
                                <h1>Dia: <span>' . $dataFmt . '</span></h1>
                            </div>

                            <div class="card-mid-detalhes-pedido">
                                <div class="pedido-items"> <!--cada produto do pedido php-->
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <div class="pedido-items">
                                    <div class="pedido-items-name">
                                        <h1>1x</h1> <!--Quantidade do item php-->
                                        <h2>Esfiha de carne</h2> <!--Nome do produto php--->
                                    </div>
                                    <div class="pedido-items-preco">
                                        <p>R$ 7,00</p> <!--preço produto php--->
                                    </div>
                                </div>
                                <!-- mais itens aqui -->
                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-bottom-buttons">
                                <button class="cancelar-pedido" style="display: none;">
                                    Cancelar Pedido
                                </button>
                            </div>
                            <div class="card-bottom-preco-total">
                                <p>R$ ' . number_format($total, 2, ',', '.') . '</p> <!--preco total pedido php-->
                            </div>
                        </div>
                    </div>';
                            }
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </main>

    <!--Script das tables-->
    <script>
        const filtros = document.querySelectorAll('.filtro');
        const tabelas = document.querySelectorAll('.content-pedidos-body');

        filtros.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                // Remove active de todos os filtros
                filtros.forEach(f => f.classList.remove('active'));
                btn.classList.add('active');

                // Esconde todas as tabelas
                tabelas.forEach(t => t.classList.remove('active'));

                // Mostra a tabela correspondente ao filtro clicado
                if (tabelas[index]) {
                    tabelas[index].classList.add('active');
                }
            });
        });

        // Opcional: mostrar a primeira tabela por padrão
        if (tabelas[0]) tabelas[0].classList.add('active');
        if (filtros[0]) filtros[0].classList.add('active');
    </script>


    <!--Modal cancelar pedido-->

    <div class="modal-overlay-cancelar-pedido">
        <div class="modal-cancelar-pedido">
            <div class="modal-cancelar-pedido-top">
                <h1>Tem certeza?</h1>
                <p>
                    Esta ação não pode ser desfeita. O pedido de número:
                    "<span class="cancelar-pedido-numero"></span>",
                    do usuario: "<span class="cancelar-pedido-nome-cliente"></span>" será cancelado.
                </p>
            </div>
            <div class="modal-cancelar-pedido-bottom">
                <button type="button" class="btn-cancelar-cancelar-pedido">Desfazer</button>
                <button type="button" class="btn-confirmar-cancelar-pedido">Cancelar Pedido</button>
            </div>
        </div>
    </div>

    <script>
        const modalCancelarPedido = document.querySelector('.modal-cancelar-pedido');
        const modalOverlayCancelarPedido = document.querySelector('.modal-overlay-cancelar-pedido');
        const btnCancelarCancelamentoPedido = document.querySelector('.btn-cancelar-cancelar-pedido');
        const btnConfirmarCancelamentoPedido = document.querySelector('.btn-confirmar-cancelar-pedido');
        const btnCancelarPedido = document.querySelectorAll('.cancelar-pedido');

        btnCancelarPedido.forEach((btn) => {
            btn.addEventListener('click', () => {
                modalCancelarPedido.classList.add('active');
                modalOverlayCancelarPedido.classList.add('active');
            })
        });

        btnCancelarCancelamentoPedido.addEventListener('click', () => {
            modalCancelarPedido.classList.remove('active');
            modalOverlayCancelarPedido.classList.remove('active');
        });
    </script>

    <!--modal visualizar pedido-->

    <div class="modal-overlay-visualizar-pedido">
        <div class="modal-visualizar-pedido">
            <button class="btn-fechar-modal-visualizar">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="content-modal-visualizar-pedido">
                <div class="content-modal-visualizar-top">
                    <div class="content-modal-visualizar-top-title">
                        <h1>Detalhes do Pedido:</h1>
                    </div>
                    <div class="content-modal-visualizar-top-tagFiltro">
                        <h6>Sendo Preparado</h6> <!--php tag do pedido MUDA A COR DESGRAÇA-->
                    </div>
                </div>
                <div class="content-modal-visualizar-mid">
                    <div class="content-modal-visualizar-mid-row">
                        <div class="content-modal-visualizar-mid-group">
                            <div class="mid-group-numero-pedido">
                                <h1>Número do pedido:</h1>
                                <span>#1234</span><!--php number pedido-->
                            </div>
                            <div class="mid-group-data-pedido">
                                <h1>Data:</h1>
                                <span>17/02/2008</span><!--php data pedido-->
                            </div>
                        </div>
                        <div class="content-modal-visualizar-mid-group">
                            <div class="mid-group-turno-pedido">
                                <h1>Turno:</h1>
                                <span>Manhã</span><!--php turno pedido-->
                            </div>
                            <div class="mid-group-data-pedido">
                                <button>Avaliar Pedido</button>
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
                                <span>Caio Silva</span>
                            </div>
                            <div class="mid-group-info">
                                <h1>Turma: </h1>
                                <span>2 DS</span>
                            </div>
                            <div class="mid-group-info">
                                <h1>CPF: </h1>
                                <span>55132867854</span>
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
                                            <h3>2x</h3><!--quantidade produto-->
                                            <h4>Esfiha de Carne</h4><!--nome do produto-->
                                        </div>
                                        <div class="tabela-items-pedido-preco">
                                            <h5>R$ 6,00</h5><!--Preço produto-->
                                        </div>
                                    </div>
                                    <div class="tabela-items-pedido">
                                        <div class="tabela-items-pedido-produto">
                                            <h3>2x</h3><!--quantidade produto-->
                                            <h4>Esfiha de Carne</h4><!--nome do produto-->
                                        </div>
                                        <div class="tabela-items-pedido-preco">
                                            <h5>R$ 6,00</h5><!--Preço produto-->
                                        </div>
                                    </div>
                                    <div class="tabela-items-pedido">
                                        <div class="tabela-items-pedido-produto">
                                            <h3>2x</h3><!--quantidade produto-->
                                            <h4>Esfiha de Carne</h4><!--nome do produto-->
                                        </div>
                                        <div class="tabela-items-pedido-preco">
                                            <h5>R$ 6,00</h5><!--Preço produto-->
                                        </div>
                                    </div>
                                    <div class="tabela-items-pedido">
                                        <div class="tabela-items-pedido-produto">
                                            <h3>2x</h3><!--quantidade produto-->
                                            <h4>Esfiha de Carne</h4><!--nome do produto-->
                                        </div>
                                        <div class="tabela-items-pedido-preco">
                                            <h5>R$ 6,00</h5><!--Preço produto-->
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
                        <span>R$ 14,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modalVisualizarPedido = document.querySelector('.modal-visualizar-pedido');
        const modalOverlayVisualizarPedido = document.querySelector('.modal-overlay-visualizar-pedido');
        const btnFecharModalPedido = document.querySelector('.btn-fechar-modal-visualizar');
        const btnVisualizarPedido = document.querySelectorAll('.visualizar-pedido');

        btnVisualizarPedido.forEach((btn) => {
            btn.addEventListener('click', () => {
                modalVisualizarPedido.classList.add('active');
                modalOverlayVisualizarPedido.classList.add('active');
            })
        });

        btnFecharModalPedido.addEventListener('click', () => {
            modalVisualizarPedido.classList.remove('active');
            modalOverlayVisualizarPedido.classList.remove('active');
        });
    </script>

    <!--footer-->

    <footer>
        <div class="container-footer">
            <div class="content-footer">
                <div class="content-top-footer">
                    <div class="item-footer">
                        <div class="info-cantina-img">
                            <img src="/cantinarepositorio/main/assets/img/logo-footer.png" alt="">
                        </div>
                        <div class="info-cantina-description">
                            <p>Alimentando conhecimento e criando memórias através de sabores únicos há mais de 10 anos
                                na nossa
                                comunidade escolar.</p>
                        </div>
                        <div class="info-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-x-twitter"></i>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Links Rápidos</h1>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li>
                                    <h6>
                                        <a href="/cantinarepositorio/main/index.php">Home</a>
                                    </h6>
                                </li>
                                <li>
                                    <h6>
                                        <a href="#meuspedidos">Pedidos</a>
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Contato</h1>
                        </div>
                        <div class="footer-links-local">
                            <ul>
                                <li>
                                    <h6>
                                        <a
                                            href="https://www.bing.com/search?q=maps%20Av%20Cruzeiro%20Do%20Sul%2C%202630%20-%20Carandiru&qs=n&form=QBRE&sp=-1&lq=0&pq=maps%20av%20cruzeiro%20do%20sul%2C%202630%20-%20carandiru&sc=0-41&sk=&cvid=08A936946DAF43F9B1FC74F782A823B6">
                                            <i class="fa-solid fa-location-dot"></i>
                                            Av Cruzeiro Do Sul, 2630 - Carandiru.
                                        </a>
                                    </h6>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://vestibulinho.etec.sp.gov.br/fale-conosco">
                                            <i class="fa-solid fa-location-dot"></i>
                                            (11) 3471-4071.
                                        </a>
                                    </h6>
                                </li>
                                <li>
                                    <h6><i class="fa-solid fa-envelope"></i> Furafila@gmail.com</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Horários de Funcionamento</h1>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li>
                                    <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i>
                                        Manha: 10:00 -
                                        10:20.</h6>
                                </li>
                                <li>
                                    <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i>
                                        Tarde: 16:00 -
                                        16:20.</h6>
                                </li>
                                <li>
                                    <h6 style="width: 235%; display:flex; gap: 1vh; padding-bottom:2vh;"><i
                                            class="fa-solid fa-clock"></i>
                                        Noite: 20:00 - 20:20.</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-bottom-footer">
                    <div class="title-footer-bottom">
                        <h1>
                            © 2025 FURA-FILA. Todos os direitos reservados.
                        </h1>
                    </div>
                    <div class="title-footer-bottom-2">
                        <h1>
                            <a href="/cantinarepositorio/subpages/termos.php">
                                Política e Privacidade
                            </a>
                        </h1>
                        <h1>
                            <a href="/cantinarepositorio/subpages/termos.php">
                                Termos de uso
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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

    <script src="./assets/js/pageCliente/pedidos.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>