@extends('frontend.main_master')
@section('id_main')

@section('title')
    Blog-Details | Easy-WebSite
@endsection

<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">{{ $blog->blog_title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $blog->blog_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__wrap__icon">
            <ul>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon09.png') }}" alt=""></li>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon02.png') }}" alt=""></li>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon08.png') }}" alt=""></li>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon11.png') }}" alt=""></li>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon10.png') }}" alt=""></li>
                <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon07.png') }}" alt=""></li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb-area-end -->


    <!-- blog-details-area -->
    <section class="standard__blog blog__details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="standard__blog__post">
                        <div class="standard__blog__thumb">
                            <img src="{{ asset( $blog->blog_image ) }}" width="850px" height="430px" alt="">
                        </div>
                        <div class="blog__details__content services__details__content">
                            <ul class="blog__post__meta">
                                <li><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</li>
                             
                            </ul>
                            <h2 class="title">{{ $blog->blog_title }}</h2>
                            <p>{!! $blog->blog_description !!}</p>
                        </div>
                        <div class="blog__details__bottom">
                            <ul class="blog__details__tag">
                                <li class="title">Tag:</li>
                                <li class="tags-list">
                                    <a href="#">{{ $blog->blog_tags }}</a>
                                </li>
                            </ul>
                            <ul class="blog__details__social">
                                <li class="title">Share :</li>
                                <li class="social-icons">
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="blog__sidebar">

                        <!-- search-bar -->
                        <div class="widget">
                            <form method="GET" action="{{ route('search.blog') }}" class="search-form">
                                @csrf
                                <input type="text" name="search" placeholder="Search">
                                <button type="submit"><i class="fal fa-search"></i></button>
                            </form>
                        </div>


                        <!-- recent Blogs -->
                        <div class="widget">
                            <h4 class="widget-title">Recent Blog</h4>
                            <ul class="rc__post">

                                @foreach($all_blog as $item)
                                    <li class="rc__post__item">
                                        <div class="rc__post__thumb">
                                            <a href="{{ route('blog.details',$item->id) }}"><img src="{{ asset( $item->blog_image ) }}" alt=""></a>
                                        </div>
                                        <div class="rc__post__content">
                                            <h5 class="title"><a href="{{ route('blog.details',$item->id) }}">{{ $item->blog_title }}</a></h5>
                                            <span class="post-date"><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- end recent blog -->

                        <!-- categories -->
                        <div class="widget">
                            <h4 class="widget-title">Categories</h4>
                            <ul class="sidebar__cat">
                                @foreach($category as $item)
                                    <li class="sidebar__cat__item"><a href="{{ route('category.blog',$item->id) }}">{{ $item->blog_category }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- categories -->


                        
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details-area-end -->

</main>
@endsection