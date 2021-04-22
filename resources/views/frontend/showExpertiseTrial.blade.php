@foreach ($trials as $trial)
<div class="column">
    <div class="feature-card card-md hover-inset has-text-centered">
        <div class="brand-logo">
            <img src="{{asset($trial->project->image)}}" alt="">
        </div>
        <div class="card-title">
            <h4>{{$trial->project->name}}</h4>
        </div>
        <div class="card-feature-description">
            <span>{{$trial->project->description}}</span>
        </div>
        <a href="{{$trial->url}}" class="button btn-align primary-btn btn-outlined is-bold rounded">Try Project</a>
    </div>
</div>
@endforeach

