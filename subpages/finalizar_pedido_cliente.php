<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['cpf'])) {
    header("Location: /cantinarepositorio/subpages/login.php");
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
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/finalizar_pedido_cliente.css">
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
                        <li class="btn-voltar-finalizar-pedido">
                            <button type="button">
                                <a href="/cantinarepositorio/subpages/cardapio.php"><i class="fa-solid fa-arrow-left"></i></a>
                            </button>
                        </li>
                        <li class="finalizar-pedido-li">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box2" viewBox="0 0 16 16">
                                <path
                                    d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                            </svg>
                            Finalizar Pedido
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container-finalizar-pedido">
            <div class="content-finalizar-pedido">
                <div class="content-finalizar-pedido-left">
                    <div class="content-finalizar-pedido-left-top">
                        <div class="finalizar-pedido-left-top-title">
                            <h1>
                                Itens do Pedido <span>(3)</span> <!--numero de itens no pedido-->
                            </h1>
                        </div>
                    </div>
                    <div class="content-finalizar-pedido-left-bottom">
                        <div class="tabela-pedidos-resumo">
                            <div class="item-pedido-resumo">
                                <div class="item-pedido-resumo-left">
                                    <div class="imagem-produto">
                                        <img src="/cantinarepositorio/main/assets/img/carousel-img-2.png" alt="">
                                    </div>
                                    <div class="info-produto">
                                        <div class="info-produto-nome">
                                            <h1>Esfiha de Calabresa Aberta</h1>
                                        </div>
                                        <div class="info-produto-preco">
                                            <h5>R$ 23,00</h5>
                                        </div>
                                        <div class="info-produto-quantidade">
                                            <button class="btn-quantidade" onclick="diminuirQuantidade(this)"> −
                                            </button>
                                            <input type="number" class="input-quantidade" value="1" min="1">
                                            <button class="btn-quantidade" onclick="aumentarQuantidade(this)">+
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-pedido-resumo-right">
                                    <div class="deletar-item">
                                        <button class="btn-deletar-item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="item-pedido-resumo">
                                <div class="item-pedido-resumo-left">
                                    <div class="imagem-produto">
                                        <img src="/cantinarepositorio/main/assets/img/carousel-img-2.png" alt="">
                                    </div>
                                    <div class="info-produto">
                                        <div class="info-produto-nome">
                                            <h1>Esfiha de Calabresa Aberta</h1>
                                        </div>
                                        <div class="info-produto-preco">
                                            <h5>R$ 23,00</h5>
                                        </div>
                                        <div class="info-produto-quantidade">
                                            <button class="btn-quantidade" onclick="diminuirQuantidade(this)"> −
                                            </button>
                                            <input type="number" class="input-quantidade" value="1" min="1">
                                            <button class="btn-quantidade" onclick="aumentarQuantidade(this)">+
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-pedido-resumo-right">
                                    <div class="deletar-item">
                                        <button class="btn-deletar-item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="item-pedido-resumo">
                                <div class="item-pedido-resumo-left">
                                    <div class="imagem-produto">
                                        <img src="/cantinarepositorio/main/assets/img/carousel-img-2.png" alt="">
                                    </div>
                                    <div class="info-produto">
                                        <div class="info-produto-nome">
                                            <h1>Esfiha de Calabresa Aberta</h1>
                                        </div>
                                        <div class="info-produto-preco">
                                            <h5>R$ 23,00</h5>
                                        </div>
                                        <div class="info-produto-quantidade">
                                            <button class="btn-quantidade" onclick="diminuirQuantidade(this)"> −
                                            </button>
                                            <input type="number" class="input-quantidade" value="1" min="1">
                                            <button class="btn-quantidade" onclick="aumentarQuantidade(this)">+
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-pedido-resumo-right">
                                    <div class="deletar-item">
                                        <button class="btn-deletar-item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="item-pedido-resumo">
                                <div class="item-pedido-resumo-left">
                                    <div class="imagem-produto">
                                        <img src="/cantinarepositorio/main/assets/img/carousel-img-2.png" alt="">
                                    </div>
                                    <div class="info-produto">
                                        <div class="info-produto-nome">
                                            <h1>Esfiha de Calabresa Aberta</h1>
                                        </div>
                                        <div class="info-produto-preco">
                                            <h5>R$ 23,00</h5>
                                        </div>
                                        <div class="info-produto-quantidade">
                                            <button class="btn-quantidade" onclick="diminuirQuantidade(this)"> −
                                            </button>
                                            <input type="number" class="input-quantidade" value="1" min="1">
                                            <button class="btn-quantidade" onclick="aumentarQuantidade(this)">+
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-pedido-resumo-right">
                                    <div class="deletar-item">
                                        <button class="btn-deletar-item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-finalizar-pedido-right">
                    <div class="resumo-pedido">
                        <div class="resumo-pedido-top">
                            <div class="resumo-pedido-title">
                                <h1>Resumo do Pedido</h1>
                            </div>
                            <div class="resumo-pedido-info">
                                <div class="resumo-pedido-info-aluno">
                                    <h2>Aluno:</h2> <h3>Caio Picciarelli</h3>
                                </div>
                                <div class="resumo-pedido-info-itens">
                                    <h2>Total de Itens:</h2> <h3>3 Itens</h3>
                                </div>
                            </div>
                        </div>
                        <div class="resumo-pedido-bottom">
                            <div class="resumo-pedido-total">
                                <h2>Total:</h2> <h3>R$ 32,00</h3>
                            </div>
                            <div class="resumo-pedido-buttons">
                                <button type="button" class="btn-ir-para-pagamento">
                                    <a href="/cantinarepositorio/subpages/pagamento_cliente_page.php">
                                        <i class="fa-regular fa-credit-card"></i> 
                                        Ir para Pagamento
                                    </a>
                                </button>
                                <button type="button" class="btn-cancelar-finalizacao-pedido">
                                    <a href="/cantinarepositorio/main/index.php">Cancelar Pedido</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function aumentarQuantidade(btn) {
            const input = btn.parentNode.querySelector('.input-quantidade');
            input.value = parseInt(input.value) + 1;
        }

        function diminuirQuantidade(btn) {
            const input = btn.parentNode.querySelector('.input-quantidade');
            if (parseInt(input.value) > parseInt(input.min)) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>

</body>

</html>