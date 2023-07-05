<header>
    <div id="sticky-header" class="menu__area transparent-header">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile__nav__toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu__wrap">
                        <nav class="menu__nav">
                            <div class="logo">
                                <a href="{{ url('/') }}" class="logo__black"><img src="{{ asset('frontend/assets/img/logo/logo_black.png') }}" alt=""></a>
                                <a href="{{ url('/') }}" class="logo__white"><img src="{{ asset('frontend/assets/img/logo/logo_white.png') }}" alt=""></a>
                            </div>
                            <div class="navbar__wrap main__menu d-none d-xl-flex">
                                <ul class="navigation ps-5">

                                    @php
                                        //on stocke le nom de la route courante dans la var $route
                                        $route = Route::current()->getName();
                                    @endphp

                                    <!-- Home -->
                                    <li class="{{ ($route == 'home')? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>

                                    <!-- About -->
                                    <li class="{{ ($route == 'home.about')? 'active' : '' }}"><a href="{{ route('home.about') }}">About</a></li>

                                    <!-- Portfolio -->
                                    <li class="{{ ($route == 'home.portfolio' || $route == 'portfolio.details')? 'active' : '' }}"><a href="{{ route('home.portfolio') }}">Portfolio</a></li>

                                    <!-- Blog -->
                                    <li class="{{ ($route == 'home.blog' || $route == 'category.blog' || $route == 'blog.details')? 'active' : '' }}"><a href="{{ route('home.blog') }}">Our Blog</a>
                                    </li>
                                    <li class="{{ ($route == 'contact.me')? 'active' : '' }}"><a href="{{ route('contact.me') }}">contact me</a></li>

                                </ul>
                            </div>
                            <div class="header__btn d-none d-md-block me-5">
                                <a href="{{ route('admin.login') }}" target="_blank" class="btn">Admin Part</a>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="mobile__menu">
                        <nav class="menu__box">
                            <div class="close__btn"><i class="fal fa-times"></i></div>
                            <div class="nav-logo">
                                <a href="index.html" class="logo__black"><img src="{{ asset('frontend/assets/img/logo/logo_black.png') }}" alt=""></a>
                                <a href="index.html" class="logo__white"><img src="{{ asset('frontend/assets/img/logo/logo_white.png') }}" alt=""></a>
                            </div>
                            <div class="menu__outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu__backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>