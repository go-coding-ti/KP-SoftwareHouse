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
