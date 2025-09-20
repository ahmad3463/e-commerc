<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-commerce</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="asessts/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>


  <div id="fav-sidebar" class="fav-sidebar">
    <button id="close-sidebar-btn" class="close-sidebar-btn">X</button>
    <h4>Your Favorites</h4>
    <div id="fav-items"></div>
  </div>

  <!-- hero section or carosel -->
  <section class="carousel">

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
          <img src="img/slide-01.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-lg-5 pt-lg-5 me-5 w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5  text-dark ">women Collecton 2024</h3>
            <h1 class=" mt-2 me-5 text-dark">New season</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="img/slide-02.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-5 pe-3 pt-5 me-5  w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5 text-dark">Men New-Season</h3>
            <h1 class=" mt-2 me-5 pe-5 text-dark">Jackets & Coats</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide-03.jpg.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption top-0 end-100 mt-5 pt-5 me-5  w-50 caro-text">
            <h3 class=" mt-5 pt-5 me-5 fs-5 text-dark">Men Collecton 2024</h3>
            <h1 class=" mt-2 me-5 text-dark">New Arrivals</h1>
            <button class="normal me-2 mt-3"> Shop now</button>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
  </section>

  <!-- banner section is start -->
  <div class="container text-center margin-m1">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 mb-sm-2 position-relative hover-col">
        <div class="card">
          <img src="img/banner-01.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0  ms-5">
          <h3 class="card-text fw-bolder">Women</h3>
          <p class="fs-6 me-2">spring 2024</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 position-relative hover-col">
        <div class="card">
          <img src="img/banner-02.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0  ms-5">
          <h3 class="card-text fw-bolder">Men</h3>
          <p class="fs-6 me-2">spring 2024</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>
      <div class="col-lg-4 col-md-6  position-relative hover-col">
        <div class="card">
          <img src="img/banner-03.jpg.webp" class="card-img-top" alt="...">
        </div>
        <div class="card-body position-absolute top-0 mt-4 ms-5">
          <h3 class="card-text fw-bolder">Accessories</h3>
          <p class="fs-6 me-2">New Trend</p>
        </div>
        <div class="button-container">
          <button class="animated-btn">Shop Now</button>
        </div>
      </div>
    </div>
  </div>

  <!-- product section is start  -->
  <div class="container-fluid margin-m1 position-relative">
    <h1 class="ms-5">Product Overview</h1>
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-underline text-decoration-none ms-5 " id="myTab">
          <li class="nav-item me-3">
            <a class="nav-link active phead " data-bs-toggle="tab" href="#allproduct">
              All product
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link phead" data-bs-toggle="tab" href="#women">
              Women
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link phead " data-bs-toggle="tab" href="#men">
              Men
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link phead " data-bs-toggle="tab" href="#bag">
              Bag
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link phead " data-bs-toggle="tab" href="#Shoes">
              Shoes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link phead " data-bs-toggle="tab" href="#watches">
              Watches
            </a>
          </li>
        </ul>
        <div class="tab-content ms-5" id="myTabContent">
          <!-- allproduct tab is starting here  -->
          <div class="tab-pane show active fade py-5" id="allproduct">
            <div class="row row-cols-md-3">
              <div class="col-lg-3 col-md-4 mb-4 nation ">
                <div class="card h-100 pcard border-0  prod-hover ">
                  <img src="img/product-01.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn" id="product-1">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-02.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn "></i> </p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-03.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-04.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-05.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-06.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-07.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-08.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-09.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-10.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-11.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-12.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-13.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-14.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-15.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-16.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <i
                        class="fa-regular fa-heart mt-2 heart-btn"></i></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <!-- creating button for read more  -->

            </div>
            <div class="row text-center">
              <div class="col text-center mt-5 me-2">
                <button class="pmain-btn mt-3">Read More </button>
              </div>
            </div>

          </div>

          <!-- women tab is starting here  -->
          <div class="tab-pane fade py-5" id="women">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <div class="col-lg-3 mb-4 ">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-01.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>


              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-03.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-04.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-05.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-06.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-08.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-10.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-13.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-16.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <!-- creating button for read more  -->
              <div class="col text-center mt-5 me-2">
                <button class="pmain-btn mt-3">Read More </button>
              </div>

            </div>
          </div>

          <!-- men tab is starting here  -->
          <div class="tab-pane fade py-5" id="men">
            <div class="row row-cols-md-3">

              <div class="col-lg-3  mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-07.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-11.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-12.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- bag tab is starting here  -->
          <div class="tab-pane fade py-5" id="Bag">

          </div>

          <!-- shoes tab is starting here  -->
          <div class="tab-pane fade py-5" id="Shoes">
            <div class="row">

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-09.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

            </div>
          </div>


          <!-- watches is starting here  -->
          <div class="tab-pane fade py-5" id="watches">
            <div class="row row-cols-md-3">
              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-02.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 mb-4">
                <div class="card h-100 pcard border-0  prod-hover">
                  <img src="img/product-15.jpg.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text d-flex justify-content-between ">Front Pocket Jumper <img src="img/heart.svg"
                        class="mt-2"></p>
                  </div>
                  <span class="ms-3 ">$34.37</span>
                  <div class="probutton">
                    <button class="pro-card-btn">Quick Veiw</button>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- footer is start  -->



  <script src="asessts/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>