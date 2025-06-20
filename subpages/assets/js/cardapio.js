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

//Modal destaques
const btnOpenModalDestaques1 = document.getElementById('btn-add-destaques-1');
const btnOpenModalDestaques2 = document.getElementById('btn-add-destaques-2');
const btnOpenModalDestaques3 = document.getElementById('btn-add-destaques-3');
const modalDestaques1 = document.getElementById('modal-d-1');
const modalDestaques2 = document.getElementById('modal-d-2');
const modalDestaques3 = document.getElementById('modal-d-3');


//Abrir/fechar modal 1

btnOpenModalDestaques1.addEventListener('click', () => {
  modalDestaques1.style.display = 'flex';
});

modalDestaques1.addEventListener('click', (event) => {
  // Se o clique for no próprio modal (fundo), fecha
  if (event.target === modalDestaques1) {
    modalDestaques1.style.display = 'none';
  }
});

//Abrir/fechar modal 2

btnOpenModalDestaques2.addEventListener('click', () => {
  modalDestaques2.style.display = 'flex';
});

modalDestaques2.addEventListener('click', (event) => {
  // Se o clique for no próprio modal (fundo), fecha
  if (event.target === modalDestaques2) {
    modalDestaques2.style.display = 'none';
  }
});

//Abrir/fechar modal 3

btnOpenModalDestaques3.addEventListener('click', () => {
  modalDestaques3.style.display = 'flex';
});

modalDestaques3.addEventListener('click', (event) => {
  // Se o clique for no próprio modal (fundo), fecha
  if (event.target === modalDestaques3) {
    modalDestaques3.style.display = 'none';
  }
});





