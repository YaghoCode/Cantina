
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
