function QueryParam(value) {
    const urlValue = new URLSearchParams(window.location.search);
    return urlValue.get(value); // Retrieves the query parameter value
}

const cardIn = QueryParam("product");

const cardData = {
    card1: {
        image: "img/product-01.jpg",
        para: "Front Pocket Jumper",
        price: "$34.47",
        description: "The suit featured on this page is a perfect blend of style and comfort, designed for modern women who value both elegance and practicality. Crafted from high-quality, breathable fabric, it’s ideal for summer outings or casual gatherings. The timeless design, complete with a front pocket detail, adds a touch of sophistication while ensuring versatility for various occasions. Whether you’re dressing up or down, this suit is a wardrobe essential that guarantees comfort and style in every wear"
    }
};
    if (cardData[cardIn]) {
    document.getElementById("card-image").src = cardData[cardIn].image;
    document.getElementById("card-parah").innerText = cardData[cardIn].para;
    document.getElementById("card-price").innerText = cardData[cardIn].price;
    document.getElementById("card-description").innerText = cardData[cardIn].description;
} else {
    document.querySelector(".container").innerHTML = "<p>card not found!</p>";
}

    // incremnet and decrement function 

    const quantityInput = document.getElementById("quantity");
    const incrementBtn = document.getElementById("increment");
    const decrementBtn = document.getElementById("decrement");

    incrementBtn.addEventListener('click' , () => {
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
    });

    decrementBtn.addEventListener('click' , () => {
        let value = parseInt(quantityInput.value);
        if (value > 1){
            quantityInput.value = value - 1;
        } 
    })

//  goBack function 

 function goBack(){
    window.location.href = "index.html"
 }