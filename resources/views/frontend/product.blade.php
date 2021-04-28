@extends('layouts.app-frontend')

@section('div-nav')
    <div class="hero is-relative is-theme-primary">
@endsection

@section('jumbotron')
    <div id="main-hero" class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-vcentered pt-80 pb-80">
                <div class="column is-5 signup-column has-text-left">
                    <h1 class="title main-title text-bold is-2">
                        Product
                    </h1>
                    {{-- <h2 class="subtitle is-5 light-text no-margin-bottom">
                        (dummy) Produk yang telah kami buat dan siap untuk digunakan
                    </h2> --}}
                    <br>
                    <!-- Signup form -->
                    <div class="signup-block">
                        <p class="components-cta">
                            <a href="#product-fe" class="button button-cta btn-align light-btn btn-outlined is-bold rounded">
                                Get Started
                            </a>
                        </p>
                    </div>
                    <!-- /Signup form -->
                </div>
                <div class="column is-offset-1">
                    <!-- Hero mockup -->
                    <figure class="image is-hidden-mobile">
                        <img src="{{asset('assets/images/illustrations/UI/globalytics.png')}}" alt="">
                    </figure>
                    <!-- /Hero mockup -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Card Section -->
    <section id="product-fe" class="section section-light-grey is-medium">
        <div class="container">
            <div class="section-title-wrapper">
                <div class="bg-number">1</div>
                <h2 class="title section-title has-text-centered dark-text"> Our Product</h2>
                {{-- <div class="subtitle has-text-centered is-tablet-padded">
                    Discover many pre-built integrations with the most popular apps of the web to kickstart your system.
                </div> --}}
            </div>
    
            {{-- <div class="content-wrapper">
                <div class="columns integration-cards is-minimal is-vcentered is-multiline">
                    <!-- Card -->
                    @foreach ($products as $product)
                        <div class="column is-4">
                            <div class="card card-md hover-inset has-text-centered">
                                <div class="card-image">
                                    <figure class="image is-48x48 float-right">
                                        <img src="{{asset($product->image)}}" alt="">
                                    </figure>
                                </div>
                                <div class="card-title">
                                    <h4>{{$product->title}}</h4>
                                </div>
                                <div class="card-feature-description">
                                    @if (session()->get('language') == 'id')
                                        <span>{{$product->description}}</span>
                                    @else
                                        <span>{{$product->description_en}}</span>
                                    @endif
                                    
                                </div>
                                <a href="{{$product->url}}" class="button btn-align primary-btn btn-outlined is-bold rounded">Discover Product</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}

            {{-- <div class="content-wrapper">
                <div class="columns is-vcentered latest-posts">
                    <!-- Article card -->
                    @foreach ($products as $product)
                    <div class="column is-4">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="{{asset($product->image)}}" alt="">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">{{$product->title}}</p>
                                    </div>
                                </div>
    
                                <div class="post-exerpt">
                                    @if (session()->get('language') == 'id')
                                        {{$product->description}}
                                    @else
                                        {{$product->description_en}}
                                    @endif
                                </div>
                                <div class="has-text-centered">
                                    <a class="button button-cta is-bold btn-align primary-btn btn-outlined rounded" href="{{$product->url}}">Discover Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> --}}

            <div class="content-wrapper">       
                <div class="columns integration-cards is-vcentered is-multiline">
                    <!-- Article card -->
                        @foreach ($products as $product)
                        <div class="column is-4">
                            <div class="card card-md hover-inset has-text-centered">
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img src="{{asset($product->image)}}" alt="">
                                    </figure>
                                </div>
                                <div class="card-title">
                                    <div class="media">
                                        <div class="media-content has-text-centered">
                                            <p class="title is-5">{{$product->title}}</p>
                                        </div>
                                    </div>
        
                                    <div class="post-exerpt">
                                        @if (session()->get('language') == 'id')
                                            <span>{{$product->description}}</span>
                                        @else
                                            <span>{{$product->description_en}}</span>
                                        @endif
                                    </div>
                                    <div class="has-text-centered">
                                        <a class="button button-cta is-bold btn-align primary-btn btn-outlined rounded" href="{{$product->url}}">Discover Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>


        </div>
    </section>
    <!-- /Card Section -->    
@endsection

@section('js-atas')
    <script src="{{asset('assets/frontend/js/landingv2.js')}}"></script>
@endsection