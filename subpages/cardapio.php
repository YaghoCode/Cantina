<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
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
            <i class="fa-solid fa-caret-left"></i>
            Cardapio
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
                <a href="#Sobre-Nos" style="text-decoration: none; color:  #f0a956;">Doces</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#inicio" style="text-decoration: none; color: #a1735e;">Bebidas</a>
              </h1>
            </li>
            <li>
              <h1>
                <a href="#Cardapio" style="text-decoration: none; color: inherit;">Outros</a>
              </h1>
            </li>
          </ul>
        </div>
        <div class="nav-buttons">
          <div class="btn-user">
            <i class="fa-regular fa-user" id="btn-user-nav"></i>
          </div>
          <div class="btn-cart" id="btn-cart-nav">
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
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
              <Span>ALUNO:</Span> GABRIEL <!--ADICIONAR PHP-->
            </h4>
          </div>
          <div class="turma-user">
            <h4>
              <Span>TURMA:</Span> 3-DS manhã <!--Adicionar PHP-->
            </h4>
            <i class="fa-solid fa-pen"></i>
          </div>
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
    <div class="divisao-navbar" style="height: 15vh;">

    </div>

  <div class="container-salgados">
    <div class="title-salgados" id="salgados">
      <h1>
        Salgados
      </h1>
    </div>
    <div class="content-salgados">



    
      <div class="row-cards">

      <?php
$query = "SELECT * from estoque";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){

        foreach($query_run as $item){
            
           echo'<div class="cards-items">
          <div class="cards-items-left">
            <div class="title-cards-items">
              <h1>
                '. $item['Nome'].'
              </h1>
            </div>
            <div class="description-cards-items">
              <p>
                '.$item['Descricao'].'
              </p>
            </div>
            <div class="price-cards-items">
              <p>
                R$ 6,00
              </p>
            </div>
          </div>
          <div class="cards-items-right">
            <div class="cards-items-img">
              <img src="/main/assets/img/esfiha5.png" alt="">
            </div>
          </div>
    </div>
    ';
            
        }
    }

?>
        
  </div>

  <div class="container-folhados">
    <div class="title-folhados" id="folhados">
      <h1>
        Folhados
      </h1>
    </div>
    <div class="content-folhados">
        <div class="row-cards-f">
        <div class="cards-items">
          <div class="cards-items-left">
            <div class="title-cards-items">
              <h1>
                Croissant de Chocolate
              </h1>
            </div>
            <div class="description-cards-items-f">
              <p>
                Croissant de chocolate com massa folhada leve e recheio cremoso de chocolate, perfeito para quem busca um lanche doce e irresistível.
              </p>
            </div>
            <div class="price-cards-items">
              <p>
                R$ 7,00
              </p>
            </div>
          </div>
          <div class="cards-items-right">
            <div class="cards-items-img-f">
              <img src="/main/assets/img/croissant1.png" alt="">
            </div>
          </div>
        </div>
        <div class="cards-items">
          <div class="cards-items-left">
            <div class="title-cards-items">
              <h1>
                Croissant de Frango
              </h1>
            </div>
            <div class="description-cards-items-f">
              <p>
                Croissant de frango com massa folhada leve e recheio cremoso de frango temperado, perfeito para quem busca um lanche salgado e sofisticado.
              </p>
            </div>
            <div class="price-cards-items">
              <p>
                R$ 7,00
              </p>
            </div>
          </div>
          <div class="cards-items-right">
            <div class="cards-items-img-f">
              <img src="/main/assets/img/croissant-frango.png" alt="">
            </div>
          </div>
        </div>
        <div class="cards-items">
          <div class="cards-items-left">
            <div class="title-cards-items">
              <h1>
                Croissant de Calabresa
              </h1>
            </div>
            <div class="description-cards-items-f">
              <p>
                Croissant de calabresa com massa folhada leve e recheio saboroso de calabresa temperada, ideal para quem aprecia um lanche salgado e marcante.
              </p>
            </div>
            <div class="price-cards-items">
              <p>
                R$ 7,00
              </p>
            </div>
          </div>
          <div class="cards-items-right">
            <div class="cards-items-img-f">
              <img src="/main/assets/img/croissantcalabresa.png" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="row-cards-f">
          <div class="cards-items">
                <div class="cards-items-left">
                  <div class="title-cards-items">
                      <h1>
                        Folhado de 4 Queijos
                      </h1>
                  </div>
                    <div class="description-cards-items-f">
                        <p>
                            Folhado de 4 queijos com massa folhada leve e recheio cremoso de mussarela, parmesão, provolone e requeijão, perfeito para quem aprecia sabores intensos e sofisticados.
                        </p>
                    </div>
                      <div class="price-cards-items">
                          <p>
                            R$ 7,00
                          </p>
                      </div>     
                </div>
                  <div class="cards-items-right">
                        <div class="cards-items-img-f">
                           <img src="/main/assets/img/folhado4queijos.png" alt="">
                        </div>
                  </div>
            </div>
              <div class="cards-items">
                <div class="cards-items-left">
                  <div class="title-cards-items">
                      <h1>
                        Folhado de Palmito
                      </h1>
                  </div>
                    <div class="description-cards-items-f">
                        <p>
                            Folhado de palmito com massa folhada crocante e recheio cremoso de palmito temperado, ideal para quem busca um lanche leve e saboroso.
                        </p>
                    </div>
                      <div class="price-cards-items">
                          <p>
                            R$ 7,00
                          </p>
                      </div>     
                </div>
                  <div class="cards-items-right">
                        <div class="cards-items-img-f">
                           <img src="/main/assets/img/FolhadoPalmito.png" alt="">
                        </div>
                  </div>
            </div>
              <div class="cards-items">
                <div class="cards-items-left">
                  <div class="title-cards-items">
                      <h1>
                        Folhado de Carne
                      </h1>
                  </div>
                    <div class="description-cards-items-f">
                        <p>
                            Folhado de carne com massa folhada crocante e recheio suculento de carne temperada, perfeito para quem busca um lanche salgado e saboroso.
                        </p>
                    </div>
                      <div class="price-cards-items">
                          <p>
                            R$ 7,00
                          </p>
                      </div>     
                </div>
                  <div class="cards-items-right">
                        <div class="cards-items-img-f">
                           <img src="/main/assets/img/folhadoCarne.png" alt="">
                        </div>
                  </div>
            </div>
        </div>
      </div>
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