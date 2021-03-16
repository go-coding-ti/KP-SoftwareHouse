@extends('layouts.app-frontend')

@section('content')
{{-- Banner Awal --}}
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> News <span>Software House</span></h1>
                <p> Berbagai berita yang dapat dibaca </p>
                <a href="#">Contact Us <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="{{asset('assets/frontend/images/product.png')}}" alt=""></div>
            </div>
        </div>
    </div>
</div>

{{-- List Product --}}
<div class="container-fluid gtco-feature">
    <h2 class="text-center">News dari Software House</h2>
    
        @foreach ($blogs as $blog)
        <div class="row ml-4 mr-4 shadow p-3 mb-5 bg-white">
            <div class="col-4">
                <img style="max-height:250px" class="card-img-top" src="{{$blog->image}}" alt="">
            </div>
            <div class="col-6">
                <h2 font-weight-bold>{{$blog->title}}</h2>
                <p class="card-text">{{$blog->content}}</p>
                <a href="{{route('blog_show', ['kategori' => $blog->category->name, 'judul' => $blog->title])}}">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
        @endforeach
    
</div>
@endsection