@extends('layouts.app')

@push('css')
  <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <style>
    /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
  </style>
@endpush


@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Management Admin</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Admin of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addAdmin">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Admin</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Super Admin</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Super Admin</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                    @php
                        $description = substr($user->description, 0, 30);
                    @endphp
                        <tr>
                            <td onclick="show({{$user->id}},'show')">{{$user->name}}</td>
                            <td onclick="show({{$user->id}},'show')">{{$user->email}}</td>
                            <td><label class="switch">
                                <input type="checkbox" id="checkbox{{$user->id}}" onchange="change({{$user->id}})" @if ($user->type == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                              </label></td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$user->id}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$user->id}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{$user->id}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Admin Modal-->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new admin.</p>
            <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="user-name">User Name</label>
                  <input type="text" class="form-control" id="user-name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="user-email">User Email</label>
                    <input type="email" class="form-control" id="user-email" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="user-password">User Password</label>
                    <input type="password" class="form-control" id="user-password" name="password" value="{{old('password')}}">
                </div>
                <div class="form-group">
                    <label for="user-password-confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="user-password-confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
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

<!-- Show User Modal-->
<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Admin</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="show-user-name">User Name</label>
                <input type="text" class="form-control" id="show-user-name" name="name" value="" readonly>
              </div>
              <div class="form-group">
                  <label for="show-user-email">User Email</label>
                  <input type="email" class="form-control" id="show-user-email" name="email" value="" readonly>
              </div>
              <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit User Modal-->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Admin</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-user" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="edit-user-name">User Name</label>
                    <input type="text" class="form-control" id="edit-user-name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="edit-user-email">User Email</label>
                    <input type="email" class="form-control" id="edit-user-email" name="email" value="">
                </div>
                <div class="form-group">
                    <label for="edit-user-password">User Password</label>
                    <label for="edit-user-password"><small>*Fill form if want to change the password</small></label>
                    <input type="password" class="form-control" id="edit-user-password" name="password" value="">
                </div>
                <div class="form-group">
                    <label for="edit-user-password-confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="edit-user-password-confirmation" name="password_confirmation" value="">
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

<!-- Hapus User Modal-->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Admin</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-admin" method="post" action="">
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
                url: "/admin/user/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        $("#show-user-name").val(result.user['name']);
                        $("#show-user-email").val(result.user['email']);
                        $('#showUser').modal('show');
                    }else{
                        $("#edit-user-name").val(result.user['name']);
                        $("#edit-user-email").val(result.user['email']);
                        $("#edit-form-user").attr("action", "/admin/user/"+result.user['id']);
                        $('#editUser').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteUser(id){
        $("#form-delete-user").attr("action", "/admin/user/"+id);
        $('#deleteUser').modal('show');
    }

    function change(id){
        var cnf = confirm('Are you sure want this admin to be super admin?');
        if(cnf == true){
            jQuery.ajax({
                url: "/admin/user/type/"+id,
                method: 'get',
                success: function(result){
                    location.reload();
                }
            });
        }else{
            document.getElementById("checkbox"+id).checked = false;
        } 
    }
</script>

@endsection
