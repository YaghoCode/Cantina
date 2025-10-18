

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
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/finalizar_pedido.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Finalizar Pedido</title>

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