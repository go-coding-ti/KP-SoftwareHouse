@foreach ($projects as $project)
    <div class="column">
        <div class="feature-card card-md hover-inset has-text-centered">
            <div class="brand-logo">
                <img src="{{asset($project->image)}}" alt="">
            </div>
            <div class="card-title">
                <h4>{{$project->name}}</h4>
            </div>
            <div class="card-feature-description">
                <span>{{$project->description}}</span>
            </div>
        </div>
    </div>
@endforeach
