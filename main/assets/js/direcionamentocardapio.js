
// modal ///////////////////////////////////////////////////////

const cardsModal = document.querySelectorAll('.content-cardapio-options .cards-salgados, .content-cardapio-options .cards-folhados, .content-cardapio-options .cards-doces, .content-cardapio-options .cards-bebidas, .content-cardapio-options .cards-outros');
const modalAlert = document.getElementById('modal-alert');     // Seleciona o modal
const btnCloseModal = document.querySelectorAll('.btnCLoseModaL')

cardsModal.forEach(card => {
  card.addEventListener('click', () => {
    // Alterna exibição do modal
    if (modalAlert.style.display != 'block') {
      modalAlert.style.display = 'block'

    }
  });
});

  btnCloseModal.forEach(btn => {
  btn.addEventListener('click', () => {
    modalAlert.style.display = 'none';
  });
});