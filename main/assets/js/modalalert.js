// modal ///////////////////////////////////////////////////////

// Seleciona os elementos necessários
const cardsModal = document.querySelectorAll('.content-cardapio-options .cards-salgados, .content-cardapio-options .cards-folhados, .content-cardapio-options .cards-doces, .content-cardapio-options .cards-bebidas, .content-cardapio-options .cards-outros');
const modalAlert = document.getElementById('modal-alert'); // Seleciona o modal
const btnCloseModal = document.querySelectorAll('.btnCLoseModaL'); // Botões de fechar
const overlay = document.getElementById('modal-overlay'); // Seleciona o overlay
const btnVoltarModal = document.getElementById('btn-voltar-modal-alert')
// Exibe o modal e o overlay ao clicar nos cards
cardsModal.forEach(card => {
  card.addEventListener('click', () => {
    modalAlert.classList.add('active'); // Exibe o modal
    overlay.classList.add('active'); // Exibe o overlay
  });
});

// Fecha o modal e o overlay ao clicar no botão de fechar
btnCloseModal.forEach(btn => {
  btn.addEventListener('click', () => {
    modalAlert.classList.remove('active'); // Esconde o modal
    overlay.classList.remove('active'); // Esconde o overlay
  });
});

btnVoltarModal.forEach(btn2 => {
  btn2.addEventListener('click', () => {
    modalAlert.classList.remove('active'); // Esconde o modal
    overlay.classList.remove('active'); // Esconde o overlay
  });
});

// Fecha o modal e o overlay ao clicar no overlay
overlay.addEventListener('click', () => {
  modalAlert.classList.remove('active'); // Esconde o modal
  overlay.classList.remove('active'); // Esconde o overlay
});