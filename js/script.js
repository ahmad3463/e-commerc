document.addEventListener("DOMContentLoaded", () => {
  // Sticky Navbar
const navBar = document.getElementById("navbar");

// Sidebar & Favorites Logic
const mainFav = document.getElementById("main-fav-btn");
const favToggleBtn = document.getElementById("fav-toggle-btn");
const favSidebar = document.getElementById("fav-sidebar");
const favItems = document.getElementById("fav-items");
const closeSidebarBtn = document.getElementById("close-sidebar-btn");
const cards = document.querySelectorAll(".pcard");


    //scroll list
window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    navBar.classList.add("sticky");
  } else {
    navBar.classList.remove("sticky");
  }
});


let mainCounter = 0; // Total number of favorites
let favorites = new Set(); // Unique favorite item IDs
const favCardsMap = new Map(); // Map for tracking added favorite cards

// Toggle sidebar
favToggleBtn.addEventListener("click", () => {
  const isActive = favSidebar.classList.toggle("active");
  favToggleBtn.setAttribute("aria-expanded", isActive);
});

closeSidebarBtn.addEventListener("click", () => {
  favSidebar.classList.remove("active");
  favToggleBtn.setAttribute("aria-expanded", false);
});


// Update sidebar empty message
function updateSidebarMessage() {
  if (favItems.children.length === 0) {
    const emptyMessage = document.createElement("p");
    emptyMessage.id = "empty-message";
    emptyMessage.textContent = "No favorites added yet.";
    favItems.appendChild(emptyMessage);
  } else {
    const emptyMessage = favItems.querySelector("#empty-message");
    if (emptyMessage) favItems.removeChild(emptyMessage);
  }
}

// Debounce function to prevent rapid clicks
function debounce(func, delay = 300) {
  let timer;
  return function (...args) {
    clearTimeout(timer);
    timer = setTimeout(() => func.apply(this, args), delay);
  };
}

// Handle card click for adding/removing favorites
cards.forEach((card) => {
  const heartButton = card.querySelector(".heart-btn");
  heartButton.addEventListener(
    "click",
    debounce((e) => {
      e.stopPropagation();

      const isFavorite = heartButton.classList.toggle("heart-active");
      const cardData = getCardData(card);

      if (isFavorite) {
        if (!favorites.has(cardData.id)) {
          favorites.add(cardData.id);
          addToFav(cardData);
          mainCounter++;
        }
      } else {
        if (favorites.has(cardData.id)) {
          favorites.delete(cardData.id);
          removeFromFav(cardData.id);
          mainCounter--;
        }
      }

      mainCounter = Math.max(mainCounter, 0); // Ensure counter is not negative
      mainFav.textContent = mainCounter;
      updateSidebarMessage();
    })
  );
});

// Add card to favorites sidebar
function addToFav(cardData) {
  if (favCardsMap.has(cardData.id)) return;

  const favCard = document.createElement("div");
  favCard.className = "fav-card";
  favCard.setAttribute("data-id", cardData.id);

  const img = document.createElement("img");
  img.src = cardData.image;
  img.alt = cardData.title;

  const infoDiv = document.createElement("div");
  const titleP = document.createElement("p");
  titleP.textContent = cardData.title;
  const priceSpan = document.createElement("span");
  priceSpan.textContent = cardData.price;

  const removeBtn = document.createElement("button");
  removeBtn.className = "remove-btn";
  removeBtn.textContent = "Remove";
  removeBtn.addEventListener("click", () => {
    favorites.delete(cardData.id);
    removeFromFav(cardData.id);
    mainCounter = Math.max(mainCounter - 1, 0); // Ensure counter is not negative
    mainFav.textContent = mainCounter;
    updateSidebarMessage();
  });

  infoDiv.appendChild(titleP);
  infoDiv.appendChild(priceSpan);
  favCard.appendChild(img);
  favCard.appendChild(infoDiv);
  favCard.appendChild(removeBtn);

  favCardsMap.set(cardData.id, favCard);
  favItems.appendChild(favCard);
}

// Remove card from favorites sidebar
function removeFromFav(cardId) {
  const favCard = favCardsMap.get(cardId);
  if (favCard) {
    favItems.removeChild(favCard);
    favCardsMap.delete(cardId);
  }
}

// Extract relevant data from a card
function getCardData(card) {
  return {
    id: card.querySelector(".pro-card-btn")?.id || `unknown-${Date.now()}`,
    image: card.querySelector("img")?.src || "",
    title: card.querySelector(".card-text")?.textContent.trim() || "Unknown Title",
    price: card.querySelector("span")?.textContent.trim() || "N/A",
  };
}

// Initialize sidebar message on load
updateSidebarMessage();



    

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1";
})
});
