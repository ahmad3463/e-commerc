
const navBar = document.getElementById("navbar");

window.addEventListener('scroll' , () => {
    if(window.scrollY > 0){
        navBar.classList.add("sticky")
    }else{
        navBar.classList.remove("sticky");
    }
});

   // Elements
const mainFav = document.getElementById("main-fav-btn");
const favToggleBtn = document.getElementById("fav-toggle-btn");
const favSidebar = document.getElementById("fav-sidebar");
const favItems = document.getElementById("fav-items");
const cards = document.querySelectorAll(".pcard");
const closeSidebarBtn = document.getElementById("close-sidebar-btn");

let mainCounter = 0;  // Total number of favorites
let favorites = new Set();  // Store unique favorite item IDs

// Toggle sidebar visibility
favToggleBtn.addEventListener('click', () => favSidebar.classList.toggle("active"));
closeSidebarBtn.addEventListener('click', () => favSidebar.classList.remove("active"));

// Handle card click for adding/removing favorites
cards.forEach((card) => {
  card.addEventListener('click', () => {
    const isFavorite = card.classList.toggle("heart-active");
    const cardData = getCardData(card);
    
    if (isFavorite) {
      favorites.add(cardData.id);
      addToFav(cardData);
      mainCounter++;
    } else {
      favorites.delete(cardData.id);
      removeFromFav(cardData.id);
      mainCounter--;
    }
    
    mainFav.textContent = mainCounter;  // Update favorite counter
  });
});

// Add card to favorites sidebar
function addToFav(cardData) {
  const favCard = document.createElement("div");
  favCard.className = "fav-card";
  favCard.setAttribute("data-id", cardData.id);
  favCard.innerHTML = `
    <img src="${cardData.image}" alt="${cardData.title}">
    <div>
      <p>${cardData.title}</p>
      <span>${cardData.price}</span>
    </div>
    <button class="remove-btn">Remove</button>
  `;
  
  // Remove card from favorites
  favCard.querySelector(".remove-btn").addEventListener('click', () => {
    favorites.delete(cardData.id);
    favItems.removeChild(favCard);
    mainCounter--;
    mainFav.textContent = mainCounter;
  });

  favItems.appendChild(favCard);
}

// Remove card from favorites sidebar
function removeFromFav(cardId) {
  const favCard = favItems.querySelector(`[data-id="${cardId}"]`);
  if (favCard) {
    favItems.removeChild(favCard);
  }
}

// Extract relevant data from a card
function getCardData(card) {
  return {
    id: card.querySelector(".pro-card-btn").id,
    image: card.querySelector("img").src,
    title: card.querySelector(".card-text").textContent.trim(),
    price: card.querySelector("span").textContent.trim(),
  };
}

    

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1";
})