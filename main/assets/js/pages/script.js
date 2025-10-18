

  // Video Sobre nos ///////////////////////////////////////////////////

  function postMessageToPlayer(player, command) {
    player.contentWindow.postMessage(JSON.stringify(command), '*');
  }

  const video = document.getElementById('youtube-video');
  const options = {
    root: null,
    threshold: 0.5 // metade do vídeo precisa estar visível
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Quando o vídeo estiver visível, envie comando para tocar
        postMessageToPlayer(video, {
          event: 'command',
          func: 'playVideo',
          args: []
        });
      } else {
        // Quando o vídeo sair da tela, pause ele
        postMessageToPlayer(video, {
          event: 'command',
          func: 'pauseVideo',
          args: []
        });
      }
    });
  }, options);

  observer.observe(document.getElementById('video-container'));



  ////CARDAPIO

const buttons = document.querySelectorAll('.btn-option');
const contents = document.querySelectorAll('.content-cardapio-options');

buttons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Atualizar os botões
    buttons.forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    // Atualizar os conteúdos
    contents.forEach(content => content.classList.remove('active'));
    contents[index].classList.add('active');
  });
});

//input quantidade carrinho

document.addEventListener('DOMContentLoaded', () => {
  const carrinhoItens = document.querySelectorAll('.carrinho-item-quantidade');

  carrinhoItens.forEach(item => {
    const decrementBtn = item.querySelector('.btn-decrement');
    const incrementBtn = item.querySelector('.btn-increment');
    const inputQuantidade = item.querySelector('.input-quantidade');

    // Decrementa o valor
    decrementBtn.addEventListener('click', () => {
      const currentValue = parseInt(inputQuantidade.value, 10);
      if (currentValue > parseInt(inputQuantidade.min, 10)) {
        inputQuantidade.value = currentValue - 1;
      }
    });

    // Incrementa o valor
    incrementBtn.addEventListener('click', () => {
      const currentValue = parseInt(inputQuantidade.value, 10);
      if (currentValue < parseInt(inputQuantidade.max, 10)) {
        inputQuantidade.value = currentValue + 1;
      }
    });

    // Garante que o valor digitado esteja dentro dos limites
    inputQuantidade.addEventListener('input', () => {
      const value = parseInt(inputQuantidade.value, 10);
      const min = parseInt(inputQuantidade.min, 10);
      const max = parseInt(inputQuantidade.max, 10);

      if (value < min) {
        inputQuantidade.value = min;
      } else if (value > max) {
        inputQuantidade.value = max;
      }
    });
  });
});