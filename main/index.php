<?php
include('./database.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <title>Cantina PJ - Main</title>
</head>

<body class="fade-out">

  <!-- header, navbar -->
  <header>
    <nav class="navbar">
      <div class="nav-links">
        <div class="nav-logo">
          <img src="./assets/img/logo2.png" style="height: 26vh;" alt="">
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
            <li>
              <h1>
                <a href="#Avaliacoes" style="text-decoration: none; color: inherit;">Avaliações</a>
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

            echo '<div class="nav-buttons" style="gap:3vh;">
                  <div class="btn-user" id="btn-user-nav" >
                    <button>
                      <i class="fa-regular fa-user"></i>
                    </button>
                  </div>
                  <div class="btn-cart" id="btn-cart-nav">
                    <button><i class="fa-solid fa-cart-shopping"></i>Carrinho</button>
                  </div>
              </div>';
          }
        } else {
          echo '  <div class="nav-buttons">
                <div class="btn-cadastrar-se">
                                <button>
                                  <a href="/cantinarepositorio/subpages/login.php" style=" color:inherit; text-decoration:none;"><i class="fa-regular fa-user"></i> Entrar</a>
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
          <i class="fa-solid fa-user"></i> <!--PHP ICONS IMAGES-->
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
    <!--Espaço navbar-->
    <div class="Espaco-navbar" id="inicio">
    </div>

    <!--Carousel-->

    <div class="container-carousel">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators custom-indicators">
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./assets/img/carousel-img.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" id="carousel">
              <div class="title-carousel">
                <h1>Refeições Saudáveis</h1>
                <h5>Feitas com amor e igredientes frescos.</h5>
              </div>
              <div class="description-carousel">
                <p>Manter uma alimentação equilibrada é essencial para potencializar a concentração, a memória e o rendimento durante os estudos.</p>
              </div>
              <div class="btn-carousel">
                <button class="btn-1-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
                </button>
                <button class="btn-1-carousel">
                  <a href="/cantinarepositorio/subpages/login.php">Fazer Login</a>
                </button>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carousel-img-2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" id="carousel">
              <div class="title-carousel">
                <h1>Refeições Saudáveis</h1>
                <h5>Feitas com amor e igredientes frescos.</h5>
              </div>
              <div class="description-carousel">
                <p>Manter uma alimentação equilibrada é essencial para potencializar a concentração, a memória e o rendimento durante os estudos.</p>
              </div>
              <div class="btn-carousel">
                <button class="btn-2-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
                </button>
                <button class="btn-2-carousel">
                  <a href="/cantinarepositorio/subpages/login.php">Fazer Login</a>
                </button>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carousel-img-3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" id="carousel">
              <div class="title-carousel">
                <h1>Refeições Saudáveis</h1>
                <h5>Feitas com amor e igredientes frescos.</h5>
              </div>
              <div class="description-carousel">
                <p>Manter uma alimentação equilibrada é essencial para potencializar a concentração, a memória e o rendimento durante os estudos.</p>
              </div>
              <div class="btn-carousel">
                <button>
                  <a href="#cardapio">Ver Cardápio</a>
                </button>
                <button>
                  <a href="/cantinarepositorio/subpages/login.php">Fazer Login</a>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-controls-bottom">
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      </div>
    </div>


    <div class="container-info">
      <div class="title-container-info">
        <h1>Porque escolher nossa cantina?</h1>
      </div>
      <div class="content-info">
        <div class="cards-info">
          <div class="icon-cards-info">
            <i class="fa-brands fa-envira" style="background-color: #bdd4cfff;color: #276254;"></i>
          </div>
          <div class="title-cards-info">
            <h1>
              Igredientes frescos
            </h1>
          </div>
          <div class="description-cards-info">
            <p>Utilizamos apenas ingredientes frescos e de qualidade, selecionados diariamente para garantir o melhor sabor e nutrição.</p>
          </div>
        </div>
        <div class="cards-info">
          <div class="icon-cards-info">
            <i class="fa-regular fa-heart" style="background-color: #dbc9c4ff; color: #d6390d"></i>
          </div>
          <div class="title-cards-info">
            <h1>
              Feito com Carinho
            </h1>
          </div>
          <div class="description-cards-info">
            <p>Cada refeição é preparada com dedicação pela nossa equipe, pensando na saúde e bem-estar dos nossos estudantes.</p>
          </div>
        </div>
        <div class="cards-info">
          <div class="icon-cards-info">
            <i class="fa-regular fa-star" style="background-color: #bdd4cfff;color: #276254;"></i>
          </div>
          <div class="title-cards-info">
            <h1>
              Qualidade Garantida
            </h1>
          </div>
          <div class="description-cards-info">
            <p>Seguimos rigorosos padrões de higiene e qualidade, garantindo refeições seguras e nutritivas todos os dias.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container-mais-pedidos">
      <div class="title-container-mp">
        <h1>Mais Pedidos</h1>
        <h5>Os pratos favoritos dos nossos estudantes! Experimente os sabores que conquistaram corações.</h5>
      </div>
  </main>

<section>
  <div class="container-cardapio">
    <div class="title-cardapio">
      <h1>Conheça nosso cardápio</h1>
      <p>
        Experimente nossa variedade de pratos deliciosos e saudáveis, feitos com ingredientes frescos e selecionados para você.
      </p>
    </div>

    <div class="options-cardapio">
      <div class="title-options">
        <button class="btn-option active">Salgados</button>
        <button class="btn-option">Folhados</button>
        <button class="btn-option">Doces</button>
        <button class="btn-option">Bebidas</button>
        <button class="btn-option">Outros</button>
      </div>
    </div>

    <div class="content-cardapio">
      <div class="content-cardapio-options active">
        <h1>SALGADOS</h1>
      </div>
      <div class="content-cardapio-options">
        <h1>FOLHADOS</h1>
      </div>
      <div class="content-cardapio-options">
        <h1>DOCES</h1>
      </div>
      <div class="content-cardapio-options">
        <h1>BEBIDAS</h1>
      </div>
      <div class="content-cardapio-options">
        <h1>OUTROS</h1>
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
              <iframe width="560" height="315" src="https://www.youtube.com/embed/O1iBfvighSo?si=v8wQ_udFzU5NITMl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--avaliações-->

  <section>

    <div class="tittle-avaliacoes" id="Avaliacoes">
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

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Swiper.js JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


  <script src="./assets/js/script.js"></script>
  <?php
  if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
    $query = "SELECT nome, cpf, turma FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    if ($result && mysqli_num_rows($result) > 0) {
      echo '<script src="./assets/js/modalalert.js"></script> ';
    }
  } else {

    echo '<script src="./assets/js/direcionamentocardapio.js"></script>';
  }
  ?>
</body>

</html>