
//popup users navbar

const containerPopUpUser = document.getElementById('pop-up-user');
const btnUserNav = document.getElementById('btn-user-nav');
const btnCloseUserNav = document.getElementById('btn-close-user-nav');


btnUserNav.addEventListener('click', () => {
  if (containerPopUpUser.style.display !== 'flex') {
    containerPopUpUser.style.display = 'flex';
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
    spaceBetween: 5, // Espaçamento entre os slides em pixels
    scrollbar: {
        el: '.swiper-scrollbar', // Ativa a barra de rolagem
        draggable: true, // Permite arrastar a barra
    },
    mousewheel: true, // Permite rolagem com o mouse
});
