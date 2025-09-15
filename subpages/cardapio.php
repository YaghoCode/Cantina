<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();


if (isset($_SESSION['cpf'])) {
} else {
  header("Location: /cantinarepositorio/subpages/login.php");
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
  <link rel="stylesheet" type="text/css" href="./assets/css/cardapio.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title>FURA FILA - Cardápio</title>

</head>

<body class="body">

  <!-- header, navbar -->
  <header>
    <nav class="navbar">
      <div class="nav-links">
        <div class="nav-btn-cardapio">
          <h1>
            <a href="/cantinarepositorio/main/index.php" style="color: inherit; text-decoration:none;"> <i class="fa-solid fa-caret-left"></i> Cardapio</a>
          </h1>
        </div>

        <div class="nav-items">
          <ul>
            <li>
              <h1>
                <a class="nav-items-ul-s" href="#salgados">Salgados</a>
              </h1>
            </li>
            <li>
              <h1>
                <a class="nav-items-ul-f" href="#folhados">Folhados</a>
              </h1>
            </li>
            <li>
              <h1>
                <a class="nav-items-ul-d" href="#doces">Doces</a>
              </h1>
            </li>
            <li>
              <h1>
                <a class="nav-items-ul-b" href="#bebidas">Bebidas</a>
              </h1>
            </li>
            <li>
              <h1>
                <a class="nav-items-ul-o" href="#outros">Outros</a>
              </h1>
            </li>
          </ul>
        </div>
        <?php
        if (isset($_SESSION['cpf'])) {
          $cpf = $_SESSION['cpf'];
          $query = "SELECT nome, cpf, turma, email FROM cliente WHERE cpf = '$cpf'";
          $result = mysqli_query($con, $query);
          $user_data = mysqli_fetch_assoc($result);

          if ($result && mysqli_num_rows($result) > 0) {

            echo '<div class="nav-buttons" style="gap:3vh;">
                  <div class="btn-user" id="btn-user-nav" >
                    <button>
                      <i class="fa-regular fa-user"></i> Perfil
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
              <?php echo $user_data['nome']; ?>
            </h6>
            <p>
              <?php echo $user_data['email']; ?>
            </p>
          </div>
        </div>
        <div class="top-info-user">
          <div class="top-info-user-text">
            <h6>
              Turma: <?php echo $user_data['turma']; ?>
            </h6>
            <p>
              CPF: <?php echo $user_data['cpf']; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="content-pp-bottom">
        <a href="/cantinarepositorio/subpages/logout.php" style="text-decoration: none;">Logout</a>
      </div>
    </div>
  </div>


  <!--Popup carrinho-->
  <div class="pop-up-cart" id="pop-up-cart">
    <div class="content-pp-cart">
      <div class="content-pp-cart-top" id="btn-close-cart-nav">
        <button>
          <i class="fa-solid fa-xmark"></i>
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
                  <div class="swiper-slide p-3 border rounded">
                      <div class="carrinho-item">
                    <div class="carrinho-item-left">
                      <div class="carrinho-item-img">
                        <img src="./assets/img/img comidas/croissant2.png" alt="">
                      </div>
                    </div>
                    <div class="carrinho-item-right">
                      <div class="carrinho-item-title">
                        <h3>Coxinha de Frango</h3>
                      </div>
                      <div class="carrinho-item-calc-preco">
                        <div class="carrinho-item-quantidade">
                            <button class="btn-decrement">-</button>
                              <input type="number" class="input-quantidade" value="1" min="1" max="99" step="1">
                              <button class="btn-increment">+</button>
                        </div>
                          
                          <div class="carrinho-item-preco">
                            <p>R$ 6,00</p>
                          </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 1</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 1</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 1</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
                  <div class="swiper-slide p-3 border rounded">Slide 1</div>
                  <div class="swiper-slide p-3 border rounded">Slide 2</div>
                  <div class="swiper-slide p-3 border rounded">Slide 3</div>
              </div>
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



  <!--Main-->
  <div class="divisao-navbar" style="height: 10vh;">

  </div>

  <div class="container-salgados">
    <div class="title-salgados" id="salgados">
      <h1>Salgados</h1>
    </div>
    <div class="content-salgados">
      <?php
      $query = "SELECT * from estoque WHERE categoria = 'Salgados'";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {

          echo '
                      <div class="cards-items">
                        <div class="cards-items-top">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                          </div>
                        </div>
                        <div class="cards-items-bottom">
                          <div class="title-cards-items">
                            <h1>' . $item['Nome'] . '</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>' . $item['Descricao'] . '</p>
                          </div>
                          <div class="price-cards-items">
                            <div class="price-cards-items-p">
                              <p>R$ ' . $item['preco'] . '</p>
                            </div>
                              <div class="price-cards-items-button">
                                  <button class="cardapio-btn-cards">
                                      <i class="fa-solid fa-circle-plus" style="color: #276264;"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </div>';
        }
      }
      ?>
    </div>
  </div>

  <!--FOLHADOS-->

  <div class="container-folhados">
    <div class="title-folhados" id="folhados">
      <h1>
        Folhados
      </h1>
    </div>
    <div class="content-folhados">
      <?php
      $query = "SELECT * from estoque WHERE categoria = 'Folhados'";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {

          echo '
                      <div class="cards-items">
                        <div class="cards-items-top">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                          </div>
                        </div>
                        <div class="cards-items-bottom">
                          <div class="title-cards-items">
                            <h1>' . $item['Nome'] . '</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>' . $item['Descricao'] . '</p>
                          </div>
                          <div class="price-cards-items">
                            <div class="price-cards-items-p">
                              <p>R$ ' . $item['preco'] . '</p>
                            </div>
                              <div class="price-cards-items-button">
                                  <button class="cardapio-btn-cards">
                                      <i class="fa-solid fa-circle-plus" style="color: #276264;"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </div>';
        }
      }
      ?>
    </div>
  </div>

  <!--DOCES-->

  <div class="container-doces">
    <div class="title-doces" id="doces">
      <h1>
        Doces
      </h1>
    </div>
    <div class="content-doces">
      <?php
      $query = "SELECT * from estoque WHERE categoria = 'Doces'";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {

          echo  '
                      <div class="cards-items">
                        <div class="cards-items-top">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                          </div>
                        </div>
                        <div class="cards-items-bottom">
                          <div class="title-cards-items">
                            <h1>' . $item['Nome'] . '</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>' . $item['Descricao'] . '</p>
                          </div>
                          <div class="price-cards-items">
                            <div class="price-cards-items-p">
                              <p>R$ ' . $item['preco'] . '</p>
                            </div>
                              <div class="price-cards-items-button">
                                  <button class="cardapio-btn-cards">
                                      <i class="fa-solid fa-circle-plus" style="color: #276264;"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </div>';
        }
      }
      ?>
    </div>
  </div>

  <!--BEBIDAS-->
  <div class="container-bebidas">
    <div class="title-bebidas" id="bebidas">
      <h1>
        Bebidas
      </h1>
    </div>
    <div class="content-bebidas">
      <?php
      $query = "SELECT * from estoque WHERE categoria = 'Bebidas'";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {

          echo  '
                      <div class="cards-items">
                        <div class="cards-items-top">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                          </div>
                        </div>
                        <div class="cards-items-bottom">
                          <div class="title-cards-items">
                            <h1>' . $item['Nome'] . '</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>' . $item['Descricao'] . '</p>
                          </div>
                          <div class="price-cards-items">
                            <div class="price-cards-items-p">
                              <p>R$ ' . $item['preco'] . '</p>
                            </div>
                              <div class="price-cards-items-button">
                                  <button class="cardapio-btn-cards">
                                      <i class="fa-solid fa-circle-plus" style="color: #276264;"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </div>';
        }
      }
      ?>
    </div>
  </div>

  <!--Outros-->
  <div class="container-outros">
    <div class="title-outros" id="outros">
      <h1>
        Outros
      </h1>
    </div>
    <div class="content-outros">
      <?php
      $query = "SELECT * from estoque WHERE categoria = 'Outros'";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {

          echo  '
                      <div class="cards-items">
                        <div class="cards-items-top">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                          </div>
                        </div>
                        <div class="cards-items-bottom">
                          <div class="title-cards-items">
                            <h1>' . $item['Nome'] . '</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>' . $item['Descricao'] . '</p>
                          </div>
                          <div class="price-cards-items">
                            <div class="price-cards-items-p">
                              <p>R$ ' . $item['preco'] . '</p>
                            </div>
                              <div class="price-cards-items-button">
                                  <button class="cardapio-btn-cards">
                                      <i class="fa-solid fa-circle-plus" style="color: #276264;"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </div>';
        }
      }
      ?>
    </div>
  </div>

  <!-- Overlay para o modal -->
  <div class="modal-overlay-cardapio" id="modal-overlay-cardapio"></div>

  <!-- Modal alert -->
  <div class="container-modal-cardapio" id="modal-cardapio">
    <div class="content-modal-cardapio">
        <div class="content-modal-cardapio-left">
            <div class="modal-left-img">
                <img src="/cantinarepositorio/main/assets/img/carousel-img-3.png" alt="">
            </div>
        </div>
          <div class="content-modal-cardapio-right">
            <button class="btn-close-modaL" id="btn-close-modaL">
              <i class="fa-solid fa-xmark"></i>
            </button>
                <div class="modal-right-title">
                    <h3>Coxinha de Frango</h3>
                </div>
                  <div class="modal-right-description">
                      <p>
                        a a a a a aa a a aaaa Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi illum facere suscipit deserunt neque ipsa ipsum veritatis iure consequatur odit, unde magnam dolor velit fugit eaque sed quo exercitationem tenetur.
                      </p>
                  </div>
                      <div class="modal-right-conteudo">
                        <div class="modal-right-quantidade">
                            <button class="btn-decrement">-</button>
                              <input type="number" class="input-modal-quantidade" value="1" min="1" max="99" step="1">
                            <button class="btn-increment">+</button>
                        </div>
                          <div class="modal-right-preco">
                              <h4>R$ 00,00</h4>
                          </div>
                      </div>
          </div>
    </div>
  </div>





  <script type="module" src="./assets/js/cardapioModal.js"></script>
  <script type="module" src="./assets/js/cardapio.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- Swiper.js JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>


<?php
mysqli_close($con);
?>