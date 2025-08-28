// AVALIAÇÕES/////////////////////////////////////////

const avaliacoes = document.querySelector('.avaliacoes');
const leftBtn = document.querySelector('.arrow.left');
const rightBtn = document.querySelector('.arrow.right');

let cardWidth;
let autoPlayInterval;


    function updateCardWidth() {
      const style = getComputedStyle(avaliacoes);
      const gap = parseFloat(style.gap) || 0;
      const card = avaliacoes.querySelector('.card');
      cardWidth = card.offsetWidth + gap + 10;
      
      let contador = avaliacoes.querySelectorAll('div.card').length;
      
      if(contador % 2 ==1){
        if (contador % 2 === 1) {
        
          avaliacoes.style.justifyContent = ""; 
        
        
          avaliacoes.style.position = "relative";
          avaliacoes.style.left = "67.5vh";
        }
        
      }



    }
    updateCardWidth();


        // Loop infinito real
        function moveLeft() {
          avaliacoes.style.transition = 'transform 2s ease';
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
            avaliacoes.style.transition = 'transform 2s ease';
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
          autoPlayInterval = setInterval(moveLeft, 3000); // a cada 3s
        }
        function resetAutoPlay() {
          clearInterval(autoPlayInterval);
          startAutoPlay();
        }
        startAutoPlay();

        // Atualiza se a tela mudar
        window.addEventListener('resize', updateCardWidth);


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


//popup users navbar

const containerPopUpUser = document.getElementById('pop-up-user');
const btnUserNav = document.getElementById('btn-user-nav');
const btnCloseUserNav = document.getElementById('btn-close-user-nav');


btnUserNav.addEventListener('click', () => {
  if (containerPopUpUser.style.display !== 'block') {
    containerPopUpUser.style.display = 'block';
  }else{
    containerPopUpUser.style.display = 'none';
  }
});


btnCloseUserNav.addEventListener('click', () => {
  containerPopUpUser.style.display = 'none';
});

//pop-up cart carrinho navbar
const containerPopUpCart = document.getElementById('pop-up-cart');
const btnCartNav = document.getElementById('btn-cart-nav');
const btnCloseCartNav = document.getElementById('btn-close-cart-nav');

btnCartNav.addEventListener('click', () => {
    if (!containerPopUpCart.classList.contains('active')) {
        containerPopUpCart.classList.add('active'); 
    } else {
        containerPopUpCart.classList.remove('active'); 
    }
});

btnCloseCartNav.addEventListener('click', () => {
  containerPopUpCart.classList.remove('active'); 
});

const swiper = new Swiper('.swiper', {
    direction: 'vertical', // Define a direção como vertical
    slidesPerView: 'auto', // Mostra os slides conforme o tamanho do conteúdo
    freeMode: true, // Permite rolagem livre
    scrollbar: {
        el: '.swiper-scrollbar', // Ativa a barra de rolagem
        draggable: true, // Permite arrastar a barra
    },
    mousewheel: true, // Permite rolagem com o mouse
});