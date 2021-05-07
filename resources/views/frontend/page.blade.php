@extends('layouts.app-frontend')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/core_flashy.css')}}">
@endpush

@section('div-nav')
    <div class="hero is-relative is-theme-primary">
@endsection

@section('jumbotron')
        @php
            if(!$varMenu->name){
                $varMenu->name = $varMenu->title;
            }
        @endphp
    <div id="main-hero" class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-vcentered pt-80 pb-80">
                <div class="column is-5 signup-column has-text-left">
                    <h1 class="title main-title text-bold is-2">
                        @if ($varMenu->menu)
                            @php
                                if($varMenu->menu->id_page){
                                    $href = route('menu-fe',$varMenu->menu->name);
                                }else{
                                    $href = $varMenu->menu->url;
                                }
                            @endphp
                            <a style="color: black" href="{{$href}}">{{$varMenu->menu->name}}</a> > {{$varMenu->name}}
                        @else
                            {{$varMenu->name}}
                        @endif
                    </h1>
                    {{-- <h2 class="subtitle is-5 light-text no-margin-bottom">
                        (dummy) Produk yang telah kami buat dan siap untuk digunakan
                    </h2> --}}
                    <br>
                    <!-- Signup form -->
                    <div class="signup-block">
                        <p class="components-cta">
                            <a href="#news" class="button button-cta btn-align light-btn btn-outlined is-bold rounded">
                                Discover {{$varMenu->name}}
                            </a>
                        </p>
                    </div>
                    <!-- /Signup form -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Blog post list section -->
    <section class="section is-medium blog-section section-light-grey" id="news">
        <div class="container">
            <h2 class="title section-title has-text-centered dark-text"> {{$varMenu->name}}</h2>
            <div class="mt-30 columns">
                <div class="column is-12">
                    <!-- Post -->
                    <div class="flex-card is-full-post has-sidebar light-bordered">
                        <!-- Post meta -->
                        <div class="post-meta content">
                            <!-- Author avatar -->
                            <!-- Title -->
                            <div class="title-block">
                                @if (session()->get('language') == 'id')
                                    <h2>{{$varMenu->page->title}}</h2>
                                @else
                                    <h2>{{$varMenu->page->title_en}}</h2>
                                @endif
                                
                                <!-- Like button -->
                            </div>
                        </div>
    
                        <!-- Post body -->
                        <div class="post-body content">    
                            <!-- Post content -->
                            @if (session()->get('language') == 'id')
                                {!! $varMenu->page->content !!}
                            @else
                                {!! $varMenu->page->content_en !!}
                            @endif
                            <!-- Share Post -->
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>
    <!-- /Blog post list section -->
@endsection

@section('js-atas')
    <script src="{{asset('assets/frontend/js/landingv2.js')}}"></script>
@endsection