
// modal ///////////////////////////////////////////////////////

const cardsModal = document.querySelectorAll('.content-cardapio-options .cards-salgados, .content-cardapio-options .cards-folhados, .content-cardapio-options .cards-doces, .content-cardapio-options .cards-bebidas, .content-cardapio-options .cards-outros'); // Seleciona todos os elementos com essa classe
const modalAlert = document.getElementById('modal-alert');     // Seleciona o modal
const btnCloseModal = document.querySelectorAll('.btnCLoseModaL')

cardsModal.forEach(card => {
  card.addEventListener('click', () => {
    // Alterna exibição do modal
    window.location.href = `/cantinarepositorio/subpages/cardapio.php`;
  });
});
