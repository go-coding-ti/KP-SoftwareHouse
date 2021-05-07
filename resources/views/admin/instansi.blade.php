@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Instansi</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Instansi yang tersedia</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addInstansi">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Instansi</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($instansis as $instansi)
                        <tr>
                            <td onclick="show({{$instansi->id_instansi}},'show')">{{$instansi->nama_instansi}}</td>
                            <td onclick="show({{$instansi->id_instansi}},'show')"><img style="max-height: 100px; max-width: 100px;" src="{{asset($instansi->image)}}" alt=""></td>
                            <td onclick="show({{$instansi->id_instansi}},'show')">{{$instansi->url}}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$instansi->id_instansi}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$instansi->id_instansi}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteInstansi({{$instansi->id_instansi}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Instansi Modal-->
<div class="modal fade" id="addInstansi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Instansi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new instansi.</p>
            <form method="post" action="{{route('instansi.insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="instansi-name">Instansi Name</label>
                  <input type="text" class="form-control" id="instansi-name" name="nama_instansi" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="instansi-image">Instansi Image</label>
                    <input type="file" class="form-control-file" id="instansi-image" name="image">
                </div>
                <div class="form-group">
                    <label for="instansi-url">Instansi URL</label>
                    <input type="text" class="form-control" id="instansi-url" name="url" value="{{old('url')}}">
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

<!-- Show Instansi Modal-->
<div class="modal fade" id="showInstansi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Instansi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="instansi-name">Instansi Name</label>
                  <input type="text" class="form-control" id="show-instansi-name" readonly>
                </div>
                <div class="form-group">
                    <label for="instansi-url">Instansi URL</label>
                    <input type="text" class="form-control" id="show-instansi-url" name="url" readonly>
                  </div>
                <div class="form-group">
                    <label for="instansi-image">Instansi Image</label>
                    <img style="height: 200px; width:224px;" src="" alt="instansi's image" id="show-instansi-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Instansi Modal-->
<div class="modal fade" id="editInstansi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Instansi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-instansi" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="instansi-name">Instansi Name</label>
                  <input type="text" class="form-control" id="edit-instansi-name" name="nama_instansi">
                </div>
                <div class="form-group">
                    <label for="instansi-url">Instansi URL</label>
                    <input type="text" class="form-control" id="edit-instansi-url" name="url">
                  </div>
                <div class="form-group">
                    <label for="instansi-image">Instansi Image</label>
                    <input type="file" class="form-control-file" id="edit-instansi-image" name="image">
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

<!-- Hapus Instansi Modal-->
<div class="modal fade" id="deleteInstansi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Instansi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-instansi" method="post" action="">
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
                url: "instansi/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        $("#show-instansi-name").val(result.instansi['nama_instansi']);
                        $("#show-instansi-url").val(result.instansi['url']);
                        $("#show-instansi-image").attr("src", "/"+result.instansi['image']);
                        $('#showInstansi').modal('show');
                    }else{
                        $("#edit-instansi-name").val(result.instansi['nama_instansi']);
                        $("#edit-instansi-url").val(result.instansi['url']);
                        $("#edit-form-instansi").attr("action", "instansi/"+result.instansi['id_instansi']);
                        $('#editInstansi').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteInstansi(id){
        $("#form-delete-instansi").attr("action", "instansi/"+id);
        $('#deleteInstansi').modal('show');
    }
</script>

@endsection
