<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Apr 2024 08:02:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<!-- Head -->
@include('client.partrials.head')
<!-- /.Head -->

<body>
    <div class="page-wrapper">

        <!-- Top-notice -->
        @include('client.partrials.top-notice')
        <!-- /.Top-notice -->


        <!-- Header -->
        @include('client.partrials.header')
        <!-- /.Header -->


        <!-- Main -->
        <main class="main">
            @yield('page-content')
        </main>
        <!-- ./Main -->

        <!-- Footer -->
        @include('client.partrials.footer')


    </div>
    <!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="demo4.html">Home</a></li>
                    <li>
                        <a href="category.html">Categories</a>
                        <ul>
                            <li><a href="category.html">Full Width Banner</a></li>
                            <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                            <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                            <li><a href="https://www.portotheme.com/html/porto_ecommerce/category-sidebar-left.html">Left Sidebar</a></li>
                            <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                            <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                            <li><a href="category-horizontal-filter1.html">Horizontal Filter 1</a></li>
                            <li><a href="category-horizontal-filter2.html">Horizontal Filter 2</a></li>
                            <li><a href="#">List Types</a></li>
                            <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll<span
										class="tip tip-new">New</span></a></li>
                            <li><a href="category.html">3 Columns Products</a></li>
                            <li><a href="category-4col.html">4 Columns Products</a></li>
                            <li><a href="category-5col.html">5 Columns Products</a></li>
                            <li><a href="category-6col.html">6 Columns Products</a></li>
                            <li><a href="category-7col.html">7 Columns Products</a></li>
                            <li><a href="category-8col.html">8 Columns Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="product.html">Products</a>
                        <ul>
                            <li>
                                <a href="#" class="nolink">PRODUCT PAGES</a>
                                <ul>
                                    <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                    <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                    <li><a href="product.html">SALE PRODUCT</a></li>
                                    <li><a href="product.html">FEATURED & ON SALE</a></li>
                                    <li><a href="product-sticky-info.html">WIDTH CUSTOM TAB</a></li>
                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul>
                                    <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                    <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                    <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                    <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                    <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                    <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                    <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                    <li><a href="#">BUILD YOUR OWN</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                        <ul>
                            <li>
                                <a href="wishlist.html">Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="#">Elements</a>
                        <ul class="custom-scrollbar">
                            <li><a href="element-accordions.html">Accordion</a></li>
                            <li><a href="element-alerts.html">Alerts</a></li>
                            <li><a href="element-animations.html">Animations</a></li>
                            <li><a href="element-banners.html">Banners</a></li>
                            <li><a href="element-buttons.html">Buttons</a></li>
                            <li><a href="element-call-to-action.html">Call to Action</a></li>
                            <li><a href="element-countdown.html">Count Down</a></li>
                            <li><a href="element-counters.html">Counters</a></li>
                            <li><a href="element-headings.html">Headings</a></li>
                            <li><a href="element-icons.html">Icons</a></li>
                            <li><a href="element-info-box.html">Info box</a></li>
                            <li><a href="element-posts.html">Posts</a></li>
                            <li><a href="element-products.html">Products</a></li>
                            <li><a href="element-product-categories.html">Product Categories</a></li>
                            <li><a href="element-tabs.html">Tabs</a></li>
                            <li><a href="element-testimonial.html">Testimonials</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="mobile-menu mt-2 mb-2">
                    <li class="border-0">
                        <a href="#">
							Special Offer!
						</a>
                    </li>
                    <li class="border-0">
                        <a href="#" target="_blank">
							Buy Porto!
							<span class="tip tip-hot">Hot</span>
						</a>
                    </li>
                </ul>

                <ul class="mobile-menu">
                    <li><a href="login.html">My Account</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="wishlist.html">My Wishlist</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="login.html" class="login-link">Log In</a></li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->

            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="demo4.html">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="category.html" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="login.html" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
					<span class="cart-count badge-circle">3</span>
				</i>Cart
            </a>
        </div>
    </div>

    {{-- <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url({{asset("client")}}/assets/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            <img src="{{asset("client")}}/assets/images/logo.png" width="111" height="44" alt="Logo" class="logo-newsletter">
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the Porto mailing list to receive updates on new arrivals, special offers and our promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Your email address" required />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                    <label for="show-again" class="custom-control-label">
						Don't show this popup again
					</label>
                </div>
            </div>
        </div>
        <!-- End .newsletter-popup-content -->

        <button title="Close (Esc)" type="button" class="mfp-close">
			×
		</button>
    </div> --}}
    <!-- End .newsletter-popup -->


    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


</body>

    <!-- Script -->
    @include('client.partrials.script')
    <!-- ./Script -->

    <!-- JsHandle -->
    @stack('jsHandle')
    <!-- ./JsHandle -->

    {{-- Live search --}}
    <script>
        let searchInput = document.querySelector('#q');
        let searchCategory = document.querySelector('#cat');
        let searchResultContainer = document.querySelector('#search-result-container');
        console.log(searchInput.value);
        console.log(searchCategory.value);
        searchInput.addEventListener('keyup', function(e) {
            // console.log(searchCategory.value);

            $.ajax({
                url: "/live-search",
                data: {
                    searchKey: e.target.value,
                    searchCategory: searchCategory.value
                },
                method: "GET",
                success: function(data) {
                    // console.log(data.searchResult);
                    console.log(data);
                    let renderResult = "";
                    if ((data).length == 0) {
                        renderResult = `
                            <li class="search-item p-4 text-center" >
                                Không tìm thấy kết quả
                            </li>
                        `;
                    } else {
                        (data).forEach((product) => {
                            let renderProductPrice = "";
                            // let productId = element.id;
    
                            if (product.price_sale != '0') {
                                renderProductPrice = `
                                    <span style='text-decoration: line-through' class="mr-2">${formatCash((product.price).toString())}</span>
                                    <span style="font-size: 17px;">${formatCash((product.price_sale).toString())}</span>
                                `;
                            } else {
                                renderProductPrice = `
                                    <span style="font-size: 17px;">${formatCash((product.price).toString())}</span>
                                `;
                            }
    
                            renderResult += `
                                <li class="search-item p-3" >
                                    <a href="/san-pham/${product.slug}">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage') }}/${product.thumbnail}"
                                                width="50px;" alt="">
                                            <div class="ml-3">
                                                <p class="text-left">${product.name}</p>
                                                <div class="text-left">
                                                    ${renderProductPrice}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            `;
                        })
                    }
                    searchResultContainer.innerHTML = renderResult;
                }
            });
        });
        
    </script>

    <script type="module">
        const listNotification = document.getElementById('notification-list');
        const notificationItems = document.getElementsByClassName('notification-item');
        const totalUnreadNotification = document.getElementById('total-unread-notification');

        toastr.options.closeButton = true;
        toastr.options.progressBar = true;

        Echo.private('App.Models.User.' + 44)
            .notification((notification) => {
                if (listNotification.children && listNotification.children.length == 5) {
                    listNotification.children[0].remove();
                }

                let newNotificationItem = document.createElement("div");
                newNotificationItem.classList.add("dropdown-item", "d-flex", "justify-content-between", "align-items-center", "notification-items");
                newNotificationItem.innerHTML = `
                    <div class="d-flex justify-content-start align-items-start p-3 border-bottom notification-item">
                        <div class="align-self-start p-2">
                            <i class="fas fa-bell mr-3 mt-2 text-warning" style="font-size: 22px"></i>
                        </div>
                        <div>
                            <h5 class="my-0 font-weight-bold" style="font-size: 16px">${notification.title}</h5>
                            <span style="font-size: 12px" class="text-muted">${notification.message}</span>
                            <p style="font-size: 12px" class="text-muted mt-1">${notification.created_at}</p>
                        </div>
                    </div>
                `;

                // Append to the list
                listNotification.prepend(newNotificationItem);
                totalUnreadNotification.textContent = Number(totalUnreadNotification.textContent)+1

                toastr.success(notification.message, notification.title);
                console.log(notification)
            });
    </script>
<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Apr 2024 08:02:12 GMT -->
</html>