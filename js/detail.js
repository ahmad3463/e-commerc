function QueryParam(value) {
    const urlValue = new URLSearchParams(window.location.search);
    return urlValue.get(value); // Retrieves the query parameter value
}

const cardIn = QueryParam("product-1");

const cardData = {
    card1: {
        image: "img/product-01.jpg",
        para: "Front Pocket Jumper",
        price: "$34.47",
        description: "Here is the data about the item. This is a cool suit that is comfortable for women. People also like this. This is a summer collection. It is very useful. If you like, you can buy it here or visit our offline store for a discount. Thanks for your kindness!"
    }
};
console.log("Query Parameter Value:", cardIn);
console.log(Object.keys(cardData));
if (cardData[cardIn]) {
    document.getElementById("card-image").src = cardData[cardIn].image;
    document.getElementById("card-parah").innerText = cardData[cardIn].para;
    document.getElementById("card-price").innerText = cardData[cardIn].price;
    document.getElementById("card-description").innerText = cardData[cardIn].description;
} else {
    document.querySelector(".container").innerHTML = "<p>card not found!</p>";
}
