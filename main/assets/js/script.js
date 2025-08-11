const avaliacoes = document.querySelector('.avaliacoes');
const leftBtn = document.querySelector('.arrow.left');
const rightBtn = document.querySelector('.arrow.right');

let cardWidth;
let autoPlayInterval;

// Atualiza largura com gap dinâmico
function updateCardWidth() {
  const style = getComputedStyle(avaliacoes);
  const gap = parseFloat(style.gap) || 0;
  const card = avaliacoes.querySelector('.card');
  cardWidth = card.offsetWidth + gap + 8;
}
updateCardWidth();

// Loop infinito real
function moveLeft() {
  avaliacoes.style.transition = 'transform 0.4s ease';
  avaliacoes.style.transform = `translateX(${-cardWidth}px)`;

  avaliacoes.addEventListener('transitionend', () => {
    avaliacoes.appendChild(avaliacoes.firstElementChild);
    avaliacoes.style.transition = 'none';
    avaliacoes.style.transform = 'translateX(0)';
  }, { once: true });
}

function moveRight() {
  avaliacoes.insertBefore(avaliacoes.lastElementChild, avaliacoes.firstElementChild);
  avaliacoes.style.transition = 'none';
  avaliacoes.style.transform = `translateX(${-cardWidth}px)`;

  requestAnimationFrame(() => {
    avaliacoes.style.transition = 'transform 0.4s ease';
    avaliacoes.style.transform = 'translateX(0)';
  });
}

// Controle manual
rightBtn.addEventListener('click', () => {
  moveLeft();
  resetAutoPlay();
});
leftBtn.addEventListener('click', () => {
  moveRight();
  resetAutoPlay();
});

// Autoplay
function startAutoPlay() {
  autoPlayInterval = setInterval(moveLeft, 10000); // a cada 3s
}
function resetAutoPlay() {
  clearInterval(autoPlayInterval);
  startAutoPlay();
}
startAutoPlay();

// Atualiza se a tela mudar
window.addEventListener('resize', updateCardWidth);
