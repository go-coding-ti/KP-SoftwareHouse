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
      <h1 class="h3 mb-0 text-gray-800">News</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">News of the Software House</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('blog.create')}}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add News</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($blogs as $blog)
                    @php
                        $description = substr($blog->content, 0, 30);
                    @endphp
                        <tr>
                            <td>{{$blog->title}}</td>
                            <td>@if (!$blog->category)
                                NULL
                            @else
                            {{$blog->category->name}}
                            @endif</td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" onchange="change({{$blog->id_blog}})" @if ($blog->status == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                              </label>
                            </td>
                            <td><a href="{{route('blog.show',$blog->id_blog)}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></a>
                                <a href="{{route('blog.edit',$blog->id_blog)}}"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></button></a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteBlog({{$blog->id_blog}})"><i class="fas fa-trash"></i></button></td>
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


<!-- Hapus Blog Modal-->
<div class="modal fade" id="deleteBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete News</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-blog" method="post" action="">
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
  function change(id){
    jQuery.ajax({
                url: "/admin/news/status/"+id,
                method: 'get',
                success: function(result){
                  console.log(result.success);  
                }
        });
  }

  function deleteBlog(id){
      $("#form-delete-blog").attr("action", "/admin/blog/"+id);
      $('#deleteBlog').modal('show');
  }
</script>

@endsection
