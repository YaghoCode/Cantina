//popup users navbar

const containerPopUpUser = document.getElementById('pop-up-user');
const btnUserNav = document.getElementById('btn-user-nav');
const btnCloseUserNav = document.getElementById('btn-close-user-nav');


btnUserNav.addEventListener('click', () => {
  if (containerPopUpUser.style.display !== 'block') {
    containerPopUpUser.style.display = 'block';
  }else{
    containerPopUpUser.style.display = 'none';
  }
});


btnCloseUserNav.addEventListener('click', () => {
  containerPopUpUser.style.display = 'none';
});

//pop-up cart carrinho navbar
const containerPopUpCart = document.getElementById('pop-up-cart');
const btnCartNav = document.getElementById('btn-cart-nav');
const btnCloseCartNav = document.getElementById('btn-close-cart-nav');

btnCartNav.addEventListener('click', () => {
    if (!containerPopUpCart.classList.contains('active')) {
        containerPopUpCart.classList.add('active'); 
    } else {
        containerPopUpCart.classList.remove('active'); 
    }
});

btnCloseCartNav.addEventListener('click', () => {
  containerPopUpCart.classList.remove('active'); 
});

const swiper = new Swiper('.swiper', {
    direction: 'vertical', // Define a direção como vertical
    slidesPerView: 'auto', // Mostra os slides conforme o tamanho do conteúdo
    freeMode: true, // Permite rolagem livre
    scrollbar: {
        el: '.swiper-scrollbar', // Ativa a barra de rolagem
        draggable: true, // Permite arrastar a barra
    },
    mousewheel: true, // Permite rolagem com o mouse
});

//

function adicionarItemCardapio(itemHTML) {
    const container = document.querySelector('.container-salgados');
    const content = container.querySelector('.content-salgados'); 
    const rows = content.querySelectorAll('.row-cards'); 
    let ultimaRow = rows[rows.length - 1]; // pega a ultima row do salgados

    //ve se a ultima row ta com 3 items
    if (ultimaRow && ultimaRow.children.length >= 3) {
        // cria uma nova row
        const novaRow = document.createElement('div');
        novaRow.classList.add('row-cards');
        content.appendChild(novaRow); // adiciona a nova row ao content
        ultimaRow = novaRow; // atualiza a última row para a nova criada

        // ajusta o tamanho co container e do content
        const alturaContentAtual = parseFloat(window.getComputedStyle(content).height); // Altura atual do content
        const alturaContainerAtual = parseFloat(window.getComputedStyle(container).height); // Altura atual do container

        const alturaRow = alturaContentAtual / rows.length; // Calcula a altura de uma row com base nas existentes

       content.style.height = `${alturaContentAtual + alturaRow}px`;
        container.style.height = `${alturaContainerAtual + alturaRow}px`; // Aumenta o container proporcionalmente
    }

    // Adiciona o item na última row
    const novoItem = document.createElement('div');
    novoItem.classList.add('cards-items');
    novoItem.innerHTML = itemHTML; // Adiciona o conteúdo do item
    ultimaRow.appendChild(novoItem); // Adiciona o item à última row
}

// Exemplo de uso:
const novoItemHTML = `
    <div class="cards-items-left">
        <div class="title-cards-items">
            <h1>Item Novo</h1>
        </div>
        <div class="description-cards-items">
            <p>Descrição do novo item.</p>
        </div>
        <div class="price-cards-items">
            <p>R$ 10,00</p>
        </div>
    </div>
    <div class="cards-items-right">
        <div class="cards-items-img">
            <img src="/main/assets/img/.png" alt="Novo Item">
        </div>
    </div>
`;

// Adiciona o novo item ao cardápio
adicionarItemCardapio(novoItemHTML);
adicionarItemCardapio(novoItemHTML);