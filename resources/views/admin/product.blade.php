@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product</h1>
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
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
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
                  <label for="product-name">Procut Name</label>
                  <input type="text" class="form-control" id="product-name" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="product-url">Procut URL</label>
                    <input type="text" class="form-control" id="product-url" name="url" value="{{old('url')}}">
                  </div>
                <div class="form-group">
                  <label for="product-description">Product Description</label>
                  <textarea class="form-control" id="product-description" rows="3" name="description" value="{{old('description')}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <input type="file" class="form-control-file" id="product-image" name="image">
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
                  <label for="product-name">Procut Name</label>
                  <input type="text" class="form-control" id="show-product-name" readonly>
                </div>
                <div class="form-group">
                    <label for="product-url">Procut URL</label>
                    <input type="text" class="form-control" id="show-product-url" name="url" readonly>
                  </div>
                <div class="form-group">
                  <label for="product-description">Product Description</label>
                  <textarea class="form-control" id="show-product-description" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <img src="" alt="product's image" id="show-product-image">
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
                  <label for="product-name">Procut Name</label>
                  <input type="text" class="form-control" id="edit-product-name" name="title">
                </div>
                <div class="form-group">
                    <label for="product-url">Procut URL</label>
                    <input type="text" class="form-control" id="edit-product-url" name="url">
                  </div>
                <div class="form-group">
                  <label for="product-description">Product Description</label>
                  <textarea class="form-control" id="edit-product-description" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image</label>
                    <input type="file" class="form-control-file" id="edit-product-image" name="image">
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

<script>
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
                        $("#show-product-image").attr("src", "/"+result.product['image']);
                        $('#showProduct').modal('show');
                    }else{
                        $("#edit-product-name").val(result.product['title']);
                        $("#edit-product-url").val(result.product['url']);
                        $('#edit-product-description').val(result.product['description']);
                        $("#edit-form-product").attr("action", "product/"+result.product['id_product']);
                        $('#editProduct').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteProduct(id){
        $("#form-delete-product").attr("action", "product/"+id);
        $('#deleteProduct').modal('show');
    }
</script>

@endsection
