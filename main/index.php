<?php
include('./database.php');
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

$user_data = null;
$is_admin = false;

if (isset($_SESSION['cpf'])) {
  $cpf = $_SESSION['cpf'];

  // Tenta buscar como cliente
  $query = "SELECT nome, cpf, turma, email FROM cliente WHERE cpf = '$cpf'";
  $result = mysqli_query($con, $query);
  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
  } else {
    // Tenta buscar como administrador
    $query = "SELECT nome, cpf, email FROM administradores WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      $is_admin = true;
    }
  }
}
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
  <title>FURA FILA - Main</title>
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
                <a href="/cantinarepositorio/subpages/cardapio.php"
                  style="text-decoration: none; color: inherit;">Cardápio</a>
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
        if ($is_admin) {
          echo '<div class="btn-admin">
                    <button type="button">
                      <a href="/cantinarepositorio/subpages/admin.php">
                         Acesso Admin
                      </a>
                    </button>
                  </div>';
        }

        if ($user_data) {
          echo '<div class="nav-buttons" style="gap:3vh;">';
          if (!$is_admin) {
            echo '<div class="btn-meus-pedidos">
                    <button type="button">
                      <a href="/cantinarepositorio/subpages/pedidos.php">
                        <i class="fa-solid fa-receipt"></i> Meus Pedidos
                      </a>
                    </button>
                  </div>';
          }
          echo '<div class="btn-user" id="btn-user-nav" >
                    <button>
                      <i class="fa-regular fa-user"></i> Perfil
                    </button>
                  </div>
                  <div class="btn-cart" id="btn-cart-nav">
                    <button><i class="fa-solid fa-cart-shopping"></i>Carrinho</button>
                  </div>
                </div>';
        } else {
          echo '  <div class="nav-buttons">
                <div class="btn-cadastrar-se">
                                <button type="button">
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
  <div class="overlay-pop-up-user" id="overlay-pop-up-user"></div>
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
                <?php echo $user_data ? $user_data['nome'] : ''; ?>
              </h3>
            </div>
            <div class="content-top-right-user-text-email">
              <h6>
                <?php echo $user_data ? $user_data['email'] : ''; ?>
              </h6>
            </div>
          </div>
        </div>
      </div>
      <div class="content-mid-user">
        <?php if (!$is_admin): ?>
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
                  <?php echo $user_data ? $user_data['turma'] : ''; ?>
                </h3>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($is_admin): ?>
          <div class="content-mid-user-row">
            <div class="content-mid-user-row-left">
              <div class="content-mid-user-row-left-icon">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
            </div>
            <div class="content-mid-user-row-right">
              <div class="content-mid-user-row-right-text">
                <h1>
                  Tipo de conta:
                </h1>
                <h3>
                  Administrador Principal
                </h3>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
                <?php echo $user_data ? $user_data['cpf'] : ''; ?>
              </h3>
            </div>
          </div>
        </div>
      </div>
      <div class="content-bottom-user">
        <div class="content-bottom-user-row">
          <?php if (!$is_admin): ?>
            <button type="button" class="btn-pop-up-editar-adm">
              <a href="/cantinarepositorio/subpages/editar_cliente_page.php">
                <i class="fa-regular fa-pen-to-square"></i>
                Editar
              </a>
            </button>
          <?php endif; ?>
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

  <!--Popup carrinho-->
  <div class="pop-up-cart" id="pop-up-cart">
    <div class="content-pp-cart">
      <!--Buttons top carrinho-->

      <button id="btn-bag-carrinho">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-bag-check"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
          <path
            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
        </svg> Carrinho
      </button>

      <button id="btn-close-cart-nav">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <button id="btn-limpar-carrinho" style=" display: none;">
        <i class="fa-solid fa-trash-can"></i> Esvaziar
      </button>

      <div class="content-pp-cart-top">
        <div class="divisao-top">

        </div>
        <div class="cart-title">
          <h6 class="cart-title-h6" style=" display: none;">
            Itens Adicionados:
          </h6>
        </div>
        <div class="barra-divisao" style=" display: none;">

        </div>
      </div>
      <div class="content-pp-cart-bottom">
        <div class="cart-items">
          <div class="container-items">
            <div class="swiper">
              <div class="swiper-wrapper" id="carrinho-itens-wrapper">
              </div>
            </div>
            <div class="swiper-scrollbar"></div>
          </div>
        </div>

      </div>
      <div class="cart-total-price">
        <h5 class="cart-total-h5" style=" display: none;">Total:</h5 >
        <h6 class="cart-total-h6" style=" display: none;">R$ 00,00 <!--Price calculado--></h6>
      </div>
      <div class="finalizar-pedido">
        <button id="btn-finalizar-pedidos" style=" display: none;">
          Finalizar Pedido
        </button>
      </div>
    </div>
  </div>


  <!-- Overlay para o modal -->
  <div class="modal-overlay" id="modal-overlay"></div>

  <!-- Modal alert -->
  <div class="container-modal-alert" id="modal-alert">
    <div class="content-modal-alert">
      <div class="btnSair-modal-alert">
        <button class="btnCLoseModaL" style="cursor: pointer;">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="title-modal-alert">
        <i class="fa-regular fa-user"></i>
        <h1>
          Acesso Necessário
        </h1>
      </div>
      <div class="description-modal-alert">
        <p>Para continuar navegando e aproveitar todos os recursos, você precisa fazer login em sua conta.</p>
      </div>

      <div class="btn-modal-alert">
        <a class="a-link-btn-continuar" href="/cantinarepositorio/subpages/login.php"
          style="color: white; text-decoration: none;">Continuar</a>
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
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button id="a" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
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
                <p>Manter uma alimentação equilibrada é essencial para potencializar a concentração, a memória e o
                  rendimento durante os estudos.</p>
              </div>
              <div class="btn-carousel">
                <button type="button" class="btn-1-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
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
                <p>Um espaço onde estudantes se reúnem para compartilhar bons momentos, trocar ideias, fortalecer
                  amizades e criar memórias inesquecíveis.</p>
              </div>
              <div class="btn-carousel">
                <button type="button" class="btn-2-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
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
                <p>Aqui, cada refeição é preparada com carinho e ingredientes selecionados para garantir saúde, energia
                  e bem-estar aos nossos estudantes.</p>
              </div>
              <div class="btn-carousel">
                <button type="button" class="btn-3-carousel">
                  <a href="#cardapio">Ver Cardápio</a>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-controls-bottom">
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
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
            <p>Utilizamos apenas ingredientes frescos e de qualidade, selecionados diariamente para garantir o melhor
              sabor e nutrição.</p>
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
            <p>Cada refeição é preparada com dedicação pela nossa equipe, pensando na saúde e bem-estar dos nossos
              estudantes.</p>
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
            <p>Seguimos rigorosos padrões de higiene e qualidade, garantindo refeições seguras e nutritivas todos os
              dias.</p>
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
        <button class="botao-left-mp">
          <h1>
            < </h1>
        </button>
        <div class="carrosel-mais-pedidos">
          <div class="carrousel-track-mais-pedidos">

          </div>
        </div>
        <button class="botao-right-mp">
          <h1>
            >
          </h1>
        </button>
      </div>
    </div>


  </main>

  <!--SECTION CARDAPIO-->

  <section>
    <div class="container-cardapio" id="cardapio">
      <div class="title-cardapio">
        <h1>Conheça nosso cardápio</h1>
        <p>
          Experimente nossa variedade de pratos deliciosos e saudáveis, feitos com ingredientes frescos e selecionados
          para você.
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
          <?php
          $query = "SELECT * FROM estoque WHERE categoria = 'Salgados' AND in_main = 1 LIMIT 3";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
              ?>
              <div class="cards-salgados">
                <div class="cards-img">
                  <img src="/cantinarepositorio/subpages/imgbd/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="cards-title">
                  <h3><?php echo $row['Nome']; ?></h3>
                </div>
                <div class="cards-priceEbtn">
                  <h4><?php echo $row['preco']; ?></h4>
                  <button><i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <?php
            }
          }
          ?><!--
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
          </div>-->
        </div>
        <div class="content-cardapio-options">
          <!--FOLHADOS-->
          <?php
          $query = "SELECT * FROM estoque WHERE categoria = 'Folhados' AND in_main = 1 LIMIT 3";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
              ?>
              <div class="cards-salgados">
                <div class="cards-img">
                  <img src="/cantinarepositorio/subpages/imgbd/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="cards-title">
                  <h3><?php echo $row['Nome']; ?></h3>
                </div>
                <div class="cards-priceEbtn">
                  <h4><?php echo $row['preco']; ?></h4>
                  <button><i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
        <div class="content-cardapio-options">
          <!--DOCES-->
          <?php
          $query = "SELECT * FROM estoque WHERE categoria = 'Doces' AND in_main = 1 LIMIT 3";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
              ?>
              <div class="cards-salgados">
                <div class="cards-img">
                  <img src="/cantinarepositorio/subpages/imgbd/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="cards-title">
                  <h3><?php echo $row['Nome']; ?></h3>
                </div>
                <div class="cards-priceEbtn">
                  <h4><?php echo $row['preco']; ?></h4>
                  <button><i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
        <div class="content-cardapio-options">
          <!--Bebidas-->
          <?php
          $query = "SELECT * FROM estoque WHERE categoria = 'Bebidas' AND in_main = 1 LIMIT 3";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
              ?>
              <div class="cards-salgados">
                <div class="cards-img">
                  <img src="/cantinarepositorio/subpages/imgbd/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="cards-title">
                  <h3><?php echo $row['Nome']; ?></h3>
                </div>
                <div class="cards-priceEbtn">
                  <h4><?php echo $row['preco']; ?></h4>
                  <button><i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <?php
            }
          }
          ?>
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
              <a href="/cantinarepositorio/subpages/termos.php" style="color: inherit; text-decoration: none;">Saiba
                Mais</a>
            </button>
          </div>
        </div>

        <div class="content-right">
          <div class="movie" id="video-container">
            <div class="ratio ratio-16x9">
              <iframe style="border-radius: 2vh;" width="560" height="315"
                src="https://www.youtube.com/embed/O1iBfvighSo?si=v8wQ_udFzU5NITMl" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
      <p>A opinião da nossa comunidade escolar é o que mais importa para nós. Veja o que estudantes, professores e
        funcionários têm a dizer.</p>
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
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
            </div>
            <div class="cards-avaliacao">
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
            </div>
            <div class="cards-avaliacao">
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row-cards-avaliacao">
            <div class="cards-avaliacao">
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
            </div>
            <div class="cards-avaliacao">
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
            </div>
            <div class="cards-avaliacao">
              <div class="cards-avaliacao-top">
                <div class="icon-user-avaliacao">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="title-user-info">
                  <h1>
                    Maria Silva
                  </h1>
                  <p>
                    Estudante do 3º ano ADM
                  </p>
                </div>
                <div class="icon-avaliacao">
                  <i class="fa-solid fa-quote-right"></i>
                </div>
              </div>
              <div class="cards-avaliacao-mid">
                <div class="stars-avaliacao-2">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>
              <div class="cards-avaliacao-bottom">
                <div class="description-avaliacao">
                  <p>
                    "A comida da cantina é incrível! O sanduíche natural é o meu favorito e sempre muito fresco. A
                    equipe é super simpática e o atendimento é rápido."
                  </p>
                </div>
              </div>
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
    <div class="container-footer">
      <div class="content-footer">
        <div class="content-top-footer">
          <div class="item-footer">
            <div class="info-cantina-img">
              <img src="./assets/img/logo-footer.png" alt="">
            </div>
            <div class="info-cantina-description">
              <p>Alimentando conhecimento e criando memórias através de sabores únicos há mais de 10 anos na nossa
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
                  <h6 style="width: 50%;">
                    <a href="#inicio">Início</a>
                  </h6>
                </li>
                <li>
                  <h6>
                    <a href="#cardapio">Cardápio</a>
                  </h6>
                </li>
                <li>
                  <h6>
                    <a href="#Sobre_Nos">Sobre Nós</a>
                  </h6>
                </li>
                <li>
                  <h6>
                    <a href="#Avaliacoes">Avaliações</a>
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
                  <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i> Manha: 10:00 -
                    10:20.</h6>
                </li>
                <li>
                  <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i> Tarde: 16:00 -
                    16:20.</h6>
                </li>
                <li>
                  <h6 style="width: 235%; display:flex; gap: 1vh; padding-bottom:2vh;"><i class="fa-solid fa-clock"></i>
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

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Swiper.js JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


  <!--LINKS DO JS-->
  <script src="./assets/js/pages/script.js"></script>
  <script src="./assets/js/functions/navbar.js"></script>
  <script src="./assets/js/functions/carrouselMP.js"></script>
  <script src="./assets/js/functions/carrinhoMain.js"></script>

  <!--LOGIN PHP VERIFICACAO-->
  <?php
  if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
    $query = "SELECT nome, cpf, turma FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    if ($result && mysqli_num_rows($result) > 0) {
      echo '<script src="./assets/js/functions/modalalert.js"></script> ';
    }
  } else {

    echo '<script src="./assets/js/pages/direcionamentocardapio.js"></script>';
  }
  ?>
</body>

</html>