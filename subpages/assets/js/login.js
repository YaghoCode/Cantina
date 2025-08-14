export function mostrarCadastro() {
    document.getElementById('loginBox').classList.add('hidden');
    document.getElementById('cadastroBox').classList.remove('hidden');
    document.getElementById('imageSide').style.backgroundImage = "url('./assets/img/croissant.jpg')";
  }
  
  export function mostrarLogin() {
    document.getElementById('cadastroBox').classList.add('hidden');
    document.getElementById('loginBox').classList.remove('hidden');
    document.getElementById('imageSide').style.backgroundImage = "url('./assets/img/coxinha.jpg')";
  }
  
  export function entrar() {
    document.querySelector('.form-wrapper').classList.add('hidden');
    document.getElementById('cardapio').classList.remove('hidden');
  }
  
  // Atribui funções globais no navegador
  window.mostrarCadastro = mostrarCadastro;
  window.mostrarLogin = mostrarLogin;
  window.entrar = entrar;
  