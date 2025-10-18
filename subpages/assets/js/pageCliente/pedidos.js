//popup users navbar

const containerPopUp = document.getElementById('pop-up-user');
const btnUserNav = document.getElementById('btn-user-nav');
const btnCloseUsernav = document.getElementById('btn-close-user-nav');
const overlayPopUpUser = document.getElementById('overlay-pop-up-user');


btnUserNav.addEventListener('click', () => {
  if (containerPopUp.style.display !== 'block') {
    containerPopUp.style.display = 'block';
    overlayPopUpUser.style.display = 'block';
  }else{
    containerPopUp.style.display = 'none';
    overlayPopUpUser.style.display = 'none';
  }
});


btnCloseUsernav.addEventListener('click', () => {
    containerPopUp.style.display = 'none';
  overlayPopUpUser.style.display = 'none';
});