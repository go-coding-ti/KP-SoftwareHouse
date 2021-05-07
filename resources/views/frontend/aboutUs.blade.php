@extends('layouts.app-frontend')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/core_flashy.css')}}">
@endpush

@section('div-nav')
    <div class="hero is-relative is-theme-primary">
@endsection

@section('jumbotron')
    <div id="main-hero" class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-vcentered pt-80 pb-80">
                <div class="column is-5 signup-column has-text-left">
                    <h1 class="title main-title text-bold is-2">
                        About Us
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
            <!-- Title -->
            <div class="centered-title">
                <h2>Meet the Team</h2>
                <div class="title-divider"></div>
            </div>
            <!-- Title -->
            <div class="content-wrapper">
                <div class="modern-team">
                    @if ($teams->count() > 0)
                        @foreach ($teams as $team)
                            <!-- Team member -->
                            <article class="modern-team-item circle-mask rotate-zoom-effect">
                                <div class="item-wrapper">
                                    <div class="item-img">
                                        <img src="{{asset($team->image)}}" class="member-avatar" alt="">
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h3 class="member-name"><strong>{{$team->name}}</strong></h3>
                                    <span class="member-position">{{$team->department}}</span>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </section>

    <!-- Company Profile section -->
    <section class="section section-feature-grey is-medium huge-pb">
        <div class="container">
            <!-- Title -->
            <div class="centered-title">
                <h2>Profile Company</h2>
                <div class="title-divider"></div>
                <div class="has-text-centered mt-40 mb-40 is-title-reveal">
                    <a href="{{asset($aboutUs->file_profile_company)}}" class="button button-cta is-bold btn-align primary-btn btn-outlined rounded">Download Company Profile (PDF)</a>
                </div>
            </div>
            <!-- /Title -->
    
            <!-- Company Profile steps -->
            <div class="content-wrapper">
                    @if (session()->get('language') == 'id')
                        {!!$aboutUs->description_ina!!}
                    @else
                        {!!$aboutUs->description_eng!!}
                    @endif
            </div>
            <!-- /Company Profile steps -->
        </div>
    </section>
    <!-- /Company Profile section -->
    
    <!-- /UI Feature -->
    <section class="section section-light-grey is-medium">
        <div class="container">
            <!-- Title -->
            <div class="centered-title">
                <h2>Our Video</h2>
                <div class="title-divider"></div>
            </div>
            <div class="columns is-vcentered">
                <div class="column is-5 is-offset-1">
                    <!-- Video block -->
                    <div class="side-block is-title-reveal">
                        <div class="background-wrapper">
                            <div id="video-embed" class="video-wrapper" data-url="{!! $aboutUs->link_video !!}">
                                <div class="video-overlay"></div>
                                <div class="playbutton">
                                    <div class="icon-play">
                                        <i class="im im-icon-Play-Music"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Video block -->
                </div>
    
                <div class="column is-4 is-offset-1">
                    <!-- Title -->
                    <div class="title-wrapper">
                        <h6 class="top-subtitle">Watch the video and</h6>
                        <h2 class="title is-landing quick-feature">
                            Get started fast
                        </h2>
                        <div class="title-divider is-small"></div>
                    </div>
                    <!-- /Title -->
    
                    <span class="section-feature-description">
                        @if (session()->get('language') == 'id')
                            {!! $aboutUs->video_description_ina !!}
                        @else
                            {!! $aboutUs->video_description_eng !!}
                        @endif
                    </span>
                </div>    
            </div>
        </div>
    </section>
    <!-- /UI Feature -->

    <!-- Clients grid -->
    <section id="trust" class="section section-feature-grey is-medium">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper has-text-centered">
                <div class="bg-number"><i class="material-icons">domain</i></div>
                <h2 class="section-title-landing"> We build Trust with.</h2>
            </div>
    
            <div class="content-wrapper">
                <!-- Grid -->
                <div class="">
                        <div class="columns is-vcentered is-multiline">
                            <div class="column"></div>
                            @foreach ($instansis as $instansi)
                                <div class="column is-2">
                                    <a href="{{$instansi->url}}"><img style="max-height: 100px; max-width: 100px;" class="client" src="{{$instansi->image}}" alt=""></a>
                                </div>
                            @endforeach
                            <div class="column"></div>
                        </div>
                </div>
                <!-- CTA -->
                <!-- /CTA -->
            </div>
        </div>
    </section>
    <!-- Clients -->
    

    <!-- /Card Section -->    


@endsection

@section('js-atas')
    <script src="{{asset('assets/frontend/js/landingv2.js')}}"></script>
@endsection