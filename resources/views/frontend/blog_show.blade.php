@extends('layouts.app-frontend')

@section('content')
{{-- Banner Awal --}}
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> {{$blog->title}}</h1>
            </div>
            <div class="col-md-6">
                <div class="card"></div>
            </div>
        </div>
    </div>
</div>

{{-- List Product --}}
<div class="container-fluid gtco-feature">
    <h2 class="text-center">{{$blog->title}}</h2>
            <p class="text-center"><small>Category: {{$blog->category->name}}</small></p>  
        <div class="row ml-4 mr-4 shadow p-3 mb-5 bg-white">      
            <div class="col-4 p-3 mb-5">
                <img  class="card-img-top" src="{{asset($blog->image)}}" alt="">
            </div>
            <div class="col-12">
                <p class="card-text">{!!$blog->content!!}</p>
            </div>
        </div>

</div>
@endsection