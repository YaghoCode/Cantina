<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();


  if (isset($_SESSION['cpf'])) {

        }else{
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
  <title>Cantina PJ - Cardapio</title>

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
                <a href="#salgados" style="text-decoration: none; color: #f0a956;">Salgados</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#folhados" style="text-decoration: none; color: #a1735e;">Folhados</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#doces" style="text-decoration: none; color:  #f0a956;">Doces</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#bebidas" style="text-decoration: none; color: #a1735e;">Bebidas</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#outros" style="text-decoration: none; color: inherit;">Outros</a>
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
                                <a href="/subpages/login.php" style=" color:inherit; text-decoration:none;">Cadastrar</a>
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
              TURMA:  <?php echo $user_data['turma']; ?> <!--Adicionar PHP-->
            </h4>
          </div>
          <div class="logout-user">
              <button style="    border: none;">
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



  <!--Main-->
    <div class="divisao-navbar" style="height: 12vh;">

    </div>

  <div class="container-salgados">
    <div class="title-salgados" id="salgados">
      <h1>Salgados</h1>
    </div>
      <div class="content-salgados">
            <?php
              $query = "SELECT * from estoque WHERE categoria = 'Salgados'";
              $query_run = mysqli_query($con, $query);

              if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $item){

                      echo '
                      <div class="cards-items">
                        <div class="cards-items-left">
                          <div class="title-cards-items">
                            <h1>'.$item['Nome'].'</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>'.$item['Descricao'].'</p>
                          </div>
                          <div class="price-cards-items">
                            <p>R$ '.$item['Preco'].'</p>
                          </div>
                        </div>
                        <div class="cards-items-right">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/'.$item['img'].'" alt="">
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

              if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $item){

                      echo '
                      <div class="cards-items">
                        <div class="cards-items-left">
                          <div class="title-cards-items">
                            <h1>'.$item['Nome'].'</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>'.$item['Descricao'].'</p>
                          </div>
                          <div class="price-cards-items">
                            <p>R$ '.$item['Preco'].'</p>
                          </div>
                        </div>
                        <div class="cards-items-right">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/'.$item['img'].'" alt="">
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

              if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $item){

                      echo '
                      <div class="cards-items">
                        <div class="cards-items-left">
                          <div class="title-cards-items">
                            <h1>'.$item['Nome'].'</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>'.$item['Descricao'].'</p>
                          </div>
                          <div class="price-cards-items">
                            <p>R$ '.$item['Preco'].'</p>
                          </div>
                        </div>
                        <div class="cards-items-right">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/'.$item['img'].'" alt="">
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

              if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $item){

                      echo '
                      <div class="cards-items">
                        <div class="cards-items-left">
                          <div class="title-cards-items">
                            <h1>'.$item['Nome'].'</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>'.$item['Descricao'].'</p>
                          </div>
                          <div class="price-cards-items">
                            <p>R$ '.$item['Preco'].'</p>
                          </div>
                        </div>
                        <div class="cards-items-right">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/'.$item['img'].'" alt="">
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

              if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $item){

                      echo '
                      <div class="cards-items">
                        <div class="cards-items-left">
                          <div class="title-cards-items">
                            <h1>'.$item['Nome'].'</h1>
                          </div>
                          <div class="description-cards-items">
                            <p>'.$item['Descricao'].'</p>
                          </div>
                          <div class="price-cards-items">
                            <p>R$ '.$item['Preco'].'</p>
                          </div>
                        </div>
                        <div class="cards-items-right">
                          <div class="cards-items-img">
                            <img src="/cantinarepositorio/subpages/imgbd/'.$item['img'].'" alt="">
                          </div>
                        </div>
                      </div>';
                  }
                }
            ?>
                      </div>
                </div>

  <script type="module" src="./assets/js/cardapio.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- Swiper.js JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>


<?php
if (isset($_SESSION['cpf'])) {
  $cpf = $_SESSION['cpf'];
  $query = "SELECT nome, cpf FROM cliente WHERE cpf = '$cpf'";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    echo "<h1>CPF: " . $user_data['cpf'] . "<br></h1>";
    echo "Nome: " . $user_data['nome'] . "<br>";
  } else {
    echo "";
  }
} else {
  echo "";
}


mysqli_close($con);
?>