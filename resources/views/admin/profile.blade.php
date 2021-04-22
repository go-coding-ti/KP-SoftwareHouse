@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
    img{
        max-height: 200px;
        max-width: 220px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profile Admin</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body col-8">
            <form id="form-product" method="post" action="{{route('manuser.profile.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="user-name">User Name</label>
                    <input type="text" class="form-control" id="user-name" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="user-email">User Email</label>
                    <input type="email" class="form-control" id="user-email" name="email" value="{{$user->email}}">
                </div>
                <div class="form-group" id="img-banner">
                    <img style="max-height: 200px; max-width: 210px" src="{{asset($user->image)}}" alt="logo image" id="first-img-banner">
                </div>
                <div class="form-group">
                    <label for="user-image">User Image</label>
                    <input type="file" class="form-control-file" id="user-image" name="image">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>  
            <button class="btn btn-warning" id="btnChangePassword" data-toggle="modal" data-target="#changePassword">Change Password</button>               
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Change Password Modal-->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Paassword</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
          <p>Please insert all the form to add change the password.</p>
          <form method="post" action="{{route('manuser.profile.changePass')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation" value="{{old('password_confirmation')}}">
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

@endsection

@section('js')
<script>
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#banner-image').on('change', function() {
        $('#first-img-banner').hide();
        imagesPreview(this, '#img-banner');
    });
</script>
@endsection
