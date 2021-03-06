@foreach ($projects as $project)
            <div class="col-sm-4">
                <div style="border-radius: 5%"  class="card shadow p-3 mb-5 bg-white" style="border"><img style="max-height:250px" class="card-img-top" src="{{$project->image}}" alt="">
                    <div class="card-body rounded-100">
                        <h5 font-weight-bold>{{$project->name}}</h5>
                        <p>Instansi - {{$project->instansi}}</p>
                        <p class="card-text">{{$project->description}}</p>
                    </div>
                </div>
            </div>
@endforeach