@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Project</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    @if (session()->has('statusInput'))
      <div class="row">
        <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('statusInput')}}
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
    @endif

    @if (count($errors)>0)
      <div class="row">
        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              @foreach ($errors->all() as $item)
                  <li>{{$item}}</li>
              @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
    @endif
    
    <!-- Content Row -->
    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Project of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addProject">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Project</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($projects as $project)
                    @php
                        $description = substr($project->description, 0, 30);
                    @endphp
                        <tr>
                            <td onclick="show({{$project->id_project}},'show')">{{$project->name}}</td>
                            <td onclick="show({{$project->id_project}},'show')">{{$description}}.....</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$project->id_project}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$project->id_project}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteProject({{$project->id_project}})"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

<!-- Add Project Modal-->
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new project.</p>
            <form method="post" action="{{route('project.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="project-name">Project Name</label>
                  <input type="text" class="form-control" id="project-name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                  <label for="project-description">Project Description</label>
                  <textarea class="form-control" id="project-description" rows="3" name="description" value="{{old('description')}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="project-description">Project Description</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="project-expertise" rows="3" name="expertise[]" value="{{old('expertise')}}">
                        @foreach ($expertises as $expertise)
                            <option value="{{$expertise->id_expertise}}">{{$expertise->name}}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="project-image">Project Image</label>
                    <input type="file" class="form-control-file" id="project-image" name="image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>              
        </div>

        </div>
    </div>
</div>

<!-- Show Project Modal-->
<div class="modal fade" id="showProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Project</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="project-name">Project Name</label>
                  <input type="text" class="form-control" id="show-project-name" readonly>
                </div>
                <div class="form-group">
                  <label for="project-description">Project Description</label>
                  <textarea class="form-control" id="show-project-description" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="project-image">Project Image</label>
                    <img style="height: 200px; width:224px;" src="" alt="project's image" id="show-project-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Project Modal-->
<div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Project</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-project" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="project-name">Project Name</label>
                  <input type="text" class="form-control" id="edit-project-name" name="name">
                </div>
                <div class="form-group">
                  <label for="project-description">Project Description</label>
                  <textarea class="form-control" id="edit-project-description" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-project-description">Project Description</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="edit-project-expertise" rows="3" name="expertise[]" value="">
                        @foreach ($expertises as $expertise)
                            <option value="{{$expertise->id_expertise}}">{{$expertise->name}}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="project-image">Project Image</label>
                    <input type="file" class="form-control-file" id="edit-project-image" name="image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>              
        </div>

        </div>
    </div>
</div>

<!-- Hapus Project Modal-->
<div class="modal fade" id="deleteProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Project</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-project" method="post" action="">
               @method('delete')
                @csrf
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>              
        </div>

        </div>
    </div>
</div>


    

@endsection

@section('js')
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


<script>
    $(document).ready(function() {
        $('#project-expertise').selectpicker();
    });

    function show(id,status){
        jQuery.ajax({
                url: "project/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        var loc = result.project['image'];
                        var location = "{{asset('assets/image/project/_1.jpg')}}";
                        $("#show-project-name").val(result.project['name']);
                        $("#show-project-url").val(result.project['url']);
                        $('#show-project-description').val(result.project['description']);
                        $("#show-project-image").attr("src", "/"+result.project['image']);
                        $('#showProject').modal('show');
                    }else{
                        $("#edit-project-name").val(result.project['name']);
                        $("#edit-project-url").val(result.project['url']);
                        $('#edit-project-description').val(result.project['description']);
                        $('#edit-project-expertise').val(result.expertise);
                        console.log(result.expertise);
                        $("#edit-form-project").attr("action", "project/"+result.project['id_project']);
                        $('#editProject').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteProject(id){
        $("#form-delete-project").attr("action", "project/"+id);
        $('#deleteProject').modal('show');
    }
</script>

@endsection
