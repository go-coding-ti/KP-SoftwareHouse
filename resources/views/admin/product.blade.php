@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
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
      <h1 class="h3 mb-0 text-gray-800">Product</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Produk yang Dimiliki</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addProduct">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Product</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Internal Page</th>
                    <th>Show at Home</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Internal Page</th>
                    <th>Show at Home</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($products as $product)
                    @php
                        $description = substr($product->description, 0, 30);
                        $url = substr($product->url, 0, 35);
                    @endphp
                        <tr>
                            <td onclick="show({{$product->id_product}},'show')">{{$product->title}}</td>
                            <td onclick="show({{$product->id_product}},'show')">{{$description}}.....</td>
                            <td onclick="show({{$product->id_product}},'show')">{{$url}}@if (strlen($product->ulr) > 35)
                                ......
                            @endif</td>
                            <td onclick="show({{$product->id_product}},'show')">@if ($product->id_page)
                                {{$product->page->title}} 
                            @endif</td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" id="checkbox{{$product->id_product}}" onchange="change({{$product->id_product}})" @if ($product->status_home == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                              </label>
                            </td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$product->id_product}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$product->id_product}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteProduct({{$product->id_product}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Product Modal-->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new product.</p>
            <form method="post" action="{{route('product.insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="product-name">Product Name</label>
                  <input type="text" class="form-control" id="product-name" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group internal-page">
                    <label for="show-internal-page">Internal Page</label>
                    <input type="text" class="form-control" id="show-internal-page" name="url" value="">
                </div>
                <div class="form-group external-url">
                    <label for="show-external-url">External URL</label>
                    <input type="text" class="form-control" id="show-external-url" name="url" value="">
                </div>
                <div class="form-group">
                  <label for="product-description">Product Description *ina</label>
                  <textarea class="form-control" id="product-description" rows="3" name="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                  <label for="product-description-eng">Product Description *eng</label>
                  <textarea class="form-control" id="product-description-eng" rows="3" name="description_en">{{old('description_eng')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <input type="file" class="form-control-file" id="product-image" name="image">
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
                <div class="form-group">
                    <label for="project-description">Instansi That Use the Product</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="product-instansi" rows="3" name="instansi[]" value="{{old('instansi')}}">
                      <option value="">Select Instansi</option>
                        @foreach ($instansis as $instansi)
                            <option value="{{$instansi->id_instansi}}">{{$instansi->nama_instansi}}</option>
                        @endforeach
                    </select>
                    <label for="new instansi"><a href="{{route('instansi')}}">Manage Instansi</a></label>
                </div>
                <div class="form-group">
                  <label for="check-home">Show at Home Page</label>  
                  <label class="switch">
                      <input type="checkbox" name="status_home">
                      <span class="slider round"></span>
                  </label>                
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

<!-- Show Product Modal-->
<div class="modal fade" id="showProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="product-name">Product Name</label>
                  <input type="text" class="form-control" id="show-product-name" readonly>
                </div>
                <div class="form-group">
                    <label for="show-internal-page">Internal Page</label>
                    <input type="text" class="form-control" id="show-internal-page" name="url" value="">
                </div>
                <div class="form-group">
                    <label for="show-external-url">External URL</label>
                    <input type="text" class="form-control" id="show-external-url" name="url" value="">
                </div>
                <div class="form-group">
                  <label for="product-description">Product Description *ina</label>
                  <textarea class="form-control" id="show-product-description" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="product-description_eng">Product Description *eng</label>
                  <textarea class="form-control" id="show-product-description_eng" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="project-description">Instansi That Use the Product</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="show-product-instansi" rows="3" name="instansi[]" value="">
                      <option value="">Select Instansi</option>
                        @foreach ($instansis as $instansi)
                            <option value="{{$instansi->id_instansi}}">{{$instansi->nama_instansi}}</option>
                        @endforeach
                    </select>
                    <label for="new instansi"><a href="{{route('instansi')}}">Manage Instansi</a></label>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <img style="height: 200px; width:224px;" src="" alt="product's image" id="show-product-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Product Modal-->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-product" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="product-name">Product Name</label>
                  <input type="text" class="form-control" id="edit-product-name" name="title">
                </div>
                <div class="form-group">
                  <label for="product-description">Product Description *ina</label>
                  <textarea class="form-control" id="edit-product-description" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="product-description_eng">Product Description *eng</label>
                  <textarea class="form-control" id="edit-product-description_eng" rows="3" name="description_en"></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <input type="file" class="form-control-file" id="edit-product-image" name="image">
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
                <div class="form-group">
                    <label for="project-description">Instansi That Use the Product</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="edit-product-instansi" rows="3" name="instansi[]" value="">
                      <option value="">Select Instansi</option>
                        @foreach ($instansis as $instansi)
                            <option value="{{$instansi->id_instansi}}">{{$instansi->nama_instansi}}</option>
                        @endforeach
                    </select>
                    <label for="new instansi"><a href="{{route('instansi')}}">Manage Instansi</a></label>
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

<!-- Hapus Product Modal-->
<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-product" method="post" action="">
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
                url: "product/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        var loc = result.product['image'];
                        var location = "{{asset('assets/image/product/_1.jpg')}}";
                        $("#show-product-name").val(result.product['title']);
                        $("#show-product-url").val(result.product['url']);
                        $('#show-product-description').val(result.product['description']);
                        $('#show-product-description_eng').val(result.product['description_en']);
                        if(result.product['id_page']){
                          $("#show-internal-page").val(result.product['page']['title']);
                        }
                        $("#show-product-image").attr("src", "/"+result.product['image']);
                        $('#show-external-url').val(result.product['url']);
                        $('#show-product-instansi').val(result['instansi']);
                        $('#showProduct').modal('show');
                    }else{
                        $("#edit-product-name").val(result.product['title']);
                        $("#edit-product-url").val(result.product['url']);
                        $('#edit-product-description').val(result.product['description']);
                        $('#edit-product-description_eng').val(result.product['description_en']);
                        $("#edit-internal-page").val(result.product['id_page']);
                        $('#edit-external-url').val(result.product['url']);
                        $('#edit-product-instansi').val(result['instansi']);
                        $("#edit-form-product").attr("action", "product/"+result.product['id_product']);
                        $('#editProduct').modal('show');
                        console.log(result.instansi)
                    }                   
                    
                }
        });
    }

    function deleteProduct(id){
        $("#form-delete-product").attr("action", "product/"+id);
        $('#deleteProduct').modal('show');
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

    function change(id){
      var cnf = confirm('Are you sure want to change status at home page?');
        if(cnf == true){
            jQuery.ajax({
                url: "/admin/product/status-home/"+id,
                method: 'get',
                success: function(result){
                    alert(result['success']);
                    console.log(result['product']);
                }
            });
        }else{
            if(document.getElementById("checkbox"+id).checked == false){
              document.getElementById("checkbox"+id).checked = true;
            }else{
              document.getElementById("checkbox"+id).checked = false;
            }  
        }
    }

</script>

@endsection
