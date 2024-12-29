
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
    const cards = document.querySelectorAll(".mt-2");
    let mainCounter = 0;

    
    cards.forEach((card) => {
        card.addEventListener('click' , () => {
            const isActive = card.classList.contains('heart-active');
            card.classList.toggle("heart-active");
            // console.log("working")
            if(isActive){
                mainCounter -= 1;
            }else{
                mainCounter += 1;
              }
              mainFav.textContent = mainCounter;

        });
    });
    

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1";
})