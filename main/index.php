<?php
include('./database.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--LINKS BOOSTRAP5 + FONTAWEASOME + SWIPER-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!--LINK CSS-->
  <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
  <title>Cantina PJ - Main</title>
</head>

<body>

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

        <!--PHP VERIFICAÇÂO LOGIN-->
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

  <!--MAIN-->
  <main>

    <!--Espaço navbar-->
    <div class="Espaco-navbar" id="inicio">
    </div>

    <!--Carousel-->

    <div class="container-carousel">
      <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
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
              <div class="title-carousel-2">
                <h1>Momentos especiais</h1>
                <h5>Criando memórias através da comida.</h5>
              </div>
              <div class="description-carousel-2">
                <p>Um espaço onde estudantes se reúnem para compartilhar bons momentos, trocar ideias, fortalecer amizades e criar memórias inesquecíveis.</p>
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
                <h1>Bem-vindo ao Coração da Escola</h1>
                <h5>Mais que uma cantina — um espaço de sabores, sorrisos e convivência.</h5>
              </div>
              <div class="description-carousel">
                <p>Aqui, cada refeição é preparada com carinho e ingredientes selecionados para garantir saúde, energia e bem-estar aos nossos estudantes.</p>
              </div>
              <div class="btn-carousel">
                <button class="btn-3-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
                </button>
                <button class="btn-3-carousel">
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

    <!--INFO USER POS CAROUSEL-->

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

    <!--MAIS PEDIDOS-->

    <div class="container-mais-pedidos">
      <div class="title-container-mp">
        <h1>Mais Pedidos</h1>
        <h5>Os pratos favoritos dos nossos estudantes! Experimente os sabores que conquistaram corações.</h5>
      </div>
        <div class="content-mais-pedidos">
          <button class="botao-left-mp">‹</button>
            <div class="carrosel-mais-pedidos">
              <div class="carrousel-track-mais-pedidos">
                
              </div>
            </div>
          <button class="botao-right-mp">›</button>
        </div>
    </div>


  </main>

  <!--SECTION CARDAPIO-->

  <section>
    <div class="container-cardapio" id="cardapio">
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
          <!--SALGADOS-->
          <div class="cards-salgados">
            <div class="cards-img">
              <img src="./assets/img/esfihadecarne.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Esfiha de Carne</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 6,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-salgados">
            <div class="cards-img">
              <img src="./assets/img/coxinha2.webp" alt="">
            </div>
            <div class="cards-title">
              <h3>Esfiha de Frango</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 6,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-salgados">
            <div class="cards-img">
              <img src="./assets/img/esfihadefrango.jfif" alt="">
            </div>
            <div class="cards-title">
              <h3>Esfiha de Frango</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 6,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        </div>
        <div class="content-cardapio-options">
          <!--FOLHADOS-->
          <div class="cards-folhados">
            <div class="cards-img">
              <img class="img-folhados" src="./assets/img/croissant-chocolate2.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Croassaint de Chocolate</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-folhados">
            <div class="cards-img">
              <img src="./assets/img/folhado-1.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Folhado de Carne</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-folhados">
            <div class="cards-img">
              <img src="./assets/img//folhado-2.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Folhado de 4 Queijo</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        </div>
        <div class="content-cardapio-options">
          <!--DOCES-->
          <div class="cards-doces">
            <div class="cards-img">
              <img src="./assets/img/beijinho2.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Beijinho Und.</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 3,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-doces">
            <div class="cards-img">
              <img src="./assets/img/brigadeiro2.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Brigadeiro Und.</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 3,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-doces">
            <div class="cards-img">
              <img src="./assets/img/bolochocolate.jpg" alt="">
            </div>
            <div class="cards-title">
              <h3>Bolo de Chocolate Fatia</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        </div>
        <div class="content-cardapio-options">
          <!--Bebidas-->
          <div class="cards-bebidas">
            <div class="cards-img">
              <img src="./assets/img/coca350.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Coca Cola 350ml.</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 8,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-bebidas">
            <div class="cards-img">
              <img src="./assets/img/cocazero2.webp" alt="">
            </div>
            <div class="cards-title">
              <h3>Coca Cola Zero 350ml.</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 8,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-bebidas">
            <div class="cards-img">
              <img src="./assets/img/agua.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Água 510ml.</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 3,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        </div>
        <div class="content-cardapio-options">
          <!--Outros-->
          <div class="cards-outros">
            <div class="cards-img">
              <img src="./assets/img/combo1.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Pizza + Doly</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 25,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-outros">
            <div class="cards-img">
              <img src="./assets/img/combo1.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Combo Lanche + Refri</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 10,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>

          <div class="cards-outros">
            <div class="cards-img">
              <img src="./assets/img/combo1.png" alt="">
            </div>
            <div class="cards-title">
              <h3>Combo Lanche + Brigadeiro</h3>
            </div>
            <div class="cards-priceEbtn">
              <h4>R$ 8,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
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
              <iframe width="560" height="315" src="https://www.youtube.com/embed/O1iBfvighSo?si=v8wQ_udFzU5NITMl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--SECTION avaliações-->

  <section>

    <div class="tittle-avaliacoes" id="Avaliacoes">
      <h1>
        Nossas Avaliações
      </h1>
        <p>A opinião da nossa comunidade escolar é o que mais importa para nós. Veja o que estudantes, professores e funcionários têm a dizer.</p>
    </div>
    <div class="container-avaliacoes">
      <div class="content-avaliacoes">
          <div class="content-avaliacoes-top">
              <div class="item-avaliacao">
                  <div class="nota-avaliacao">
                      <h1>4.8</h1>
                  </div>
                    <div class="stars-avaliacao">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half"></i>
                    </div>
                      <div class="item-title">
                        <h2>Avaliação Média</h2>
                      </div>
              </div>
              <div class="item-avaliacao">
                  <div class="numero-avaliacao">
                      <h1>49</h1> <i class="fa-solid fa-plus"></i>
                  </div>
                    <div class="item-title-2">
                        <h2>Avaliações Positivas</h2>
                    </div>
              </div>
              <div class="item-avaliacao">
                    <div class="numero-avaliacao-2">
                      <h1>92%</h1>
                    </div>
                      <div class="item-title">
                        <h2>Clientes Satisfeitos</h2>
                      </div>
              </div>
          </div>
            <div class="content-avaliacoes-bottom">
                  <div class="row-cards-avaliacao">
                      <div class="cards-avaliacao">

                      </div>
                      <div class="cards-avaliacao">

                      </div>
                      <div class="cards-avaliacao">

                      </div>
                  </div>
                    <div class="row-cards-avaliacao">
                      <div class="cards-avaliacao">

                      </div>
                      <div class="cards-avaliacao">

                      </div>
                      <div class="cards-avaliacao">

                      </div>
                    </div>
            </div>
      </div>
    </div>
  </section>

  <!--DIVISAO-->

  <div class="container-divisao-3">
    <div class="divisao-3"></div>
  </div>

  <!--FOOTER-->

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


  <!--LINKS DO JS-->
  <script src="./assets/js/script.js"></script>
  <script src="./assets/js/navbar.js"></script>
  <script src="./assets/js/carrouselMP.js"></script>

  <!--LOGIN PHP VERIFICACAO-->
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