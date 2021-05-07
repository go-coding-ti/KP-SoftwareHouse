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
      <h1 class="h3 mb-0 text-gray-800">About Us</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">About Us</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body col-8">
            <form id="form-product" method="post" action="{{route('about-us.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="profile-company-content-ina">Profile Company Content *ina</label>
                    <textarea id="profile-company-content-ina" class="summernote" name="description_ina">{!! $aboutUs->description_ina !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="profile-company-content-eng">Profile Company Content *eng</label>
                    <textarea id="profile-company-content-eng" class="summernote" name="description_eng">{!! $aboutUs->description_eng !!}</textarea>
                </div>
                <object data="data/test.pdf" type="application/pdf" width="300" height="200">
                    <a href="{{asset($aboutUs->file_profile_company)}}"><button type="button" class="btn btn-primary btn-sm">company profile.pdf<i class="fas fa-download"></i></button></a>
                </object>
                <div class="form-group">
                    <label for="comapany-profile-file">File Company Profile *pdf</label>
                    <input type="file" class="form-control-file" id="comapany-profile-file" name="file_profile_company">
                </div>
                <div class="form-group">
                    <label for="link_video">Link Video</label>
                    <input type="text" class="form-control" id="link_video" name="link_video" value="{{$aboutUs->link_video}}">
                </div>
                <div class="form-group">
                    <label for="video_description_ina">Video Description *ina</label>
                    <textarea type="text" class="form-control" id="video_description_ina" name="video_description_ina" rows="5">{{$aboutUs->video_description_ina}}</textarea>
                </div>
                <div class="form-group">
                    <label for="video_description_eng">Video Description *eng</label>
                    <textarea type="text" class="form-control" id="video_description_eng" name="video_description_eng" rows="5">{{$aboutUs->video_description_eng}}</textarea>
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


    $('#btnReset').on('click', function(){
        $('#profile-company-content-ina').val(' ');
        $('#profile-company-content-eng').val(' ');
        $('#video_description_eng').val(' ');
        $('#video_description_ina').val(' ');
    });
</script>
@endsection
