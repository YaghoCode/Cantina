const track = document.querySelector(".carrousel-track-mais-pedidos");
const leftBtn = document.querySelector(".botao-left-mp");
const rightBtn = document.querySelector(".botao-right-mp");

const itemsData = [
  `
  <div class="item-conteudo">
    <img src="img/pizza.jpg" alt="Pizza">
    <p>Pizza</p>
  </div>
  `,
  `
  <div class="item-conteudo">
    <img src="img/hamburguer.jpg" alt="Hambúrguer">
    <p>Hambúrguer</p>
  </div>
  `,
  `
  <div class="item-conteudo">
    <img src="img/lasanha.jpg" alt="Lasanha">
    <p>Lasanha</p>
  </div>
  `,
  `
  <div class="item-conteudo">
    <img src="img/salada.jpg" alt="Salada">
    <p>Salada</p>
  </div>
  `,
  `
  <div class="item-conteudo">
    <img src="img/sorvete.jpg" alt="Sorvete">
    <p>Sorvete</p>
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
