const track = document.querySelector(".carrousel-track-mais-pedidos");
const leftBtn = document.querySelector(".botao-left-mp");
const rightBtn = document.querySelector(".botao-right-mp");

const itemsData = [
   `
   <div class="cards-mp">
            <div class="cards-img-mp">
              <img src="./assets/img/Hamburguer Cheddar.bacon 1000px x 667px.png" alt="">
            </div>
            <div class="cards-title-mp">
              <h3>Hamburgão cheddar e bacon</h3>
            </div>
            <div class="cards-priceEbtn-mp">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
    </div>
  `,
  `
  <div class="cards-mp">
            <div class="cards-img-mp">
              <img src="./assets/img/Esfihas 1000px x 667px.png" alt="">
            </div>
            <div class="cards-title-mp">
              <h3>Esfiha de Carne</h3>
            </div>
            <div class="cards-priceEbtn-mp">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
    </div>
  `,
  `
   <div class="cards-mp">
            <div class="cards-img-mp">
              <img src="./assets/img/Coxinha 1000px  x 677px.png" alt="">
            </div>
            <div class="cards-title-mp">
              <h3>Coxinha de frango</h3>
            </div>
            <div class="cards-priceEbtn-mp">
              <h4>R$ 7,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
    </div>
  `,
  `
   <div class="cards-mp">
            <div class="cards-img-mp">
              <img src="./assets/img/CocaCola.png" alt="">
            </div>
            <div class="cards-title-mp">
              <h3>Coca-Cola 350ml</h3>
            </div>
            <div class="cards-priceEbtn-mp">
              <h4>R$ 6,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
    </div>
  `,
  `
   <div class="cards-mp">
            <div class="cards-img-mp">
              <img src="./assets/img/Mousse de Maracujá.png" alt="">
            </div>
            <div class="cards-title-mp">
              <h3>Mousse de maracujá</h3>
            </div>
            <div class="cards-priceEbtn-mp">
              <h4>R$ 5,00</h4>
              <button><i class="fa-solid fa-plus"></i></button>
            </div>
    </div>
  `
 
];

const CYCLES = 3; // Quantas vezes a lista será repetida

let items = [];
let currentIndex = 0;
let itemWidth = 0;
let isAnimating = false;

function createItem(html) {
  const div = document.createElement("div");
  div.className = "carrousel-item-mp";
  div.innerHTML = html; // permite HTML dentro do item
  return div;
}


function calculateItemWidth() {
  const item = items[0];
  const trackStyle = window.getComputedStyle(track);
  const gap = parseFloat(trackStyle.gap) || 0;
  return item.offsetWidth + gap;
}


function renderItems() {
  track.innerHTML = "";

  const fullList = [];
  for (let i = 0; i < CYCLES; i++) {
    itemsData.forEach((text) => {
      fullList.push(text);
    });
  }

  fullList.forEach((text) => {
    track.appendChild(createItem(text));
  });

  items = document.querySelectorAll(".carrousel-item-mp");

  itemWidth = calculateItemWidth();

  const itemsPerCycle = itemsData.length;
  currentIndex = itemsPerCycle * Math.floor(CYCLES / 2) + 1;

  updateCarousel(false);
}

function updateCarousel(animate = true) {
  const offset = currentIndex * itemWidth - itemWidth;

  if (animate) {
    isAnimating = true;
    track.style.transition = "transform 0.5s ease";
  } else {
    track.style.transition = "none";
  }

  track.style.transform = `translateX(-${offset}px)`;

  items.forEach((item, idx) => {
    item.classList.remove("active");
    item.style.transition = "";
    if (idx === currentIndex) {
      item.classList.add("active");
      if (animate) {
        setTimeout(() => {
          item.style.transition = "transform 0s ease, opacity 0s ease";
        }, 50);
      } else {
        item.style.transition = "transform 0s ease, opacity 0s ease";
      }
    }
  });

  if (animate) {
    setTimeout(() => {
      isAnimating = false;
    }, 500);
  }
}

function resetToCenterIfNeeded() {
  const itemsPerCycle = itemsData.length;
  const totalItems = items.length;
  const min = itemsPerCycle;
  const max = totalItems - itemsPerCycle - 1;

  if (currentIndex <= min) {
    currentIndex += itemsPerCycle;
    updateCarousel(false);
  }

  if (currentIndex >= max) {
    currentIndex -= itemsPerCycle;
    updateCarousel(false);
  }
}

leftBtn.addEventListener("click", () => {
  if (isAnimating) return;

  currentIndex--;
  updateCarousel(true);

  setTimeout(() => {
    resetToCenterIfNeeded();
  }, 510);
});

rightBtn.addEventListener("click", () => {
  if (isAnimating) return;

  currentIndex++;
  updateCarousel(true);

  setTimeout(() => {
    resetToCenterIfNeeded();
  }, 510);
});

window.addEventListener("load", () => {
  renderItems();
});

window.addEventListener("resize", () => {
  itemWidth = calculateItemWidth();
  updateCarousel(false);
});
