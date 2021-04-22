@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Project Trial</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Project Trial of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addProjectTrial">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Project Trial</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name Project</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($projectTrials as $projectTrial)

                        <tr>
                            <td onclick="show({{$projectTrial->id_project_trial}},'show')">{{$projectTrial->project->name}}</td>
                            <td onclick="show({{$projectTrial->id_project_trial}},'show')">{{$projectTrial->url}}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$projectTrial->id_project_trial}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$projectTrial->id_project_trial}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteProjectTrial({{$projectTrial->id_project_trial}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Project Trial Modal-->
<div class="modal fade" id="addProjectTrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Project Trial</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new project trial.</p>
            <form method="post" action="{{route('project_trial.store')}}" enctype="multipart/form-data">
                @csrf             
                <div class="form-group">
                    <label for="project_trial-name">Project Name</label>
                    <select class="selectpicker form-control" data-live-search="true" id="project_trial-name" rows="3" name="id_project" value="id_project">
                        @foreach ($projects as $project)
                            <option value="{{$project->id_project}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="project_trial-url">Project URL</label>
                    <input type="text" class="form-control" id="project_trial-url" name="url" value="{{old('url')}}">
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

<!-- Show Project Trial Modal-->
<div class="modal fade" id="showProjectTrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Project Trial</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="show-project_trial-name">Project Trial Name</label>
                  <input type="text" class="form-control" id="show-project_trial-name" readonly>
                </div>
                <div class="form-group">
                  <label for="show-project_trial-url">Project Trial URL</label>
                  <input type="text" class="form-control" id="show-project_trial-url" readonly>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Project Trial Modal-->
<div class="modal fade" id="editProjectTrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Project Trial</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-project" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group ganti">
                    
                </div>
                <div class="form-group">
                    <label for="project_trial-url">Project URL</label>
                    <input type="text" class="form-control" id="edit-project_trial-url" name="url">
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

<!-- Hapus Project Trial Modal-->
<div class="modal fade" id="deleteProjectTrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Project Trial</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-project_trial" method="post" action="">
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
        $('#project_trial-name').selectpicker();
    });

    function show(id,status){
        jQuery.ajax({
                url: "/admin/project/trial/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        $("#show-project_trial-name").val(result.project_trial['project']['name']);
                        $("#show-project_trial-url").val(result.project_trial['url']);
                        $('#showProjectTrial').modal('show');
                    }else{
                        $("#edit-project_trial-name").val(result.project_trial['project']['name']);
                        $("#edit-project_trial-url").val(result.project_trial['url']);
                        $("#edit-form-project").attr("action", "/admin/project/trial/"+result.project_trial['id_project_trial']);
                        $('#editProjectTrial').modal('show');
                        $('.ganti').html(result.dummy);
                        $('#edit-project_trial-name').selectpicker('refresh');
                        console.log(result.dummy);
                    }                   
                    
                }
        });
    }

    function deleteProjectTrial(id){
        $("#form-delete-project_trial").attr("action", "/admin/project/trial/"+id);
        $('#deleteProjectTrial').modal('show');
    }
</script>

@endsection
