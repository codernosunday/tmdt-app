@vite(['resources/js/listspscript/listsp.js'])
@vite(['resources/scss/listsp.scss'])
<section id="foodies" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Văn phòng phẩm</h2>
            <div class="mb-4 mb-md-0">
                {{-- <p class="m-0">
                    <button class="filter-button me-4  active" data-filter="*">ALL</button>
                    <button class="filter-button me-4 " data-filter=".cat">CAT</button>
                    <button class="filter-button me-4 " data-filter=".dog">DOG</button>
                    <button class="filter-button me-4 " data-filter=".bird">BIRD</button>
                </p> --}}
                <div class="container mt-3 text-center">
                    <div class="container mt-3 text-center">
                        <div class="category-container">
                            <span class="arrow me-3" onclick="scrollCategories(-1)">&#9665;</span>
                            <div class="category-wrapper">
                                <ul class="category-list" id="categoryList">
                                    <li class="category-item">ALL</li>
                                    <li class="category-item">CAT</li>
                                    <li class="category-item">DOG</li>
                                    <li class="category-item">BIRD</li>
                                    <li class="category-item">FISH</li>
                                    <li class="category-item">RABBIT</li>
                                    <li class="category-item">TURTLE</li>
                                    <li class="category-item">HORSE</li>
                                    <li class="category-item">HAMSTER</li>
                                    <li class="category-item">FERRET</li>
                                    <li class="category-item">SNAKE</li>
                                    <li class="category-item">LIZARD</li>
                                </ul>
                            </div>
                            <span class="arrow ms-3" onclick="scrollCategories(1)">&#9655;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    shop now
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg></a>
            </div>
        </div>

        <div class="isotope-container row">

            <div class="col-md-4 col-lg-3 my-4">
                <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
                <div class="card position-relative">
                    <a href="single-product.html"><img
                            src="https://product.hstatic.net/1000230347/product/upload_14179c4bbcf244aaa87ad286d86166a0_37c5c5c47ae84dd980ce7b3224a88324_large.jpg"
                            class="img-fluid rounded-4 w-50 h-50" alt="image"></a>
                    <div class="card-body p-0">
                        <a href="single-product.html">
                            <h5 class="card-title pt-4 m-0">Combo 5 Băng keo đục OPP Flexoffice FO-BKD06</h5>
                        </a>

                        <div class="card-text">

                            <h3 class="secondary-font text-primary">$18.00</h3>

                            <div class="d-flex flex-wrap mt-3">
                                <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                                </a>
                                <a href="#" class="btn-wishlist px-4 pt-3 ">
                                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>