@extends('frontend.main_master')
@section('id_main')

@section('title')
    Blog-Category | Easy-WebSite
@endsection

<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                            <h2 class="title">{{ $category_name->blog_category }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">BLOGS</li>
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


    <!-- blog-area -->
    <section class="standard__blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    @foreach($blog_post as $item)
                        <div class="standard__blog__post">
                            <div class="standard__blog__thumb">
                                <a href="{{ route('blog.details',$item->id) }}"><img src="{{ asset( $item->blog_image ) }}" width="850px" height="430px" alt=""></a>
                                <a href="{{ route('blog.details',$item->id) }}" class="blog__link"><i class="far fa-long-arrow-right"></i></a>
                            </div>
                            <div class="standard__blog__content">
                                
                                <h2 class="title"><a href="{{ route('blog.details',$item->id) }}">{{ $item->blog_title }}</a></h2>
                                <p>{!! $truncated = Str::limit($item->blog_description, 300); !!}</p>
                                <ul class="blog__post__meta">
                                    <li><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</li>
                                    
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    <!-- paginations -->
                    <div class="pagination-wrap">
                        {{ $blog_post->links('vendor.pagination.personal_pagination') }}
                    </div>
                    <!-- end paginations -->
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
    <!-- blog-area-end -->

</main>
@endsection