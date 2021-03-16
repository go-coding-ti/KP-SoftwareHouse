<label for="edit-project_trial-name">Project Name</label>
<select class="selectpicker form-control" multiple data-live-search="true" id="edit-project_trial-name" rows="3" name="id_project" value="">
    @foreach ($projects as $project)
        <option value="{{$project->id_project}}" @if ($project->id_project == $id_project)
            selected
        @endif>{{$project->name}}</option>
    @endforeach
</select>
