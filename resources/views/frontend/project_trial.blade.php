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
                        Demo Project
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
    <!-- Scrollnav -->
    <div id="scrollnav" class="scroll-nav-wrapper">
        <div class="container">
            <div class="tabs scrollnav-tabs is-centered">
                <ul>
                    <li class="scrollnav-item is-active"><a onclick="filter(0)">All Expertise</a></li>
                    @foreach ($expertises as $expertise)
                        <li class="scrollnav-item"><a onclick="filter({{$expertise->id_expertise}})">{{$expertise->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>  
    </div>
    <!-- /Scrollnav -->
    <!-- Card Section -->
    <section id="product-fe" class="section section-light-grey is-medium">
        <div class="container">
            <div class="section-title-wrapper">
                <div class="bg-number">1</div>
                <h2 class="title section-title has-text-centered dark-text"> Our Project</h2>
                {{-- <div class="subtitle has-text-centered is-tablet-padded">
                    Discover many pre-built integrations with the most popular apps of the web to kickstart your system.
                </div> --}}
            </div>
    
            <div class="content-wrapper">
                <div class="columns integration-cards is-minimal is-vcentered is-gapless is-multiline ganti">
                    <!-- Card -->
                    @foreach ($trials as $trial)
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered">
                                <div class="brand-logo">
                                    <img src="{{asset($trial->project->image)}}" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>{{$trial->project->name}}</h4>
                                </div>
                                <div class="card-feature-description">
                                    @if (session()->get('language') == 'id')
                                        <span>{{$trial->project->description}}</span>
                                    @else
                                        <span>{{$trial->project->description_en}}</span>
                                    @endif
                                    
                                </div>
                                <a href="{{$trial->url}}" class="button btn-align primary-btn btn-outlined is-bold rounded">Try Project</a>
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

@section('js-bawah')
<script>
    function filter(id_expertise){
        var id = id_expertise+100;
        jQuery.ajax({
                url: "/filter/"+id,
                method: 'get',
                success: function(result){
                    $('.ganti').html(result.view);
                }                             
            });
    } 
</script>
@endsection