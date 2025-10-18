function atualizarCarrinhoVisual() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    const container = document.getElementById("carrinho-itens-wrapper");
    const totalEl = document.querySelector(".cart-total-price h6");

    container.innerHTML = ""; // Limpa itens antigos
    let total = 0;


    carrinho.forEach(item => {
        const subtotal = item.preco * item.quantidade;
        total += subtotal;

        const slide = document.createElement("div");
        slide.classList.add("swiper-slide", "p-3", "border", "rounded");
        slide.innerHTML = `
            <div class="carrinho-item">
                <div class="carrinho-item-left">
                    <div class="carrinho-item-img">
                        <img src="${item.img}" alt="${item.nome}" style="width:100px; height:100px;">
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
                            <p>R$ ${subtotal.toFixed(2)}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(slide);
    });

    totalEl.textContent = `R$: ${total.toFixed(2)}`;
    addCarrinhoListeners();

    
    if (carrinho.length === 0) {
        container.innerHTML = `<div class="carrinho-vazio">
                                    <div class="carrinho-vazio-content">
                                        <div class="carrinho-vazio-content-top">
                                            <div class="carrinho-vazio-content-top-icon">
                                                    <i class="fa-solid fa-basket-shopping"></i>
                                            </div>
                                        </div>
                                            <div class="carrinho-vazio-content-bottom">
                                                <div class="carrinho-vazio-content-bottom-text">
                                                    <h1>Seu carrinho está vazio</h1>
                                                    <p>Adicione produtos de nosso cardápio para concluir sua compra.
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                </div>`;
        totalEl.textContent = "R$ 00,00";
        return;
    }
}

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
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    atualizarCarrinhoVisual();
});

document.getElementById("btn-limpar-carrinho").addEventListener("click", () => {
    if (confirm("Tem certeza que quer limpar o carrinho?")) {
        localStorage.removeItem("carrinho");
        atualizarCarrinhoVisual();
    }
});
