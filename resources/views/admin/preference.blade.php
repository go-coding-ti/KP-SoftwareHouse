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
      <h1 class="h3 mb-0 text-gray-800">Preference</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Preference</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body col-8">
            <form id="form-product" method="post" action="{{route('preference.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="web-name">Website Name</label>
                    <input type="text" class="form-control" id="web-name" name="web_name" value="{{$preference->web_name}}">
                </div>
                <div class="form-group" id="img-logo">
                    <img src="{{asset($preference->logo_img)}}" alt="logo image" id="first-img-logo">
                </div>
                <div class="form-group">
                    <label for="logo-image">Logo</label>
                    <input type="file" class="form-control-file" id="logo-image" name="logo_image">
                </div>
                <div class="form-group">
                    <label for="banner-content-ina">Banner Content *ina</label>
                    <textarea id="banner-content-ina" class="summernote" name="banner_content_ina">{!! $preference->banner_content_ina !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="banner-content-eng">Banner Content *eng</label>
                    <textarea id="banner-content-eng" class="summernote" name="banner_content_eng">{!! $preference->banner_content_eng !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="address-ina">Address Content *ina</label>
                    <textarea id="address-ina" class="summernote" name="address_ina">{!! $preference->address_ina !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="address-eng">Address Content *eng</label>
                    <textarea id="address-eng" class="summernote" name="address_eng">{!! $preference->address_eng !!}</textarea>
                </div>
                <div class="form-group" id="img-banner">
                    <img src="{{asset($preference->banner_img)}}" alt="logo image" id="first-img-banner">
                </div>
                <div class="form-group">
                    <label for="banner-image">Banner Image</label>
                    <input type="file" class="form-control-file" id="banner-image" name="banner_image">
                </div>
                <div class="form-group">
                    <label for="link_video">Link Video</label>
                    <input type="text" class="form-control" id="link_video" name="link_video" value="{{$preference->link_video}}">
                </div>
                <div class="form-group">
                    <label for="video_description_in">Video Description *ina</label>
                    <textarea type="text" class="form-control" id="video_description_in" name="video_description_in" rows="5">{{$preference->video_description_in}}</textarea>
                </div>
                <div class="form-group">
                    <label for="video_description_en">Video Description *eng</label>
                    <textarea type="text" class="form-control" id="video_description_en" name="video_description_en" rows="5">{{$preference->video_description_en}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>  
            <button class="btn btn-danger" id="btnReset">Reset</button>               
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
    });

    // var loadFile = function(event,name) {
    //         var output = document.getElementById(name);
    //         output.src = URL.createObjectURL(event.target.files[0]);
    //         output.onload = function() {
    //         URL.revokeObjectURL(output.src) // free memory
    //     }
    // };
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

    $('#logo-image').on('change', function() {
        $('#first-img-logo').hide();
        imagesPreview(this, '#img-logo');     
    });
    $('#banner-image').on('change', function() {
        $('#first-img-banner').hide();
        imagesPreview(this, '#img-banner');
    });

    $('#btnReset').on('click', function(){
        $('#web-name').val(' ');
        $('#banner-content-ina').val(' ');
        $('#banner-content-eng').val(' ');
        $('#address-ina').val(' ');
        $('#address-eng').val(' ');
    });
</script>
@endsection
