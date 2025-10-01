
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


// modal novo

const btnNovoProduto = document.getElementById('btn-adicionar-produto')
const modalAlert = document.getElementById('modal-novo-p');     
const btnCloseModal = document.getElementById('btn-close-modal-p')

btnNovoProduto.addEventListener('click', () => {
  if(modalAlert.style.display !== 'block'){
      modalAlert.style.display = 'block';
  }
});

btnCloseModal.addEventListener('click', () => {
        modalAlert.style.display = 'none'
});

const inputImagem = document.getElementById('imagem-produto');
const previewImagem = document.getElementById('preview');
const btnRemovePreview = document.getElementById('btn-remove-preview');

inputImagem.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImagem.src = e.target.result;
            previewImagem.style.display = 'block';
            btnRemovePreview.style.display = 'flex'; // Mostra o botão "X"
        };
        reader.readAsDataURL(file);
    }
});

// Função para remover a imagem e reiniciar o preview
btnRemovePreview.addEventListener('click', () => {
    previewImagem.src = '#';
    previewImagem.style.display = 'none';
    btnRemovePreview.style.display = 'none';
    inputImagem.value = ''; // Reseta o campo de upload
});



////// Filtro das tabelas
const tableAllEstoque = document.getElementById('table-all');
const tableLowEstoque = document.getElementById('table-low');
const tableSalgadosEstoque = document.getElementById('table-salgados');
const tableFolhadosEstoque = document.getElementById('table-folhados');
const tableDocesEstoque = document.getElementById('table-doces');
const tableBebidasEstoque = document.getElementById('table-bebidas');
const tableOutrosEstoque = document.getElementById('table-outros');

const btnAllFiltro = document.getElementById('btn-all-produtos');
const btnLowFiltro = document.getElementById('btn-low-produtos');
const btnSalgadosFiltro = document.getElementById('btn-salgados-produtos');
const btnFolhadosFiltro = document.getElementById('btn-folhados-produtos');
const btnDocesFiltro = document.getElementById('btn-doces-produtos');
const btnBebidasFiltro = document.getElementById('btn-bebidas-produtos');
const btnOutrosFiltro = document.getElementById('btn-outros-produtos');

function mostrarConteudoTableEstoque(ItemAtivo) {
    tableAllEstoque.classList.remove("activeTable");
    tableLowEstoque.classList.remove("activeTable");
    tableSalgadosEstoque.classList.remove("activeTable");
    tableFolhadosEstoque.classList.remove("activeTable");
    tableDocesEstoque.classList.remove("activeTable");
    tableBebidasEstoque.classList.remove("activeTable");
    tableOutrosEstoque.classList.remove("activeTable");

    tableAllEstoque.classList.add("closeTable");
    tableLowEstoque.classList.add("closeTable");
    tableSalgadosEstoque.classList.add("closeTable");
    tableFolhadosEstoque.classList.add("closeTable");
    tableDocesEstoque.classList.add("closeTable");
    tableBebidasEstoque.classList.add("closeTable");
    tableOutrosEstoque.classList.add("closeTable");

    ItemAtivo.classList.remove("closeTable");
    ItemAtivo.classList.add("activeTable");
}

btnAllFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableAllEstoque);
});

btnLowFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableLowEstoque);
});

btnSalgadosFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableSalgadosEstoque);
});

btnFolhadosFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableFolhadosEstoque);
});

btnDocesFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableDocesEstoque);
});

btnBebidasFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableBebidasEstoque);
});

btnOutrosFiltro.addEventListener("click", () => {
    mostrarConteudoTableEstoque(tableOutrosEstoque);
});

/// function abrir e fechar modal visualizar

const overlayModalVisualizar = document.getElementById('overlay-modal-visualizar');
const modalVisualizarItem = document.getElementById('modal-visualizar-item');
const btnVisualizarItem = document.querySelectorAll('.btn-visualizar-item')
const btnCloseModalVisualizar = document.getElementById('btn-close-modal-estoque');

btnVisualizarItem.forEach((btn1) =>{
    btn1.addEventListener('click', () =>{
        modalVisualizarItem.style.display = 'flex';
        overlayModalVisualizar.style.display = 'flex';
    });
});

btnCloseModalVisualizar.addEventListener('click', () =>{
    modalVisualizarItem.style.display = 'none';
    overlayModalVisualizar.style.display = 'none';
    console.log(btnVisualizarItem);
});


// function fechar modal deletar item

const modalDeletarItem = document.getElementById('modal-deletar-item');
const btnCancelarItem = document.getElementById('btn-cancelar-deletar-item');
const btnDeletarItem = document.querySelectorAll('.btn-deletar-item');

btnDeletarItem.forEach((btn2) =>{
    btn2.addEventListener('click', () =>{
        modalDeletarItem.style.display = 'flex';
        overlayModalVisualizar.style.display = 'flex';
    });
});

btnCancelarItem.addEventListener('click', () =>{
    modalDeletarItem.style.display = 'none';
    overlayModalVisualizar.style.display = 'none';
});