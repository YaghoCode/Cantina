
//popup users navbar

const containerPopUp = document.getElementById('pop-up-user');
const btnUserNav = document.getElementById('btn-user-nav');
const btnCloseUsernav = document.getElementById('btn-close-user-nav');


btnUserNav.addEventListener('click', () => {
  if (containerPopUp.style.display !== 'block') {
    containerPopUp.style.display = 'block';
  }else{
    containerPopUp.style.display = 'none';
  }
});


btnCloseUsernav.addEventListener('click', () => {
  containerPopUp.style.display = 'none';
});

const btnCloseAside = document.querySelector('.btn-close-aside');
const btnOpenAside = document.querySelector('.aside-icon');
const contentAside = document.querySelector('.aside-options');

btnOpenAside.addEventListener('click', () => {
  contentAside.classList.remove('hidden'); // remove "fechado"
  contentAside.classList.add('all');       // adiciona "aberto"
});

btnCloseAside.addEventListener('click', () => {
  contentAside.classList.remove('all');    // remove "aberto"
  contentAside.classList.add('hidden');    // adiciona "fechado"
});

// logica aside + contents

const btnAsideEstoque = document.getElementById('btn-estoque');
const btnAsideClientes = document.getElementById('btn-clientes');
const btnAsidePedidos = document.getElementById('btn-pedidos');
const btnAsideConfig = document.getElementById('btn-configuracoes');

const conteudoAsideEstoque = document.getElementById('conteudo-estoque');
const conteudoAsideClientes = document.getElementById('conteudo-clientes');
const conteudoAsidePedidos = document.getElementById('conteudo-pedidos');
const conteudoAsideConfig = document.getElementById('conteudo-configuracoes');

// Função para esconder todos e mostrar só o clicado
function mostrarConteudo(ativo) {
    conteudoAsideEstoque.classList.remove("active");
    conteudoAsideClientes.classList.remove("active");
    conteudoAsidePedidos.classList.remove("active");
    conteudoAsideConfig.classList.remove("active");

    conteudoAsideEstoque.classList.add("close");
    conteudoAsideClientes.classList.add("close");
    conteudoAsidePedidos.classList.add("close");
    conteudoAsideConfig.classList.add("close");

    ativo.classList.remove("close");
    ativo.classList.add("active");
}

btnAsideEstoque.addEventListener("click", () => {
    mostrarConteudo(conteudoAsideEstoque);
});

btnAsideClientes.addEventListener("click", () => {
    mostrarConteudo(conteudoAsideClientes);
});

btnAsidePedidos.addEventListener("click", () => {
    mostrarConteudo(conteudoAsidePedidos);
});

btnAsideConfig.addEventListener("click", () => {
    mostrarConteudo(conteudoAsideConfig);
});


//dropwdow filtro

const dropdownLabel = document.getElementById("dropdownLabel");
    const dropdownItems = document.querySelectorAll("#dropdownMenu .dropdown-item");

    dropdownItems.forEach(item => {
      item.addEventListener("click", function(e) {
        e.preventDefault();

        // só troca o texto, o ícone e a seta continuam iguais
        dropdownLabel.textContent = this.textContent;

        // troca a seleção visual
        dropdownItems.forEach(i => i.classList.remove("active"));
        this.classList.add("active");
      });
    });