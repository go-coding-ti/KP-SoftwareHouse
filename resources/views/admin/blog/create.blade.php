@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Blog - Create</h1>
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
      <div class="col-xl-12 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Create New Articel</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form id="form-product" method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="blog_category_name">Category</label>
                    <select class="selectpicker form-control" data-live-search="true" id="blog_category_name" rows="3" name="id_blog_category" value="{{old('id_blog_category')}}">
                      <option value="">Select News Category</option>
                        @foreach ($blogCategories as $blogCategory)
                            <option value="{{$blogCategory->id_blog_category}}">{{$blogCategory->name}}</option>
                        @endforeach
                    </select>  
                </div>
                <div class="form-group">
                    <label for="image">Thumbnail</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="description">Content</label>
                    <textarea id="content" class="summernote" name="content"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>                 
          </div>
        </div>
      </div>
    </div>
</div>

{{-- Add Category Modal --}}
<div class="modal fade" id="addBlogCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New BlogCategory</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
          <p>Please insert all the form to add new blog category.</p>
              <div class="form-group">
                <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                <label for="blog_category-name">Category Name</label>
                <input type="text" class="form-control" id="blogCategoryName" name="name" value="{{old('name')}}">
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" id="submitBlogCategory">Submit</button>
              </div>             
      </div>

      </div>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(e){
        var status;
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            maximumImageFileSize: 2097152
        });

        $('#blog_category-name').selectpicker();

        jQuery('#submitBlogCategory').click(function(e){
            jQuery.ajax({
                url: "{{url('admin/kategori')}}",
                type: "POST",
                data: {
                    _token: $('#signup-token').val(),
                    name: jQuery('#blogCategoryName').val(),
                },
                success: function(result){
                    $('.ganti').html(result.view);
                    $('#blog_category_name').selectpicker('refresh');
                    $('#addBlogCategory').modal('hide');
                    console.log(result.view);
                }
            });
        });
    });
</script>
@endsection
