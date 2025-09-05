

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