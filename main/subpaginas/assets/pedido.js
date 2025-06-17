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
