
// modal ///////////////////////////////////////////////////////

const cardsModal = document.querySelectorAll('.cards-salgados'); // Seleciona todos os elementos com essa classe
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