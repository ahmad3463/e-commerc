
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
    const favContainer = document.getElementById("main-fav-container"); // Container for storing favorite cards
    const cards = document.querySelectorAll(".mt-2");
    let mainCounter = 0;
    
    cards.forEach((card) => {
        card.addEventListener('click', () => {
            const isActive = card.classList.contains('heart-active');
            card.classList.toggle("heart-active");
            
            if (isActive) {
                mainCounter -= 1;
                removeFromFav(card);
            } else {
                mainCounter += 1;
                addToFav(card);
            }
            
            mainFav.textContent = mainCounter;
        });
    });
    
    // function addToFav(card) {
    //     // Create a new element for displaying in the favorites section
    //     const cardData = document.createElement("div");
    //     cardData.className = "fav-card";
    //     cardData.innerHTML = `
    //         <h5>${card.querySelector(".card-title").textContent}</h5>
    //         <p>${card.querySelector(".card-text").textContent}</p>
    //         <button class="remove-btn">Remove</button>
    //     `;
    
    //     // Add a remove functionality to the "Remove" button
    //     cardData.querySelector(".remove-btn").addEventListener('click', () => {
    //         removeFromFav(card);
    //         const originalCard = Array.from(cards).find(c => c.isEqualNode(card));
    //         if (originalCard) originalCard.classList.remove('heart-active');
    //         mainCounter -= 1;
    //         mainFav.textContent = mainCounter;
    //     });
    
    //     favContainer.appendChild(cardData);
    // }
    
    // function removeFromFav(card) {
    //     const favCards = favContainer.querySelectorAll(".fav-card");
    //     favCards.forEach((favCard) => {
    //         if (favCard.querySelector("h5").textContent === card.querySelector(".card-title").textContent) {
    //             favContainer.removeChild(favCard);
    //         }
    //     });
    // }
    
    

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1";
})