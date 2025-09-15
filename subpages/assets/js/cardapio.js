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
    spaceBetween: 5, // Espaçamento entre os slides em pixels
    freeMode: true, // Permite rolagem livre
    scrollbar: {
        el: '.swiper-scrollbar', // Ativa a barra de rolagem
        draggable: true, // Permite arrastar a barra
    },
    mousewheel: true, // Permite rolagem com o mouse
});

// arruma o salgados ROW

document.addEventListener("DOMContentLoaded", () => {
  const content = document.querySelector(".content-salgados");
  const items = Array.from(content.querySelectorAll(".cards-items"));

  content.innerHTML = "";

  // cria rows de 3
  for (let i = 0; i < items.length; i += 3) {
    const row = document.createElement("div");
    row.classList.add("row-cards");
    items.slice(i, i + 3).forEach(item => row.appendChild(item));
    content.appendChild(row);
  }
});

// arruma o folhados ROW

document.addEventListener("DOMContentLoaded", () => {
  const contentf = document.querySelector(".content-folhados");
  const itemsf = Array.from(contentf.querySelectorAll(".cards-items"));

  contentf.innerHTML = "";

  // cria rows de 3
  for (let i = 0; i < itemsf.length; i += 3) {
    const row = document.createElement("div");
    row.classList.add("row-cards");
    itemsf.slice(i, i + 3).forEach(item => row.appendChild(item));
    contentf.appendChild(row);
  }
});

// arruma o doces ROW

document.addEventListener("DOMContentLoaded", () => {
  const contentd = document.querySelector(".content-doces");
  const itemsd = Array.from(contentd.querySelectorAll(".cards-items"));

  contentd.innerHTML = "";

  // cria rows de 3
  for (let i = 0; i < itemsd.length; i += 3) {
    const row = document.createElement("div");
    row.classList.add("row-cards");
    itemsd.slice(i, i + 3).forEach(item => row.appendChild(item));
    contentd.appendChild(row);
  }
});

// arruma o bebidas ROW

document.addEventListener("DOMContentLoaded", () => {
  const contentb = document.querySelector(".content-bebidas");
  const itemsb = Array.from(contentb.querySelectorAll(".cards-items"));

  contentb.innerHTML = "";

  // cria rows de 3
  for (let i = 0; i < itemsb.length; i += 3) {
    const row = document.createElement("div");
    row.classList.add("row-cards");
    itemsb.slice(i, i + 3).forEach(item => row.appendChild(item));
    contentb.appendChild(row);
  }
});

// arruma o outros ROW

document.addEventListener("DOMContentLoaded", () => {
  const contentot = document.querySelector(".content-outros");
  const itemsot = Array.from(contentot.querySelectorAll(".cards-items"));

  contentot.innerHTML = "";

  // cria rows de 3
  for (let i = 0; i < itemsot.length; i += 3) {
    const row = document.createElement("div");
    row.classList.add("row-cards");
    itemsot.slice(i, i + 3).forEach(item => row.appendChild(item));
    contentot.appendChild(row);
  }
});

//input quantidade carrinho

document.addEventListener('DOMContentLoaded', () => {
  const carrinhoItens = document.querySelectorAll('.carrinho-item-quantidade');

  carrinhoItens.forEach(item => {
    const decrementBtn = item.querySelector('.btn-decrement');
    const incrementBtn = item.querySelector('.btn-increment');
    const inputQuantidade = item.querySelector('.input-quantidade');

    // Decrementa o valor
    decrementBtn.addEventListener('click', () => {
      const currentValue = parseInt(inputQuantidade.value, 10);
      if (currentValue > parseInt(inputQuantidade.min, 10)) {
        inputQuantidade.value = currentValue - 1;
      }
    });

    // Incrementa o valor
    incrementBtn.addEventListener('click', () => {
      const currentValue = parseInt(inputQuantidade.value, 10);
      if (currentValue < parseInt(inputQuantidade.max, 10)) {
        inputQuantidade.value = currentValue + 1;
      }
    });

    // Garante que o valor digitado esteja dentro dos limites
    inputQuantidade.addEventListener('input', () => {
      const value = parseInt(inputQuantidade.value, 10);
      const min = parseInt(inputQuantidade.min, 10);
      const max = parseInt(inputQuantidade.max, 10);

      if (value < min) {
        inputQuantidade.value = min;
      } else if (value > max) {
        inputQuantidade.value = max;
      }
    });
  });

  // Lógica para o modal-right-conteudo
  const modalRightConteudo = document.querySelector('.modal-right-conteudo');
  const decrementBtnModal = modalRightConteudo.querySelector('.btn-decrement');
  const incrementBtnModal = modalRightConteudo.querySelector('.btn-increment');
  const inputQuantidadeModal = modalRightConteudo.querySelector('.input-modal-quantidade');

  // Decrementa o valor no modal
  decrementBtnModal.addEventListener('click', () => {
    const currentValue = parseInt(inputQuantidadeModal.value, 10);
    if (currentValue > parseInt(inputQuantidadeModal.min, 10)) {
      inputQuantidadeModal.value = currentValue - 1;
    }
  });

  // Incrementa o valor no modal
  incrementBtnModal.addEventListener('click', () => {
    const currentValue = parseInt(inputQuantidadeModal.value, 10);
    if (currentValue < parseInt(inputQuantidadeModal.max, 10)) {
      inputQuantidadeModal.value = currentValue + 1;
    }
  });

  // Garante que o valor digitado no modal esteja dentro dos limites
  inputQuantidadeModal.addEventListener('input', () => {
    const value = parseInt(inputQuantidadeModal.value, 10);
    const min = parseInt(inputQuantidadeModal.min, 10);
    const max = parseInt(inputQuantidadeModal.max, 10);

    if (value < min) {
      inputQuantidadeModal.value = min;
    } else if (value > max) {
      inputQuantidadeModal.value = max;
    }
  });
});