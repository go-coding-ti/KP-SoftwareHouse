@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Sub Menu</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Additional Sub Menu of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addSubMenu">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Sub Menu</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Menu</th>
                    <th>Page</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Menu</th>
                    <th>Page</th>
                    <th>URL</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($submenus as $submenu)
                        <tr>
                            <td onclick="show({{$submenu->id_submenu}},'show')">{{$submenu->name}}</td>
                            <td onclick="show({{$submenu->id_submenu}},'show')">@if ($submenu->menu)
                                {{$submenu->menu->name}} 
                            @endif</td>
                            <td onclick="show({{$submenu->id_submenu}},'show')">@if ($submenu->id_page)
                                {{$submenu->page->title}} 
                            @endif</td>
                            <td onclick="show({{$submenu->id_submenu}},'show')">{{$submenu->url}}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$submenu->id_submenu}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$submenu->id_submenu}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteSubMenu({{$submenu->id_submenu}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add SubMenu Modal-->
<div class="modal fade" id="addSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Sub Menu</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new sub sub</p>
            <form method="post" action="{{route('submenu.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="menu-name">Sub Menu Name</label>
                  <input type="text" class="form-control" id="menu-name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="select-menu">Menu</label>
                    <select class="selectpicker form-control" data-live-search="true" id="select-menu" rows="3" name="id_menu" value="{{old('id_menu')}}">
                        @foreach ($menus as $menu)
                            <option value="{{$menu->id_menu}}">{{$menu->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type-url">Type Page</label>
                    <select class="selectpicker form-control" data-live-search="true" id="type-url" rows="3" name="type_page" value="{{old('type_page')}}">
                        <option value="">Select Type Page</option>
                        <option value="1">Internal Page</option>
                        <option value="2">External URL</option>
                    </select>
                </div>
                <div class="form-group internal-page">
                    <label for="internal-page">Internal Page</label>
                    <select class="selectpicker form-control" data-live-search="true" id="internal-page" rows="3" name="id_page" value="{{old('id_page')}}">
                        @foreach ($pages as $page)
                            <option value="{{$page->id_page}}">{{$page->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group external-url">
                    <label for="external-url">External URL</label>
                    <input type="text" class="form-control" id="external-url" name="url" value="{{old('url')}}">
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

<!-- Show Sub Menu Modal-->
<div class="modal fade" id="showSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Sub Menu</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="show-submenu-name">Sub Menu Name</label>
                <input type="text" class="form-control" id="show-submenu-name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="show-select-menu">Menu</label>
                    <input type="text" class="form-control" id="show-select-menu" name="id_menu" value="">
                </div>
                <div class="form-group internal-page">
                    <label for="show-internal-page">Internal Page</label>
                    <input type="text" class="form-control" id="show-internal-page" name="id_page" value="">
                </div>
                <div class="form-group external-url">
                    <label for="show-external-url">External URL</label>
                    <input type="text" class="form-control" id="show-external-url" name="url" value="">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Sub Menu Modal-->
<div class="modal fade" id="editSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Sub Menu</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-submenu" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="edit-submenu-name">Sub Menu Name</label>
                    <input type="text" class="form-control" id="edit-submenu-name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="edit-select-menu">Menu</label>
                    <select class="selectpicker form-control" data-live-search="true" id="edit-select-menu" rows="3" name="id_menu" value="">
                        @foreach ($menus as $menu)
                            <option value="{{$menu->id_menu}}">{{$menu->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-type-url">Type Page</label>
                    <select class="selectpicker form-control" data-live-search="true" id="edit-type-url" rows="3" name="type_page" value="">
                        <option value="">Select Type Page</option>
                        <option value="1">Internal Page</option>
                        <option value="2">External URL</option>
                    </select>
                </div>
                <div class="form-group edit-internal-page">
                    <label for="edit-internal-page">Internal Page</label>
                    <select class="selectpicker form-control" data-live-search="true" id="edit-internal-page" rows="3" name="id_page" value="">
                        @foreach ($pages as $page)
                            <option value="{{$page->id_page}}">{{$page->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group edit-external-url">
                    <label for="edit-external-url">External URL</label>
                    <input type="text" class="form-control" id="edit-external-url" name="url" value="">
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

<!-- Hapus SubMenu Modal-->
<div class="modal fade" id="deleteSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Sub Menu</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-submenu" method="post" action="">
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
    $( document ).ready(function(){
        $('.external-url').hide();
        $('.internal-page').hide();
        $('.edit-external-url').hide();
        $('.edit-internal-page').hide();
    });

    function show(id,status){
        jQuery.ajax({
                url: "submenu/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        $("#show-submenu-name").val(result.submenu['name']);
                        $("#show-select-menu").val(result.submenu['menu']['name'])
                        $("#show-internal-page").val(result.submenu['page']['title']);
                        $('#show-external-url').val(result.submenu['utl']);
                        $('#showSubMenu').modal('show');
                    }else{
                        $("#edit-submenu-name").val(result.submenu['name']);
                        $("#edit-select-menu").val(result.submenu['id_menu']);
                        $("#edit-internal-page").val(result.submenu['id_page']);
                        $('#edit-external-url').val(result.submenu['url']);
                        $("#edit-form-submenu").attr("action", "submenu/"+result.submenu['id_submenu']);
                        $('#editSubMenu').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteSubMenu(id){
        $("#form-delete-submenu").attr("action", "submenu/"+id);
        $('#deleteSubMenu').modal('show');
    }

    $('#type-url').change(function(){
        if($('#type-url').val() == 1){
            $('.external-url').hide();
            $('.internal-page').show();
        }else if($('#type-url').val() == 2){
            $('.internal-page').hide();
            $('.external-url').show();
        }else{
            $('.internal-page').hide();
            $('.external-url').hide();
        }
    });

    $('#edit-type-url').change(function(){
        if($('#edit-type-url').val() == 1){
            $('.edit-external-url').hide();
            $('.edit-internal-page').show();
        }else if($('#edit-type-url').val() == 2){
            $('.edit-internal-page').hide();
            $('.edit-external-url').show();
        }else{
            $('.edit-internal-page').hide();
            $('.edit-external-url').hide();
        }
    });
</script>

@endsection
