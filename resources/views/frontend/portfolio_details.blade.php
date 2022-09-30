@extends('frontend.main_master')
@section('id_main')

@section('title')
    Portfolio-Details | Easy-WebSite
@endsection

@php
    $footer = App\Models\Footer::find(1);
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<main>

<!-- breadcrumb-area -->
<section class="breadcrumb__wrap">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="breadcrumb__wrap__content">
                    <h2 class="title">{{ $portfolio->portfolio_name }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $portfolio->portfolio_name }}</li>
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

<!-- portfolio-details-area -->
<section class="services__details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services__details__thumb">
                    <img src="{{ asset($portfolio->portfolio_image) }}" height="430px" width="850px" alt="">
                </div>
                <div class="services__details__content">
                    <h2 class="title">{{ $portfolio->portfolio_title }}</h2>
                    <p>{!! $portfolio->portfolio_description !!}</p>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="services__sidebar">
                    <div class="widget">
                        <h5 class="title">Get in Touch</h5>
                        <form method="POST" id="myFormSide" action="{{ route('store.contact') }}" class="sidebar__contact">
                            @csrf

                            <div class="form-group">
                                <input name="name" class="form-control" type="text" placeholder="Enter name*">
                            </div>

                            <div class="form-group">
                                <input name="email" class="form-control" type="email" placeholder="Enter your mail*">
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-control" id="message" placeholder="Massage*"></textarea>
                            </div>
                            
                            <button type="submit" class="btn">send massage</button>
                        </form>
                    </div>
                    
                    <div class="widget">
                        <h5 class="title">Contact Information</h5>
                        <ul class="sidebar__contact__info">
                            <li><span>Address :</span> {{ $footer->adress }}</li>
                            <li><span>Mail :</span> {{ $footer->email }}</li>
                            <li><span>Phone :</span> {{ $footer->number }}</li>
                            <li><span>Fax id :</span> +9 659459 49594</li>
                        </ul>
                        <ul class="sidebar__contact__social">
                            <li><a href="{{ $footer->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $footer->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $footer->linkdin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="{{ $footer->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                            <li><a href="{{ $footer->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="{{ $footer->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- portfolio-details-area-end -->


</main>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myFormSide').validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
                message: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter your name',
                },
                email: {
                    required : 'Please Enter your email',
                },
                message: {
                    required : 'Please Enter your message',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection