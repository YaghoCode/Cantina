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
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/pagamento_cliente_page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Pagamento</title>

</head>

<body>

    <div class="container-pagamento-page">
        <div class="content-pagamento-page">
            <div class="content-pagamento-page-top">
                <div class="title-pagamento">
                    <h1>Pagamento do Pedido:</h1>
                </div>
            </div>
            <div class="content-pagamento-page-mid">
                <div class="qr-code-pagamento">
                    <img src="" alt="">
                    <p>QR CODE</p>
                </div>
                <div class="valor-total-pagamento">
                    <h1>Valor Total</h1>
                    <h2>R$ 32,00</h2>
                </div>
                <div class="aviso-pagamento">
                    <div class="aviso-pagamento-left">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="aviso-pagamento-right">
                        <p>
                            <strong>Atenção:</strong> Se o pagamento não for confirmado nesta tela, o pedido será
                            automaticamente cancelado.
                        </p>
                    </div>
                </div>
            </div>
            <div class="content-pagamento-page-bottom">
                <form method="POST" action="/cantinarepositorio/subpages/confirmar_pagamento.php">
                    <button type="submit" class="btn-confirmar-pagamento">
                        <i class="fa-solid fa-check"></i>
                        Confirmar Pagamento
                    </button>
                </form>
                <button type="button" class="btn-cancelar-pagamento">
                    <a href="/cantinarepositorio/subpages/finalizar_pedido_cliente.php">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar Para o Pedido
                    </a>
                </button>
            </div>
        </div>
    </div>


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
            exibirTotalPagamento();
        });

        function exibirTotalPagamento() {
            // Recupera o carrinho do localStorage
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

            // Calcula o total
            let total = 0;
            carrinho.forEach(item => {
                total += item.preco * item.quantidade;
            });

            // Exibe o total no elemento valor-total-pagamento
            const totalElement = document.querySelector('.valor-total-pagamento h2');
            if (totalElement) {
                totalElement.textContent = `R$ ${total.toFixed(2)}`;
            }

            // Opcional: salva o total em um input hidden para enviar ao servidor
            const inputTotal = document.querySelector('input[name="total"]');
            if (inputTotal) {
                inputTotal.value = total.toFixed(2);
            }

            console.log('Total do pagamento:', total.toFixed(2));
        }

    </script>


</body>

</html>