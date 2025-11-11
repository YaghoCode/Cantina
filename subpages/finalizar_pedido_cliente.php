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

if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    // Tenta buscar como cliente
    $query = "SELECT nome, cpf, turma, email FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        header("Location: /cantinarepositorio/subpages/login.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/finalizar_pedido_cliente.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Meus Pedidos</title>

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
                        <li class="btn-voltar-finalizar-pedido">
                            <button type="button">
                                <a href="/cantinarepositorio/subpages/cardapio.php"><i
                                        class="fa-solid fa-arrow-left"></i></a>
                            </button>
                        </li>
                        <li class="finalizar-pedido-li">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box2" viewBox="0 0 16 16">
                                <path
                                    d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                            </svg>
                            Finalizar Pedido
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container-finalizar-pedido">
            <div class="content-finalizar-pedido">
                <div class="content-finalizar-pedido-left">
                    <div class="content-finalizar-pedido-left-top">
                        <div class="finalizar-pedido-left-top-title">
                            <h1></h1> <!--numero de itens no pedido-->
                        </div>
                    </div>
                    <div class="content-finalizar-pedido-left-bottom">
                        <div class="tabela-pedidos-resumo" id="tabela-pedidos-resumo">
                            
                        </div>
                    </div>
                </div>
                <div class="content-finalizar-pedido-right">
                    <div class="resumo-pedido">
                        <div class="resumo-pedido-top">
                            <div class="resumo-pedido-title">
                                <h1>Resumo do Pedido</h1>
                            </div>
                            <div class="resumo-pedido-info">
                                <div class="resumo-pedido-info-aluno">
                                    <h2>Aluno:</h2>
                                    <h3><?php echo $user_data['nome']; ?></h3>
                                </div>
                                <div class="resumo-pedido-info-itens">
                                    <h2>Total de Itens:</h2>
                                    <h3 id="carrinhoitenstotal"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="resumo-pedido-bottom">
                            <div class="resumo-pedido-total" id="preco_total">
                            <h2>Total:</h2>
                            <h3 id="precopreco"></h3>
                            </div>
                            <div class="resumo-pedido-buttons">
                                <button type="button" class="btn-ir-para-pagamento">
                                    <a href="/cantinarepositorio/subpages/pagamento_cliente_page.php">
                                        <i class="fa-regular fa-credit-card"></i>
                                        Ir para Pagamento
                                    </a>
                                </button>
                                <button type="button" class="btn-cancelar-finalizacao-pedido">
                                    <a href="/cantinarepositorio/main/index.php">Cancelar Pedido</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

        document.addEventListener('DOMContentLoaded', () => {
            atualizarTotal(); // Atualiza o total ao carregar a página
        });

        function aumentarQuantidade(button) {
            const input = button.previousElementSibling; // O input de quantidade
            let quantidade = parseInt(input.value);

            quantidade++;
            input.value = quantidade;

            atualizarSubtotal(button, quantidade);
            salvarCarrinhoNoLocalStorage(); // Salva no localStorage
        }

        function diminuirQuantidade(button) {
            const input = button.nextElementSibling; // O input de quantidade
            let quantidade = parseInt(input.value);

            if (quantidade > 1) {
                quantidade--;
                input.value = quantidade;

                atualizarSubtotal(button, quantidade);
                salvarCarrinhoNoLocalStorage(); // Salva no localStorage
            }
        }

        function salvarCarrinhoNoLocalStorage() {
            const carrinho = [];
            
            document.querySelectorAll('.item-pedido-resumo').forEach(item => {
                const nome = item.querySelector('.info-produto-nome h1').textContent;
                const preco = parseFloat(item.querySelector('.info-produto-preco h5').getAttribute('data-preco'));
                const quantidade = parseInt(item.querySelector('.input-quantidade').value);
                const img = item.querySelector('img').src;

                carrinho.push({
                    nome: nome,
                    preco: preco,
                    quantidade: quantidade,
                    img: img
                });
            });

            localStorage.setItem('carrinho', JSON.stringify(carrinho));
        }

        function atualizarSubtotal(button, quantidade) {
            const itemContainer = button.closest('.item-pedido-resumo');
            const precoEl = itemContainer.querySelector('.info-produto-preco h5');
            const precoUnitario = parseFloat(precoEl.getAttribute('data-preco'));
            const subtotalEl = itemContainer.querySelector('.subtotal-produto');

            const novoSubtotal = precoUnitario * quantidade;
            subtotalEl.textContent = `R$ ${novoSubtotal.toFixed(2)}`;
            
            atualizarTotal();
        }

        function atualizarTotal() {
            const subtotais = document.querySelectorAll('.subtotal-produto');
            let total = 0;

            subtotais.forEach(subtotalEl => {
                const subtotal = parseFloat(subtotalEl.textContent.replace('R$', '').trim());
                total += subtotal;
            });

            const totalEl = document.getElementById("precopreco"); // Elemento onde o total é exibido
        totalEl.textContent = `R$: ${total.toFixed(2)}`;
        console.log(total)
        }

        function atualizarCarrinhoVisual() {
            
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            const container = document.getElementById("tabela-pedidos-resumo");
            const totalEl = document.querySelector(".cart-total-price h6");
            const totalpreco = document.getElementById("preco_total");
            
            // Elementos para exibir quantidade total de itens
            const totalItensH3 = document.querySelector(".resumo-pedido-info-itens h3"); // Itens do pedido
            const totalItensH1 = document.querySelector(".finalizar-pedido-left-top-title h1"); // Total de itens

            container.innerHTML = ""; // Limpa itens antigos
            let total_itens = 0;
            let totalQuantidade = 0; // Contador de quantidade total de itens

            // Mostra itens do carrinho nos cards
            carrinho.forEach(item => {
                const subtotal = item.preco * item.quantidade;
                total_itens += subtotal;
                totalQuantidade += item.quantidade; // Soma as quantidades

                const slide = document.createElement("div");
                slide.innerHTML = `
           <div class="item-pedido-resumo">
                <div class="item-pedido-resumo-left">
                    <div class="imagem-produto">
                         <img src="${item.img}" alt="${item.nome}">
                    </div>
                    <div class="info-produto">
                        <div class="info-produto-nome">
                            <h1>${item.nome}</h1>
                        </div>
                        <div class="info-produto-preco">
                            <h5 data-preco="${item.preco}" class="subtotal-produto">R$ ${subtotal.toFixed(2)}</h5>
                        </div>
                        <div class="info-produto-quantidade">
                            <button class="btn-quantidade" onclick="diminuirQuantidade(this)">−</button>
                            <input type="number" class="input-quantidade" value="${item.quantidade}" min="1">
                            <button class="btn-quantidade" onclick="aumentarQuantidade(this)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
                container.appendChild(slide);
            });

            // Atualiza os elementos com o total de itens
            if (totalItensH3) {
                totalItensH3.textContent =  `Total de itens: ${totalQuantidade}`;
            }
            if (totalItensH1) {
                totalItensH1.textContent = `Total de itens: (${totalQuantidade})`;
            }

            totalEl.textContent = `R$: ${total_itens.toFixed(2)}`;
            addCarrinhoListeners();
        }
        
        atualizarTotal();

        function addCarrinhoListeners() {
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

            document.querySelectorAll('.btn-increment').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const item = carrinho.find(i => i.id === id);
                    if (item) {
                        item.quantidade++;
                        localStorage.setItem('carrinho', JSON.stringify(carrinho));
                        atualizarCarrinhoVisual();
                    }
                });
            });

            document.querySelectorAll('.btn-decrement').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const item = carrinho.find(i => i.id === id);
                    if (item && item.quantidade > 1) {
                        item.quantidade--;
                        localStorage.setItem('carrinho', JSON.stringify(carrinho));
                        atualizarCarrinhoVisual();
                    }
                });
            });

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
                        atualizarResumoPedido()
                    }
                });
            });
        }

        atualizarCarrinhoVisual();
        
        

        function atualizarResumoPedido() {
            // Obter o carrinho do localStorage
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

            // Calcular a quantidade total de itens
            const totalItens = carrinho.reduce((total, item) => total + item.quantidade, 0);

            // Calcular o preço total
            const precoTotal = carrinho.reduce((total, item) => total + item.preco * item.quantidade, 0);

            // Atualizar o elemento de quantidade de itens
            const resumoItensEl = document.getElementById('carrinhoitenstotal');
            if (resumoItensEl) {
                resumoItensEl.textContent = `${totalItens} itens`;
            }

            // Atualizar o elemento de preço total
           
        }
        
    </script>

</body>

</html>