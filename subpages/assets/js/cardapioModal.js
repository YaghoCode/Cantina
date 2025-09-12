const btnCardapioCards = document.querySelectorAll('.cards-items');
const modalCardapio = document.getElementById('modal-cardapio')
const btnCloseModalCardapio = document.querySelectorAll('.btn-close-modaL')
const overlayModalCardapio = document.getElementById('modal-overlay-cardapio')

// Exibe o modal e o overlay ao clicar nos cards
btnCardapioCards.forEach(card => {
  card.addEventListener('click', () => {
    modalCardapio.classList.add('active'); // Exibe o modal
    overlayModalCardapio.classList.add('active'); // Exibe o overlay
  });
});

// Fecha o modal e o overlay ao clicar no botão de fechar
btnCloseModalCardapio.forEach(btn => {
  btn.addEventListener('click', () => {
    modalCardapio.classList.remove('active'); // Esconde o modal
    overlayModalCardapio.classList.remove('active'); // Esconde o overlay
  });
});

// Fecha o modal e o overlay ao clicar no overlay
overlayModalCardapio.addEventListener('click', () => {
  modalCardapio.classList.remove('active'); // Esconde o modal
  overlayModalCardapio.classList.remove('active'); // Esconde o overlay
});