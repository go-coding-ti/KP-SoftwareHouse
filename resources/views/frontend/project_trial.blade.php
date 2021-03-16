@extends('layouts.app-frontend')

@section('content')
{{-- Banner Awal --}}
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> Project Demo <span>Software House</span></h1>
                <p> Project yang dapat dicoba untuk melihat proses dari project </p>
                <a href="#">Contact Us <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="{{asset('assets/frontend/images/product.png')}}" alt=""></div>
            </div>
        </div>
    </div>
</div>

{{-- List Project --}}
<div class="container-fluid">
    <h2 class="text-center">Project Trial Hasil Software House</h2>
    <div class="row d-flex justify-content-center mt-5">
        <div class="list-group flex-sm-row" id="list-tab" role="tablist">
            <button onclick="filter(0)" class="list-group-item list-group-item-action active" id="buttonall" data-toggle="list" role="tab" aria-controls="home">All Expertise</button>
            @foreach ($expertises as $expertise)
                <button  class="list-group-item list-group-item-action" id="button{{$expertise->id_expertise}}" data-toggle="list" role="tab" aria-controls="home" onclick="filter({{$expertise->id_expertise}})">{{$expertise->name}}</button>
            @endforeach
        </div>
    </div>
    <div class="row ml-4 mr-4 mt-5 ganti">
        @foreach ($trials as $trial)
            <div class="col-sm-4">
                <div style="border-radius: 5%"  class="card shadow p-3 mb-5 bg-white" style="border"><img style="max-height:250px" class="card-img-top" src="{{$trial->project->image}}" alt="">
                    <div class="card-body rounded-100">
                        <h5 font-weight-bold>{{$trial->project->name}}</h5>
                        <p>Instansi - {{$trial->project->instansi}}</p>
                        <p class="card-text">{{$trial->project->description}}</p>
                        <a href="{{$trial->url}}">Try Project <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script>
    function filter(id_expertise){
        jQuery.ajax({
                url: "/filter/"+id_expertise,
                method: 'get',
                success: function(result){
                    $('.ganti').html(result.view);
                }                             
            });
    }
    
</script>

@endsection