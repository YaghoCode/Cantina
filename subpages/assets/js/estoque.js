

const tabProdutos = document.getElementById("tab-produtos");
const tabAjustes = document.getElementById("tab-ajustes");

const conteudoProdutos = document.getElementById("conteudo-produtos");
const conteudoAjustes = document.getElementById("conteudo-ajustes");

tabProdutos.addEventListener("click", () => {
  tabProdutos.classList.add("active");
  tabAjustes.classList.remove("active");

  conteudoProdutos.style.display = "flex";
  conteudoAjustes.style.display = "none";
});

tabAjustes.addEventListener("click", () => {
  tabAjustes.classList.add("active");
  tabProdutos.classList.remove("active");

  conteudoAjustes.style.display = "flex";
  conteudoProdutos.style.display = "none";
});

//popup

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


// modal NOVO


const btnNovoProduto = document.getElementById('btn-novo-produto')
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