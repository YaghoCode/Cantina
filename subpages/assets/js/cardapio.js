//popup.js

const btn = document.getElementById('btn-nav-account');
const popup = document.getElementById('popup');

// Alterna visibilidade ao clicar no botão
btn.addEventListener('click', (e) => {
  e.stopPropagation();
  popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
});

// Impede que clique dentro da popup feche ela
popup.addEventListener('click', (e) => {
  e.stopPropagation();
});

// Fecha ao clicar fora
document.addEventListener('click', () => {
  popup.style.display = 'none';
});

new Swiper('.cards-wrapper', {

  loop: true,
  spaceBetween: 30,

  
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true
  },

  // Flechas de Navegação
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  breakpoints: {
    0: {
        slidesPerView: 1
    },
     768: {
        slidesPerView: 2
    },
     1024: {
        slidesPerView: 3
    },
  }
});