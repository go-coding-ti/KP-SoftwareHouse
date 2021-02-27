@extends('layouts.app-frontend')

@section('content')
{{-- Banner Awal --}}
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> Product <span>Software House</span></h1>
                <p> Product yang telah kami buat </p>
                <a href="#">Contact Us <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="{{asset('assets/frontend/images/product.png')}}" alt=""></div>
            </div>
        </div>
    </div>
</div>

{{-- List Product --}}
<div class="container-fluid gtco-feature">
    <h2 class="text-center">Prouct Hasil Software House</h2>
    <div class="row ml-4 mr-4">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div style="border-radius: 5%"  class="card shadow p-3 mb-5 bg-white" style="border"><img style="max-height:250px" class="card-img-top" src="{{$product->image}}" alt="">
                    <div class="card-body rounded-100">
                        <h5 font-weight-bold>{{$product->title}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                        <a href="{{$product->url}}">Discover Product <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="container">
        <h2>Prouct Hasil Software House</h2>
            @foreach ($products as $product)
                <div class="col-sm-4">
                    <div class="card text-center"><img class="card-img-top" src="{{$product->image}}" alt="">
                        <div class="card-body text-center pr-0 pl-0">
                            <h5>{{$product->title}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <a href="{{$product->url}}">Discover Product <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
    </div> --}}
</div>
@endsection