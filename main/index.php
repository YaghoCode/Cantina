<?php
include('./database.php');
session_start();
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
  <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title>Cantina PJ - Main</title>
</head>

<body class="body">

  <!-- header, navbar -->
  <header>
    <nav class="navbar">
      <div class="nav-links">
        <div class="nav-logo">
          <img src="./assets/img/logoCantina.png" alt="">
        </div>
        <div class="nav-items">
          <ul>
            <li>
              <h1>
                <a href="#inicio" style="text-decoration: none; color: inherit;">Início</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="/cantinarepositorio/subpages/cardapio.php" style="text-decoration: none; color: inherit;">Cardápio</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#Sobre-Nos" style="text-decoration: none; color: inherit;">Sobre Nós</a>
              </h1>
            </li>
          </ul>
        </div>
        <?php
        if (isset($_SESSION['cpf'])) {
          $cpf = $_SESSION['cpf'];
          $query = "SELECT nome, cpf, turma FROM cliente WHERE cpf = '$cpf'";
          $result = mysqli_query($con, $query);
          $user_data = mysqli_fetch_assoc($result);

          if ($result && mysqli_num_rows($result) > 0) {

            echo '<div class="nav-buttons">
                  <div class="btn-user" id="btn-user-nav" >
                      <i class="fa-regular fa-user"></i>
                  </div>
                  <div class="btn-cart" id="btn-cart-nav">
                      <i class="fa-solid fa-cart-shopping"></i>
                  </div>
              </div>';
          }
        } else {
          echo '  <div class="nav-buttons">
                <div class="btn-cadastrar-se">
                                <h1 class="botaocadastro">
                                <a href="/cantinarepositorio/subpages/login.php" style=" color:inherit; text-decoration:none;">Cadastrar</a>
                                </h1>
                            </div>
                              <div class="btn-login" >
                                  <button>
                                    <a href="/cantinarepositorio/subpages/login.php" style=" color:white; text-decoration:none;">Login</a> 
                                  </button>
                              </div>
                </div>';
        }
        ?>
      </div>
    </nav>
  </header>








  <!--POPUP DO USER-->

  <div class="pop-up-user" id="pop-up-user">

    <div class="content-pp-user">

      <div class="top-content">

        <div class="icon-user">
          <i class="fa-solid fa-user-ninja"></i> <!--PHP ICONS IMAGES-->
        </div>

        <div class="btn-close-pp">
          <i class="fa-solid fa-xmark" id="btn-close-user-nav"></i>
        </div>
      </div>

      <div class="bottom-content">


        <div class="info-user">
          <div class="name-user">
            <h4>
              ALUNO: <?php echo $user_data['nome']; ?><!--ADICIONAR PHP-->
            </h4>
          </div>
          <div class="turma-user">
            <h4>
              TURMA: <?php echo $user_data['turma']; ?> <!--Adicionar PHP-->
            </h4>
          </div>
          <div class="logout-user">
              <button>
                  <a href="/cantinarepositorio/subpages/logout.php">Logout</a>
              </button>
              <a href=""><i class="fa-solid fa-pen"></i></a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!--Popup carrinho-->
  <div class="pop-up-cart" id="pop-up-cart">
    <div class="content-pp-cart">
      <div class="content-pp-cart-top">
        <button>
          <i class="fa-solid fa-xmark" id="btn-close-cart-nav"></i>
        </button>
      </div>
      <div class="content-pp-cart-bottom">
        <div class="cart-title">
          <h6>
            Itens Adicionados:
          </h6>
        </div>
        <div class="barra-divisao">

        </div>
        <div class="cart-items">
          <div class="container-items">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide bg-light p-3 border rounded">Slide 1</div>
                <div class="swiper-slide bg-light p-3 border rounded">Slide 2</div>
                <div class="swiper-slide bg-light p-3 border rounded">Slide 3</div>
                <div class="swiper-slide bg-light p-3 border rounded">Slide 1</div>
                <div class="swiper-slide bg-light p-3 border rounded">Slide 2</div>
                <div class="swiper-slide bg-light p-3 border rounded">Slide 3</div>
              </div>
              <div class="swiper-scrollbar"></div>
            </div>
          </div>

        </div>
        <div class="cart-total-price">
          <h5>Total:</h5>
          <h6>R$: 00,00 <!--Price calculado--></h6>
        </div>
        <div class="finalizar-pedido">
          <button id="btn-finalizar-pedidos">
            Finalizar Pedido
          </button>
        </div>
      </div>
    </div>
  </div>



  <!--Alert Modal login-->
  <div class="container-modal-alert" id="modal-alert">
    <div class="content-modal-alert">
      <div class="btnSair-modal-alert">
        <button class="btnCLoseModaL" style="cursor: pointer;">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="title-modal-alert">
        <h1>
          Faça login ou cadastre-se
        </h1>
      </div>
      <div class="description-modal-alert">
        <p>
          É rápido, gratuito e o próximo passo para aproveitar tudo o que temos a oferecer!
        </p>
      </div>
      <div class="btn-modal-alert">
        <button>
          <a href="/cantinarepositorio/subpages/login.php" style="color: inherit; text-decoration: none;">Continuar</a>
        </button>
      </div>
    </div>
  </div>

  <!--Main, titulo ,carousel e MP (Mais Pedidos)-->

  <main>
    <!--Titulo Main-->
    <div class="Carousel-tittle" id="inicio">
      <h1>
        Bateu a fome? Vai de <br> <Span> #Cantina PJ</Span>
      </h1>
    </div>

    <!--Carousel-->

    <div class="container-carousel">
      <div class="container-carousel-divisao">

      </div>
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./assets/img/carousel-1.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carousel-2.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carousel-3.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <!--MP - Mais pedidos-->

    <div class="container-mais-pedidos" id="Cardapio">
      <div class="content-mp-1">
        <div class="content-tittle">
          <h1>
            Mais Pedidos
          </h1>
        </div>
        <div class="content-cards">
          <div class="cards-MP" id="cards-modal">
            <div class="cards-img-1">
              <img src="./assets/img/esfiha5.png" alt="">
            </div>
            <div class="cards-tittle">
              <h3>
                Esfiha de Carne
              </h3>
            </div>
            <div class="cards-price">
              <h6>
                R$ 6,99
              </h6>
            </div>
          </div>
          <div class="cards-MP" id="cards-modal">
            <div class="cards-img-2">
              <img src="./assets/img/esfiha5.png" alt="">
            </div>
            <div class="cards-tittle">
              <h3>
                Esfiha de Carne
              </h3>
            </div>
            <div class="cards-price">
              <h6>
                R$ 6,99
              </h6>
            </div>
          </div>
          <div class="cards-MP" id="cards-modal">
            <div class="cards-img-3">
              <img src="./assets/img/esfiha5.png" alt="">
            </div>
            <div class="cards-tittle">
              <h3>
                Esfiha de Carne
              </h3>
            </div>
            <div class="cards-price">
              <h6>
                R$ 6,99
              </h6>
            </div>
          </div>
        </div>
      </div>
      <div class="content-mp-2">
        <div class="divisao-cardapio">

        </div>
      </div>
    </div>
  </main>

  <!-- Section Cardapio, Salgados-->

  <section>
    <div class="container-cardapio">
      <div class="cardapio-tittle">
        <h1>
          Salgados
        </h1>
      </div>
      <div class="content-cardapio">
        <div class="cards-cardapio" id="cards-modal">
          <div class="cards-img-c-1">
            <img src="./assets/img/esfiha3.png" alt="">
          </div>
          <div class="cards-tittle-c">
            <h3>
              Esfiha de Frango
            </h3>
          </div>
          <div class="cards-price-c">
            <div class="price">
              <h6>
                R$ 6,00
              </h6>
            </div>
            <div class="cards-btn-c">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio" id="cards-modal">
          <div class="cards-img-c-2">
            <img src="./assets/img/esfiha5.png" alt="">
          </div>
          <div class="cards-tittle-c">
            <h3>
              Esfiha de Carne
            </h3>
          </div>
          <div class="cards-price-c">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-c">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio" id="cards-modal">
          <div class="cards-img-c-3">
            <img src="./assets/img/coxinha.png" alt="">
          </div>
          <div class="cards-tittle-c">
            <h3>
              Coxinha
            </h3>
          </div>
          <div class="cards-price-c">
            <div class="price">
              <h6>
                R$ 6,00
              </h6>
            </div>
            <div class="cards-btn-c">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio" id="cards-modal">
          <div class="cards-img-c-4">
            <img src="./assets/img/bauru.png" alt="">
          </div>
          <div class="cards-tittle-c">
            <h3>
              Bauru
            </h3>
          </div>
          <div class="cards-price-c">
            <div class="price">
              <h6>
                R$ 6,00
              </h6>
            </div>
            <div class="cards-btn-c">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Section Cardapio, Doces-->

  <section>
    <div class="container-cardapio-doces">
      <div class="cardapio-doces-tittle">
        <h1>
          Doces
        </h1>
      </div>
      <div class="content-cardapio-doces">
        <div class="cards-cardapio-doces" id="cards-modal">
          <div class="cards-img-d-1">
            <img src="./assets/img/pudim.png" alt="">
          </div>
          <div class="cards-tittle-d">
            <h3>
              Pudim
            </h3>
          </div>
          <div class="cards-price-d">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-d">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-doces" id="cards-modal">
          <div class="cards-img-d-2">
            <img src="./assets/img/croissant2.png" alt="">
          </div>
          <div class="cards-tittle-d">
            <h3>
              Croissant de Chocolate
            </h3>
          </div>
          <div class="cards-price-d">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-d">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-doces" id="cards-modal">
          <div class="cards-img-d-3">
            <img src="./assets/img/beijinho.png" alt="">
          </div>
          <div class="cards-tittle-d">
            <h3>
              Beijinho
            </h3>
          </div>
          <div class="cards-price-d">
            <div class="price">
              <h6>
                R$ 6,00
              </h6>
            </div>
            <div class="cards-btn-d">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-doces" id="cards-modal">
          <div class="cards-img-d-4">
            <img src="./assets/img/brigadeiro.png" alt="">
          </div>
          <div class="cards-tittle-d">
            <h3>
              Brigadeiro
            </h3>
          </div>
          <div class="cards-price-d">
            <div class="price">
              <h6>
                R$ 6,00
              </h6>
            </div>
            <div class="cards-btn-d">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!--Section Cadapio, Bebidas-->

  <section>

    <div class="container-cardapio-bebidas">
      <div class="cardapio-bebidas-tittle">
        <h1>
          Bebidas
        </h1>
      </div>
      <div class="content-cardapio-bebidas">
        <div class="cards-cardapio-bebidas" id="cards-modal">
          <div class="cards-img-tittle-b">
            <div class="cards-tittle-b">
              <h3>
                Coca-Cola 350ml
              </h3>
            </div>
            <div class="cards-img-b-1">
              <img src="./assets/img/coca.png" alt="">
            </div>
          </div>
          <div class="cards-price-b">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-b">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-bebidas" id="cards-modal">
          <div class="cards-img-tittle-b">
            <div class="cards-tittle-b">
              <h3>
                Coca-Cola <br>Zero 350ml
              </h3>
            </div>
            <div class="cards-img-b-2">
              <img src="./assets/img/cocazero.png" alt="">
            </div>
          </div>
          <div class="cards-price-b">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-b">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-bebidas" id="cards-modal">
          <div class="cards-img-tittle-b">
            <div class="cards-tittle-b">
              <h3>
                Coca Cola 350ml
              </h3>
            </div>
            <div class="cards-img-b-3">
              <img src="./assets/img/coca.png" alt="">
            </div>
          </div>
          <div class="cards-price-b">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-b">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
        <div class="cards-cardapio-bebidas" id="cards-modal">
          <div class="cards-img-tittle-b">
            <div class="cards-tittle-b">
              <h3>
                Coca Cola 350ml
              </h3>
            </div>
            <div class="cards-img-b-4">
              <img src="./assets/img/coca.png" alt="">
            </div>
          </div>
          <div class="cards-price-b">
            <div class="price">
              <h6>
                R$ 7,00
              </h6>
            </div>
            <div class="cards-btn-b">
              <button>
                <P>
                  +
                </P>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!--Section Sobre Nós-->

  <section>
    <div class="container-divisao-2">
      <div class="divisao-cardapio-2">

      </div>
    </div>

    <div class="container-sobreNos">
      <div class="content-tittle-sobreNos" id="Sobre-Nos">
        <h1>
          Sobre Nós
        </h1>
      </div>
      <div class="content-sobreNos">

        <div class="content-left">
          <div class="content-left-tittle">
            <h1>
              Você tem fome do que!?
            </h1>
          </div>
          <div class="content-left-description">
            <p>
              Conheça um pouco da nossa equipe e do projeto!
            </p>
          </div>
          <div class="content-left-btn">
            <button>
              <a href="./propaganda.html" style="color: inherit; text-decoration: none;">Saiba Mais</a>
            </button>
          </div>
        </div>

        <div class="content-right">
          <div class="movie" id="video-container">
            <div class="ratio ratio-16x9">
              <iframe
                id="youtube-video" width="560" height="315" src="https://www.youtube.com/embed/__UIwJS_r3w?enablejsapi=1&mute=0" style="border-radius: 10px;" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--avaliações-->

  <section>

    <div class="tittle-avaliacoes">
      <h1>
        AVALIAÇÕES
      </h1>
    </div>
    <div class="container-avaliacoes">
      <div class="content-avaliacoes">
        <button class="arrow left">&#8249;</button>

        <div class="avaliacoes">
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Lucas Nunes</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Amei os salgados! A esfiha de frango estava bem temperada e fresquinha. Atendimento rápido, adorei o sistema de retirar o pedido sem fila
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Esfiha de Frango <br>
                              - 1x Suco de Laranja Natural<br>
                              <span>Total: R$ 12,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Isaque Vicente</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          O salgado estava um pouco frio, porém a agilidade da entrega me surpreendeu!
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Esfiha de Carne <br>
                              <span>Total: R$ 6,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
         <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Caio Picciarelli</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Amei os salgados! A esfiha de carne estava bem temperada e fresquinha. Atendimento rápido, adorei o sistema de retirar o pedido sem fila
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Esfiha de carne <br>
                              - 1x Suco de Uva natural<br>
                              <span>Total: R$ 12,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Lucas Rossi</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Lanche Pessimo!
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Pão de queijo<br>
                              <span>Total: R$ 6,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
         <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Ana Luiza</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Pastel folhado maravilhoso, crocante e recheado até o fim. Com certeza virei cliente fiel!
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Pastel de Carne <br>
                              <span>Total: R$ 10,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Miguel Altoe</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Os doces são muito bons, principalmente o brigadeiro gourmet. Só faltou ter mais opções sem lactose
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x brigadeiro <br>
                              <span>Total: R$ 7,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Nilson N.</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Amei os salgados!
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Esfiha de Frango <br>
                              <span>Total: R$ 6,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Arthur C.</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Os salgados são muito bons!
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Kibi Assado <br>
                              <span>Total: R$ 7,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Nicolas O.</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Adorei a praticidade! Peguei meu Pastel sem perder tempo na fila.”
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Pastel de frango <br>
                              <span>Total: R$ 10,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>
          <div class="card">
            <div class="c-top">
              <div class="title-avaliacao">
                  <h1>Aluno: Yagho C.</h1>
                  <h1>Turma: 3 DS - A</h1>
              </div>
              <div class="avaliacao-stars">
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
              </div>
            </div>
            <div class="c-bottom">
                <div class="avaliacao-user">
                    <div class="title-avaliacao-user">
                        <h1>Avaliação:</h1>
                    </div>
                    <div class="conteudo-avaliacao-user">
                        <p>
                          Amei os salgados! A esfiha de Queijo estava bem temperada e fresquinha. Atendimento rápido, adorei o sistema de retirar o pedido sem fila
                        </p>
                    </div>
                </div>
                  <div class="pedido-user">
                      <div class="title-pedido-user">
                          <h1>Pedido:</h1>
                      </div>
                        <div class="conteudo-pedido-user">
                            <p>
                              - 1x Esfiha de Queijo <br>
                              - 1x Suco de Melancia Natural<br>
                              <span>Total: R$ 12,00</span>
                            </p>
                        </div>
                  </div>
            </div>
          </div>

        </div>

        <button class="arrow right">&#8250;</button>
      </div>
    </div>
  </section>

  <div class="container-divisao-3">
    <div class="divisao-3"></div>
  </div>

  <footer>
    <div class="container-footer" style="height: 10vh; width: 100%;">
      <div class="content-footer">
        <div class="footer-left">

        </div>
        <div class="footer-description">
          <h6>
            © Copyright 2025 - Fura-Fila - Todos os direitos reservados Cantinas PJ <br>com Agência de Restaurantes Online S.A
          </h6>
        </div>
        <div class="footer-right">
          <div class="footer-icons">
            <i class="fa-brands fa-whatsapp"></i> <i class="fa-brands fa-instagram"></i> <i class="fa-brands fa-twitter"></i>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script type="module" src="./assets/js/cardapio.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- Swiper.js JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


  <script type="module" src="./assets/js/script.js"></script>
  <?php
        if (isset($_SESSION['cpf'])) {
          $cpf = $_SESSION['cpf'];
          $query = "SELECT nome, cpf, turma FROM cliente WHERE cpf = '$cpf'";
          $result = mysqli_query($con, $query);
          $user_data = mysqli_fetch_assoc($result);

          if ($result && mysqli_num_rows($result) > 0) {
            echo '<script type="module" src="./assets/js/modalalert.js"></script> ';
          }
        } else {
          
          echo'<script type="module" src="./assets/js/direcionamentocardapio.js"></script>';
        }
        ?>
</body>

</html>