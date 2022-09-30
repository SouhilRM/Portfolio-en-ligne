@php
    //le limit(3) ici c'est pour qu'il n y ai qie trois blog de afiicher e ca sera les trois derniers ajouter
    $blog = App\Models\Blog::latest()->limit(6)->get();
@endphp

<section class="blog ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section__title text-center">
                    <span class="sub-title">06 - Blogs</span>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="row gx-0 justify-content-center">

            @foreach ($blog as $item)
                <div class="col-lg-4 col-md-6 col-sm-9 p-3">
                    <div class="blog__post__item">
                        <div class="blog__post__thumb">
                            <a href="{{ route('blog.details',$item->id) }}"><img src="{{ asset( $item->blog_image ) }}" width="430px" height="327px" alt=""></a>
                            <div class="blog__post__tags">
                                <a href="{{ route('category.blog',$item->blog_category_id) }}">{{ $item['category']['blog_category'] }}</a>
                            </div>
                        </div>
                        <div class="blog__post__content">
                            <!--
                                -tu peux mettre {{ $item->created_at }} mais ca affiche 2022-09-22 20:52:14 et c'est tres moche 
                                -nous on veut que ca affiche ca fait combien de temps qu'il a ete posté
                                -c'est pour ca qu'on utilise le carbon
                            -->
                            <span class="date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            <h3 class="title"><a href="{{ route('blog.details',$item->id) }}">{{ $item->blog_title }}</a></h3>
                            <a href="{{ route('blog.details',$item->id) }}" class="read__more">Read mORe</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="blog__button text-center">
            <a href="{{ route('home.blog') }}" class="btn">more blog</a>
        </div>
    </div>
</section>