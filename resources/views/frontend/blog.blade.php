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
                        News
                    </h1>
                    {{-- <h2 class="subtitle is-5 light-text no-margin-bottom">
                        (dummy) Produk yang telah kami buat dan siap untuk digunakan
                    </h2> --}}
                    <br>
                    <!-- Signup form -->
                    <div class="signup-block">
                        <p class="components-cta">
                            <a href="#news" class="button button-cta btn-align light-btn btn-outlined is-bold rounded">
                                Discover News
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
            <h2 class="title section-title has-text-centered dark-text"> News</h2>
            <div class="mt-30 columns">
                <div class="column is-8">
                    @if ($blogs->count() != 0)
                        @foreach ($blogs as $blog)
                            <!-- Blog post -->
                            <div class="flex-card is-post light-bordered">
                                <!-- Post header -->
                                <div class="header has-background-image" data-background="{{asset($blog->image)}}">
                                    <div class="title-wrapper">
                                        @if (session()->get('language') == 'id')
                                            <h2 class="post-title">{{$blog->title}}</h2>
                                        @else
                                            <h2 class="post-title">{{$blog->title_en}}</h2>
                                        @endif
                                        
                                    </div>
                                    <!-- Header overlay -->
                                    <div class="header-overlay"></div>
                                </div>
                                <!-- Post body -->
                                <div class="post-body">
                                    @php
                                        $kategoriblog = \App\GlobalFunction::spaceChange(1,$blog->category->name);
                                        $judul = \App\GlobalFunction::spaceChange(1,$blog->title);
                                        $date = date('d-m-Y', strtotime($blog->created_at));
                                        if(session()->get('language') == 'id'){
                                            $namaKategori = $blog->category->name;
                                        }else{
                                            $namaKategori = $blog->category->name_en;
                                        }
                                    @endphp
                                    <div> <span>by</span> <a class="author-name" href="#"><b>Admin</b></a></div>
                                    <small>Posted in <a href="{{route('blog_kategori', $kategoriblog)}}">{{$namaKategori}}</a> on {{$date}}</small>
                                    <p>
                                        @if (session()->get('language') == 'id')
                                            {{$blog->content}}...
                                        @else
                                            {{$blog->content_en}}...
                                        @endif
                                        </p>
                                    <div class="content-footer">
                                        <div class="footer-details">
                                            <a class="button is-link btn-upper" href="{{route('blog_show', [$kategoriblog, $judul])}}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Blog post -->        
                        @endforeach
                    @else
                        <h4 class="title section-title has-text-centered dark-text"> No news yet</h4>
                    @endif
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
                                            if(session()->get('language') == 'id'){
                                                $namaKategori2 = $blog->category->name;
                                            }else{
                                                $namaKategori2 = $blog->category->name_en;
                                            }
                                        @endphp
                                        <div class="post-category">
                                            <span><a href="{{route('blog_kategori', $kategori)}}">{{$namaKategori2}}</a></span>
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