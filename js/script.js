
const navBar = document.getElementById("navbar");

window.addEventListener('scroll' , () => {
    if(window.scrollY > 0){
        navBar.classList.add("sticky")
    }else{
        navBar.classList.remove("sticky");
    }
});

    // add favbtn funtionalilty
    const mainFav = document.getElementById("main-fav-btn");
    const favToggleBtn = document.getElementById("fav-toggle-btn");
    const favSidebar = document.getElementById("fav-sidebar");
    const favItems = document.getElementById("fav-items");
    const cards = document.querySelectorAll(".pcard");
    const closeSidebarBtn = document.getElementById("close-sidebar-btn");
    
    let mainCounter = 0; // Keeps track of the total number of favorites
    let favorites = new Set(); // Stores unique IDs of favorite items
    
    // Toggle sidebar visibility
    favToggleBtn.addEventListener('click', () => {
      favSidebar.classList.toggle("active"); // Show or hide sidebar when the favorites icon is clicked
    });
    
    // Close sidebar functionality
    closeSidebarBtn.addEventListener('click', () => {
      favSidebar.classList.remove("active"); // Hide sidebar when the close button is clicked
    });
    
    // Add event listeners to each card
    cards.forEach((card) => {
      card.addEventListener('click', () => {
        const isActive = card.classList.contains('heart-active'); // Check if the card is already a favorite
        card.classList.toggle("heart-active"); // Toggle favorite state (add/remove heart-active class)
    
        if (isActive) {
          mainCounter -= 1; // Decrease counter when removed from favorites
          removeFromFav(card); // Remove the card from the favorites list
        } else {
          mainCounter += 1; // Increase counter when added to favorites
          addToFav(card); // Add the card to the favorites list
        }
    
        mainFav.textContent = mainCounter; // Update the favorites counter
      });
    });
    
    // Add card to favorites
    function addToFav(card) {
      const cardData = getCardData(card); // Extract relevant data from the card
    
      // Avoid duplicate entries in favorites
      if (favorites.has(cardData.id)) return; // If the card is already in favorites, do nothing
    
      favorites.add(cardData.id); // Add the card ID to the favorites set
    
      // Create a new element for the sidebar to display the favorite card
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
    
      // Add functionality to the "Remove" button to remove the card from favorites
      favCard.querySelector(".remove-btn").addEventListener('click', () => {
        removeFromFav(card); // Remove the card from the favorites list
        card.classList.remove("heart-active"); // Remove heart-active class from the card
        mainCounter -= 1; // Decrease the favorites counter
        mainFav.textContent = mainCounter; // Update the favorites counter display
      });
    
      favItems.appendChild(favCard); // Add the favorite card to the sidebar
    }
    
    // Remove card from favorites
    function removeFromFav(card) {
      const cardData = getCardData(card); // Extract relevant data from the card
    
      favorites.delete(cardData.id); // Remove the card ID from the favorites set
    
      // Find the corresponding favorite card in the sidebar and remove it
      const favCard = favItems.querySelector(`[data-id="${cardData.id}"]`);
      if (favCard) {
        favItems.removeChild(favCard); // Remove the favorite card element from the sidebar
      }
    }
    
    // Extract data from card
    function getCardData(card) {
      return {
        id: card.querySelector(".pro-card-btn").id, // Unique ID for the card
        image: card.querySelector("img").src, // Image source
        title: card.querySelector(".card-text").textContent.trim(), // Card title
        price: card.querySelector("span").textContent.trim(), // Card price
      };
    }
    
    

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1";
})