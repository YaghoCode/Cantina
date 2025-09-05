
// modal ///////////////////////////////////////////////////////

const cardsModal = document.querySelectorAll('.cards-salgados'); // Seleciona todos os elementos com essa classe
const modalAlert = document.getElementById('modal-alert');     // Seleciona o modal
const btnCloseModal = document.querySelectorAll('.btnCLoseModaL')

cardsModal.forEach(card => {
  card.addEventListener('click', () => {
    // Alterna exibição do modal
    window.location.href = `/cantinarepositorio/subpages/cardapio.php`;
  });
});
