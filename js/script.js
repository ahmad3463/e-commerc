
const navBar = document.getElementById("navbar");

window.addEventListener('scroll' , () => {
    if(window.scrollY > 0){
        navBar.classList.add("sticky")
    }else{
        navBar.classList.remove("sticky");
    }
});