
const navBar = document.getElementById("navbar");

window.addEventListener('scroll' , () => {
    if(window.scrollY > 0){
        navBar.classList.add("sticky")
    }else{
        navBar.classList.remove("sticky");
    }
});

// product section 

document.getElementById("product-1").addEventListener('click' , function (){
    window.location.href="detail.html?product=card1;";
})