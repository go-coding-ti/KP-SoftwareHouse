@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Team</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Team yang tersedia</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addTeam">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Team</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Image</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Image</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td onclick="show({{$team->id_team}},'show')">{{$team->name}}</td>
                            <td onclick="show({{$team->id_team}},'show')"><img style="max-height: 100px; max-width: 100px;" src="{{asset($team->image)}}" alt=""></td>
                            <td onclick="show({{$team->id_team}},'show')">{{$team->department}}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$team->id_team}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$team->id_team}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteTeam({{$team->id_team}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Team Modal-->
<div class="modal fade" id="addTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Team</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new team.</p>
            <form method="post" action="{{route('team.insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="team-name">Team Name</label>
                  <input type="text" class="form-control" id="team-name" name="name" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="team-department">team Department</label>
                    <input type="text" class="form-control" id="team-department" name="department" value="{{old('department')}}">
                </div>
                <div class="form-group">
                    <label for="team-image">Team Image (recomendation image size 370x450)</label>
                    <input type="file" class="form-control-file" id="team-image" name="image">
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

<!-- Show Team Modal-->
<div class="modal fade" id="showTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Team</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="team-name">Team Name</label>
                  <input type="text" class="form-control" id="show-team-name" readonly>
                </div>
                <div class="form-group">
                    <label for="team-department">Team Department</label>
                    <input type="text" class="form-control" id="show-team-department" name="department" readonly>
                  </div>
                <div class="form-group">
                    <label for="team-image">Team Image</label>
                    <img style="height: 200px; width:224px;" src="" alt="team's image" id="show-team-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Team Modal-->
<div class="modal fade" id="editTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Team</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-team" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="team-name">Team Name</label>
                  <input type="text" class="form-control" id="edit-team-name" name="name">
                </div>
                <div class="form-group">
                    <label for="team-department">Team department</label>
                    <input type="text" class="form-control" id="edit-team-department" name="department">
                  </div>
                <div class="form-group">
                    <label for="team-image">Team Image</label>
                    <input type="file" class="form-control-file" id="edit-team-image" name="image">
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

<!-- Hapus Team Modal-->
<div class="modal fade" id="deleteTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Team</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-team" method="post" action="">
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

<script>
    function show(id,status){
        jQuery.ajax({
                url: "team/"+id+"/edit",
                method: 'get',
                success: function(result){
                    console.log(result.id);
                    if(status == 'show'){
                        $("#show-team-name").val(result.team['name']);
                        $("#show-team-department").val(result.team['department']);
                        $("#show-team-image").attr("src", "/"+result.team['image']);
                        $('#showTeam').modal('show');
                    }else{
                        $("#edit-team-name").val(result.team['name']);
                        $("#edit-team-department").val(result.team['department']);
                        $("#edit-form-team").attr("action", "team/"+result.team['id_team']);
                        $('#editTeam').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteTeam(id){
        $("#form-delete-team").attr("action", "team/"+id);
        $('#deleteTeam').modal('show');
    }
</script>

@endsection
