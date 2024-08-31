@extends('frontend.layout.homepagelayout')

@section('content')

<!-- ========== Start product slider ========== -->
    <section class="product-details">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-12">
                    <div id="carouselExampleIndicators-two" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators-two" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators-two" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/s-1.webp" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/s-1.webp" class="d-block w-100" alt="...">
                            </div>

                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleIndicators-two" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleIndicators-two" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>


                <div class="col-lg-6 col-md-12">
                    <div class="text">
                        <p class="new">new products</p>
                        <h3 class="Men-Slim">Men Slim Fit Striped Slim Collar Casual Shirt
                        </h3>


                        <div class="alig-icon">
                            <div class="icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="text">
                                <p>39 preview</p>

                            </div>
                        </div>

                        <p class="p-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae veniam non sed
                            ex numquam cum dolore vero beatae, tempore alias assumenda perferendis distinctio error
                            perspiciatis rem explicabo doloremque. Totam delectus perspiciatis autem voluptatibus
                            dolorem sit! Labore temporibus consequuntur alias facilis.</p>
                        <div class="align-tab">
                            <div class="color">
                                <h5 class="select">select color </h5>
                                <button class="red"> </button>
                                <button class="black"> </button>
                                <button class="blue"> </button>
                                <button class="white"> </button>
                                <button class="gray"> </button>
                            </div>

                            <div class="size">
                                <h5 class="select">select size </h5>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">

                                        <li class="page-item"><a class="page-link" href="#">XS</a></li>
                                        <li class="page-item"><a class="page-link" href="#">S</a></li>
                                        <li class="page-item"><a class="page-link" href="#">M</a></li>
                                        <li class="page-item"><a class="page-link" href="#">L</a></li>
                                        <li class="page-item"><a class="page-link" href="#">XL</a></li>


                                    </ul>
                                </nav>

                            </div>
                        </div>







                        <div class="align-btn">
                            <h4>$25</h4>

                            <div class="add-cart">
                                <button> Buy Now</button>
                                <button>Customize & Donate     </button>
                                <button> Add To Cart                                </button>
                                <!-- <div class="number">
                                    <span class="minus">-</span>
                                    <input type="text" value="1" />
                                    <span class="plus">+</span>
                                </div> -->
                            </div>

                        </div>









                    </div>

                </div>
            </div>
    </section>
    <!-- ========== End product slider ========== -->

@endsection