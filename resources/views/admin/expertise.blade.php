@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Expertise</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Expertise of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addExpertise">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Expertise</span>
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
                    @foreach ($expertises as $expertise)
                    @php
                        $description = substr($expertise->description, 0, 30);
                    @endphp
                        <tr>
                            <td onclick="show({{$expertise->id_expertise}},'show')">{{$expertise->name}}</td>
                            <td onclick="show({{$expertise->id_expertise}},'show')">{{$description}}.....</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$expertise->id_expertise}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$expertise->id_expertise}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteExpertise({{$expertise->id_expertise}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Expertise Modal-->
<div class="modal fade" id="addExpertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Expertise</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new expertise.</p>
            <form method="post" action="{{route('expertise.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="expertise-name">Expertise Name</label>
                  <input type="text" class="form-control" id="expertise-name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                  <label for="expertise-description">Expertise Description</label>
                  <textarea class="form-control" id="expertise-description" rows="3" name="description" value="{{old('description')}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="expertise-image">Expertise Image</label>
                    <input type="file" class="form-control-file" id="expertise-image" name="image">
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

<!-- Show Expertise Modal-->
<div class="modal fade" id="showExpertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Expertise</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="expertise-name">Expertise Name</label>
                  <input type="text" class="form-control" id="show-expertise-name" readonly>
                </div>
                <div class="form-group">
                  <label for="expertise-description">Expertise Description</label>
                  <textarea class="form-control" id="show-expertise-description" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="expertise-image">Expertise Image</label>
                    <img style="height: 200px; width:224px;" src="" alt="expertise's image" id="show-expertise-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Expertise Modal-->
<div class="modal fade" id="editExpertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Expertise</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-expertise" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="expertise-name">Expertise Name</label>
                  <input type="text" class="form-control" id="edit-expertise-name" name="name">
                </div>
                <div class="form-group">
                  <label for="expertise-description">Expertise Description</label>
                  <textarea class="form-control" id="edit-expertise-description" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="expertise-image">Expertise Image</label>
                    <input type="file" class="form-control-file" id="edit-expertise-image" name="image">
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

<!-- Hapus Expertise Modal-->
<div class="modal fade" id="deleteExpertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Expertise</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-expertise" method="post" action="">
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
                url: "expertise/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        var loc = result.expertise['image'];
                        var location = "{{asset('assets/image/expertise/_1.jpg')}}";
                        $("#show-expertise-name").val(result.expertise['name']);
                        $("#show-expertise-url").val(result.expertise['url']);
                        $('#show-expertise-description').val(result.expertise['description']);
                        $("#show-expertise-image").attr("src", "/"+result.expertise['image']);
                        $('#showExpertise').modal('show');
                    }else{
                        $("#edit-expertise-name").val(result.expertise['name']);
                        $("#edit-expertise-url").val(result.expertise['url']);
                        $('#edit-expertise-description').val(result.expertise['description']);
                        $("#edit-form-expertise").attr("action", "expertise/"+result.expertise['id_expertise']);
                        $('#editExpertise').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteExpertise(id){
        $("#form-delete-expertise").attr("action", "expertise/"+id);
        $('#deleteExpertise').modal('show');
    }
</script>

@endsection
