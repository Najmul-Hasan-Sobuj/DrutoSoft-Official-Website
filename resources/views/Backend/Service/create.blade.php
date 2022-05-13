@extends('Backend.layouts.app')
@section('title')
    Service
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary mt-3">
        <div class="card-header">
          <h3 class="card-title">Service</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Experience The">
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="e.g. lorem ipsum dolor sit amet"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" onchange="previewFile(this);" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group mt-4">
                        <img id="previewImg" src="{{ asset('Backend/dist/img/view image.png') }}" class="img-thumbnail img-fluid" alt="view the image" />
                    </div>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->

    </div>
  </div>
@endsection