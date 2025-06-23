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
