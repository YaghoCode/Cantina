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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/pedidos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Meus Pedidos</title>

</head>

<body class="body">
    <header>
        <div class="navbar">
            <div class="nav-links">
                <div class="nav-logo">
                    <img src="/cantinarepositorio/main/assets/img/logo3.png" alt="">
                </div>
                <div class="nav-items">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
                                <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                            </svg>
                            Meus Pedidos
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <div class="btn-home">
                        <button>
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

    <!--pop-up-user-->
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
                    <button class="btn-pop-up-editar-adm">
                        <a href="#Editar-adm">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Editar
                        </a>
                    </button>
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
                        <button class="filtro"><i class="bi bi-box-seam"></i>Preparando</button> <!--colocar Sendo preparados e Á retirar no mesmo-->
                        <button class="filtro"><i class="bi bi-check-circle"></i>Concluidos</button>
                        <button class="filtro"><i class="bi bi-truck"></i>Cancelados</button>
                    </div>
                </div>

                <!-- Todos -->
                <div class="content-pedidos-body active">
                    <div class="card"> <!--CARD PLACEHOLDER PEDIDO EM ANDAMENTO-->
                        <div class="card-top">
                            <button class="tag-filtro-preparando">
                                <i class="fa-solid fa-rotate-right"></i>
                                Sendo Preparado
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
                                <button class="cancelar-pedido">
                                    Cancelar Pedido
                                </button>
                            </div>
                                <div class="card-bottom-preco-total">
                                    <p>R$ 23,00</p> <!--preco total pedido php-->
                                </div> 
                        </div>
                    </div>


                    <div class="card"> <!--CARD PLACEHOLDER PEDIDO CONCLUIDO-->
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
                    </div>


                    <div class="card"> <!--CARD PLACEHOLDER PEDIDO EM CANCELADO-->
                        <div class="card-top">
                            <button class="tag-filtro-cancelado">
                                <i class="fa-solid fa-xmark"></i>
                                Cancelado
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
                    </div>
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
                            </div>
                                <div class="card-bottom-preco-total">
                                    <p>R$ 23,00</p> <!--preco total pedido php-->
                                </div> 
                        </div>
                    </div>
                    <div class="card">Pedido #005</div>
                    <div class="card">Pedido #006</div>
                    <div class="card">Pedido #007</div>
                    <div class="card">Pedido #008</div>
                    <div class="card">Pedido #009</div>
                    <div class="card">Pedido #010</div>
                    <div class="card">Pedido #011</div>
                    <div class="card">Pedido #012</div>
                </div>

                <!-- Preparando -->
                <div class="content-pedidos-body">
                    <div class="card">Pedido P-01</div>
                    <div class="card">Pedido P-02</div>
                    <div class="card">Pedido P-03</div>
                    <div class="card">Pedido P-04</div>
                </div>

                <!-- Prontos -->
                <div class="content-pedidos-body">
                    <div class="card">Pedido PR-01</div>
                    <div class="card">Pedido PR-02</div>
                </div>

                <!-- Entregues -->
                <div class="content-pedidos-body">
                    <div class="card">Pedido E-01</div>
                    <div class="card">Pedido E-02</div>
                    <div class="card">Pedido E-03</div>
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

        </div>


    <script src="./assets/js/pedidos.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>