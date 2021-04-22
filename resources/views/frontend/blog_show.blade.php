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
                        @if (session()->get('language') == 'id')
                            {{$blog->title}}
                        @else
                            {{$blog->title_en}}
                        @endif
                        
                    </h1>
                    {{-- <h2 class="subtitle is-5 light-text no-margin-bottom">
                        (dummy) Produk yang telah kami buat dan siap untuk digunakan
                    </h2> --}}
                    <br>
                    <!-- Signup form -->
                    {{-- <div class="signup-block">
                        <p class="components-cta">
                            <a href="#product-fe" class="button button-cta btn-align light-btn btn-outlined is-bold rounded">
                                Get Started
                            </a>
                        </p>
                    </div> --}}
                    <!-- /Signup form -->
                </div>
                <div class="column is-offset-1">
                    <!-- Hero mockup -->
                    <figure class="image is-hidden-mobile">
                        <img src="{{asset($blog->image)}}" alt="">
                    </figure>
                    <!-- /Hero mockup -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Blog post list section -->
    <section class="section blog-section section-light-grey" id="news">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <!-- Post -->
                    <div class="flex-card is-full-post has-sidebar light-bordered">
                        <!-- Post meta -->
                        <div class="post-meta content">
                            <!-- Author avatar -->
                            <img class="author-avatar is-hidden-mobile" src="{{asset($blog->image)}}">
                            <!-- Title -->
                            <div class="title-block">
                                <h2>@if (session()->get('language') == 'id')
                                    {{$blog->title}}
                                @else
                                    {{$blog->title_en}}
                                @endif</h2>
                                <!-- Like button -->
                            </div>
                        </div>
    
                        <!-- Post body -->
                        <div class="post-body content">
                            <!-- More meta -->
                            <div class="author-name">by <b>Admin</b></div>
                            @php
                                $date = date('d-m-Y', strtotime($blog->created_at));
                            @endphp
                            <div class="timestamp"><i class="sl sl-icon-clock"></i> {{$date}}</div>
                            
                            
                            <!-- Post content -->
                            @if (session()->get('language') == 'id')
                                {!! $blog->content !!}
                            @else
                                {!! $blog->content_en !!}
                            @endif
                            <!-- Share Post -->
                        </div>
                    </div>
                </div>

                <!-- Blog sidebar -->
                <div class="column">        
                    <!-- Blog categories -->
                    <div class="flex-card light-bordered">
                        <div class="card-header">Categories</div>
                        <div class="card-panel">
                            <!-- Categories -->
                            <div class="post-categories">
                                <!-- Category -->
                                @if ($categories->count() != 0)
                                    @foreach ($categories as $category)
                                        @php
                                            $kategori = \App\GlobalFunction::spaceChange(1,$category->name);
                                            $kategori = \App\GlobalFunction::spaceChange(1,$category->name);
                                            if(session()->get('language') == 'id'){
                                                $namaKategori = $blog->category->name;
                                            }else{
                                                $namaKategori = $blog->category->name_en;
                                            }
                                        @endphp
                                        <div class="post-category">
                                            <span><a href="{{route('blog_kategori', $kategori)}}">{{$namaKategori}}</a></span>
                                            <span class="b-badge badge-outlined rounded is-primary">{{$category->blog->count()}}</span>
                                        </div>
                                    @endforeach
                                @else
                                <div class="post-category">
                                    <span><a href="#">There is no category</a></span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- /Blog sidebar -->
                
            </div>
        </div>
    </section>
    <!-- /Blog post list section -->
@endsection

@section('js-atas')
    <script src="{{asset('assets/frontend/js/landingv2.js')}}"></script>
@endsection