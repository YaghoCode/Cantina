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

  <!--Popup carrinho-->
  <div class="pop-up-cart" id="pop-up-cart">
    <div class="content-pp-cart">
      <!--Buttons top carrinho-->

      <button id="btn-bag-carrinho">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
          <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
        </svg> Carrinho
      </button>

      <button id="btn-close-cart-nav">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <button id="btn-limpar-carrinho">
        <i class="fa-solid fa-trash-can"></i> Esvaziar
      </button>

      <div class="content-pp-cart-top">
        <div class="divisao-top">

        </div>
        <div class="cart-title">
          <h6>
            Itens Adicionados:
          </h6>
        </div>
        <div class="barra-divisao">

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
        <h5>Total:</h5>
        <h6>R$ 00,00 <!--Price calculado--></h6>
      </div>
      <div class="finalizar-pedido">
        <button id="btn-finalizar-pedidos">
          Finalizar Pedido
        </button>
      </div>
    </div>
  </div>



  <!--Main-->
  <div class="divisao-navbar" style="height: 10vh;">

  </div>

  <!--SALGADOS-->
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
                      <div class="cards-items" data-id="' . $item['id'] . '">
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
                      <div class="cards-items" data-id="' . $item['id'] . '">
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

          echo  ' . $i
                      <div class="cards-items" data-id="' . $item['id'] . '">
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
                      <div class="cards-items" data-id="' . $item['id'] . '">
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
                      <div class="cards-items" data-id="' . $item['id'] . '">
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

  <?php //Modal Cardapio
  $query = "SELECT * from estoque";
  $query_run = mysqli_query($con, $query);

  if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $item) {
      echo '
        <div class="container-modal-cardapio" id="modal-' . $item['id'] . '">
            <div class="content-modal-cardapio" 
                 data-id="' . $item['id'] . '" 
                 data-nome="' . $item['Nome'] . '" 
                 data-descricao="' . $item['Descricao'] . '" 
                 data-preco="' . $item['preco'] . '"  
                 data-img="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '">
                 
                <div class="content-modal-cardapio-left">
                    <div class="modal-left-img">
                        <img src="/cantinarepositorio/subpages/imgbd/' . $item['img'] . '" alt="">
                    </div>
                </div>

                <div class="content-modal-cardapio-right">
                    <button class="btn-close-modaL">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="modal-right-title">
                        <h3>' . $item['Nome'] . '</h3>
                    </div>
                    <div class="modal-right-description">
                        <p>' . $item['Descricao'] . '</p>
                    </div>
                    <div class="modal-right-conteudo">
                        <div class="modal-right-quantidade">
                            <button class="btn-decrement">-</button>
                            <input type="number" class="input-modal-quantidade" value="1" min="1" max="99" step="1">
                            <button class="btn-increment">+</button>
                        </div>
                    </div>
                    <div class="modal-right-adicionar">
                        <div class="modal-right-preco">
                            <h4>R$ ' . $item['preco'] . '</h4>
                        </div>
                        <button class="btn-mandar" id="btn' . $item['id'] . '">
                            Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>';
    }
  }
  ?>


  <div class="modal-overlay-cardapio" id="modal-overlay-cardapio"></div>


  <script>
    //modal cardapio ///////////////////////////////////////

    const btnCardapioCards = document.querySelectorAll('.cards-items');
    const overlayModalCardapio = document.getElementById('modal-overlay-cardapio');

    btnCardapioCards.forEach(card => {
      const modalId = card.getAttribute('data-id');
      const modalCardapio = document.getElementById('modal-' + modalId);

      card.addEventListener('click', () => {
        if (modalCardapio) {
          modalCardapio.classList.add('active');
          overlayModalCardapio.classList.add('active');
        }
      });
    });

    //////////// atribuindo id modal acima 

    document.querySelectorAll('.btn-close-modaL').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.container-modal-cardapio').forEach(modal => {
          modal.classList.remove('active');
        });
        overlayModalCardapio.classList.remove('active');
      });
    });

    overlayModalCardapio.addEventListener('click', () => {
      document.querySelectorAll('.container-modal-cardapio').forEach(modal => {
        modal.classList.remove('active');
      });
      overlayModalCardapio.classList.remove('active');
    });

    //////////////////////fecha o modal e o overlay com o button close


    //funcoes carrinho////////////////////////////////////


    function atualizarCarrinhoVisual() {
      const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
      const container = document.getElementById('carrinho-itens-wrapper');
      container.innerHTML = '';

      let total = 0;

      carrinho.forEach(item => {
        const subtotal = item.preco * item.quantidade;
        total += subtotal;

        const slide = document.createElement('div');
        slide.classList.add('swiper-slide', 'p-3', 'border', 'rounded');

        slide.innerHTML = `
      <div class="carrinho-item">
        <div class="carrinho-item-left">
          <div class="carrinho-item-img">
           <img src="${item.img}" alt="">
          </div>
        </div>
        <div class="carrinho-item-right">
          <div class="carrinho-item-title">
            <h3>${item.nome}</h3>
          </div>
          <div class="carrinho-item-calc-preco">
            <div class="carrinho-item-quantidade">
              <button class="btn-decrement" data-id="${item.id}">-</button>
              <input type="number" class="input-quantidade" value="${item.quantidade}" min="1" max="99" step="1" data-id="${item.id}">
              <button class="btn-increment" data-id="${item.id}">+</button>
            </div>
            <div class="carrinho-item-preco">
              <p>R$ ${(subtotal).toFixed(2)}</p>
            </div>
          </div>
        </div>
      </div>
    `;

        container.appendChild(slide);
      });

      // Atualiza o total:
      document.querySelector('.cart-total-price h6').textContent = `R$: ${total.toFixed(2)}`;

      addCarrinhoListeners();
      if (carrinho.length === 0) {
        container.innerHTML = '<div class="carrinho-vazio"> <div class="carrinho-vazio-content"> <div class="carrinho-vazio-content-top"> <div class="carrinho-vazio-content-top-icon"> <i class="fa-solid fa-basket-shopping"></i> </div> </div> <div class="carrinho-vazio-content-bottom"> <div class="carrinho-vazio-content-bottom-text"> <h1>Seu carrinho está vazio</h1> <p>Adicione produtos de nosso cardápio para concluir sua compra. </p> </div> </div> </div> </div>';
        totalEl.textContent = "R$ 00,00";
        return;
      }
    }

    /////////////////limpa carrinho

    function limparCarrinho() {
      localStorage.removeItem('carrinho'); // Remove o carrinho do armazenamento
      atualizarCarrinhoVisual(); // Atualiza a interface
    }

    document.getElementById('btn-limpar-carrinho').addEventListener('click', () => {
      if (confirm("Tem certeza que quer limpar o carrinho?")) {
        limparCarrinho();
      }
    });

    function abrirCarrinhoModal() {
      const containerPopUpCart = document.getElementById('pop-up-cart');
      containerPopUpCart.classList.add('active');

    }


    ////////////// funcao modal + carrinho (manda o item do modal para o carrinho)

    document.querySelectorAll('.btn-mandar').forEach(btn => {
  btn.addEventListener('click', function() {
    const itemDiv = this.closest('.content-modal-cardapio');
    const id = itemDiv.dataset.id;
    const nome = itemDiv.dataset.nome;
    const descricao = itemDiv.dataset.descricao;
    const preco = parseFloat(itemDiv.dataset.preco);

    // Pegue o valor do input de quantidade do modal
    const quantidadeInput = itemDiv.querySelector('.input-modal-quantidade');
    let quantidade = 1;
    if (quantidadeInput) {
      quantidade = parseInt(quantidadeInput.value) || 1;
    }

    const item = {
      id: id,
      nome: nome,
      descricao: descricao,
      preco: preco,
      quantidade: quantidade, // <-- Agora pega o valor do input!
      img: itemDiv.dataset.img
    };

    // 🧠 Salvar no localStorage (adicionando ao carrinho local)
    let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

    const existente = carrinho.find(i => i.id === id);
    if (existente) {
      existente.quantidade += quantidade; // Soma a quantidade escolhida
    } else {
      carrinho.push(item);
    }

    localStorage.setItem('carrinho', JSON.stringify(carrinho));

    document.querySelectorAll('.container-modal-cardapio').forEach(modal => {
      modal.classList.remove('active');
    });
    overlayModalCardapio.classList.remove('active');
    atualizarCarrinhoVisual();
    abrirCarrinhoModal();
  });
});

    /////input butao quantidade carrinho items

    function addCarrinhoListeners() {
      const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

      //Botões de incremento
      document.querySelectorAll('.btn-increment').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.dataset.id;
          const item = carrinho.find(i => i.id === id);
          if (item) {
            item.quantidade++;
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
            atualizarCarrinhoVisual();
          }
        })
      })

      //Botões de decremento 
      document.querySelectorAll('.btn-decrement').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.dataset.id;
          const item = carrinho.find(i => i.id === id);
          if (item && item.quantidade > 1) {
            item.quantidade--;
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
            atualizarCarrinhoVisual();
          }
        })
      })

      //Inputs de quantidade
      document.querySelectorAll('.input-quantidade').forEach(input => {
        input.addEventListener('change', () => {
          const id = input.dataset.id;
          const item = carrinho.find(i => i.id === id);
          let valor = parseInt(input.value);

          if (item) {
            if (isNaN(valor) || valor < 1) valor = 1;
            if (valor > 99) valor = 99;

            item.quantidade = valor;
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
            atualizarCarrinhoVisual();
          }
        })
      })
    }
    atualizarCarrinhoVisual();

    ////////////////////////////////////////
  </script>


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