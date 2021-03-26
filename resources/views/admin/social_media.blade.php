@extends('layouts.app')

@push('css')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Social Media</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addSocialMedia">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Social Media</span>
                </a>
                <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
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
                    @foreach ($socialMedias as $socialMedia)
                    {{-- @php
                        $description = substr($socialMedia->description, 0, 30);
                        $url = substr($socialMedia->url, 0, 35);
                    @endphp --}}
                        <tr>
                            <td onclick="show({{$socialMedia->id_social_media}},'show')">{{$socialMedia->name}}</td>
                            <td onclick="show({{$socialMedia->id_social_media}},'show')">{{$socialMedia->url}}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="show({{$socialMedia->id_social_media}},'show')"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="show({{$socialMedia->id_social_media}},'edit')"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteSocialMedia({{$socialMedia->id_social_media}})"><i class="fas fa-trash"></i></button></td>
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

<!-- Add Social Media Modal-->
<div class="modal fade" id="addSocialMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Social Media</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please insert all the form to add new social media.</p>
            <form method="post" action="{{route('social-media.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="social_media-name">Social Media Name</label>
                  <input type="text" class="form-control" id="social_media-name" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="social_media-url">Social Media URL</label>
                    <input type="text" class="form-control" id="social_media-url" name="url" value="{{old('url')}}">
                  </div>
                <div class="form-group">
                    <label for="social_media-image">social Media Image</label>
                    <input type="file" class="form-control-file" id="social_media-image" name="image">
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

<!-- Show Social Media Modal-->
<div class="modal fade" id="showSocialMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelshow">Show Social Media</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="social_media-name">Social Media Name</label>
                  <input type="text" class="form-control" id="show-social_media-name" readonly>
                </div>
                <div class="form-group">
                    <label for="social_media-url">Social Media URL</label>
                    <input type="text" class="form-control" id="show-social_media-url" name="url" readonly>
                  </div>
                <div class="form-group">
                    <label for="social_media-image">social_media Image</label>
                    <img style="max-height: 200px; max-width: 220px" src="" alt="social_media's image" id="show-social_media-image">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Social Media Modal-->
<div class="modal fade" id="editSocialMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabeledit">Edit Social Media</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Change the data that need to edit.</p>
            <form id="edit-form-social_media" method="post" action="" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="social_media-name">Social Media Name</label>
                  <input type="text" class="form-control" id="edit-social_media-name" name="name">
                </div>
                <div class="form-group">
                    <label for="social_media-url">Social Media URL</label>
                    <input type="text" class="form-control" id="edit-social_media-url" name="url">
                  </div>
                <div class="form-group">
                    <label for="social_media-image">Social Media Image</label>
                    <input type="file" class="form-control-file" id="edit-social_media-image" name="image">
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

<!-- Hapus Social Media Modal-->
<div class="modal fade" id="deleteSocialMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelhapus">Delete Social Media</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete this data?</p>
            <form id="form-delete-social_media" method="post" action="">
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
                url: "/admin/social-media/"+id+"/edit",
                method: 'get',
                success: function(result){
                    if(status == 'show'){
                        $("#show-social_media-name").val(result.socialMedia['name']);
                        $("#show-social_media-url").val(result.socialMedia['url']);
                        $("#show-social_media-image").attr("src", "/"+result.socialMedia['image']);
                        $('#showSocialMedia').modal('show');
                    }else{
                        $("#edit-social_media-name").val(result.socialMedia['name']);
                        $("#edit-social_media-url").val(result.socialMedia['url']);
                        $("#edit-form-social_media").attr("action", "/admin/social-media/"+result.socialMedia['id_social_media']);
                        $('#editSocialMedia').modal('show');
                    }                   
                    
                }
        });
    }

    function deleteSocialMedia(id){
        $("#form-delete-social_media").attr("action", "/admin/social-media/"+id);
        $('#deleteSocialMedia').modal('show');
    }
</script>

@endsection
