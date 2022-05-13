@extends('Backend.layouts.app')
@section('title')
    Home
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary mt-3">
        <div class="card-header">
          <h3 class="card-title">Home</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('homes.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="title_one">First Title</label>
              <input type="text" class="form-control" id="title_one" name="title_one" value="{{$homes->title_1}}" placeholder="e.g. Experience The">
            </div>
            <div class="form-group">
              <label for="title_two">Second Title</label>
              <input type="text" class="form-control" id="title_two" name="title_two" value="{{ $homes->title_2 }}" placeholder="e.g. Best Quaity Software">
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="e.g. lorem ipsum dolor sit amet">{{ $homes->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" onchange="previewFile(this);" id="image" name="image" value="{{ $homes->image }}" >
                            <label class="custom-file-label" for="image">Choose file</label>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote">Quote</label>
                        <input type="text" class="form-control" id="quote" name="quote" value="{{ $homes->footer }}" placeholder="e.g. An Amazing Software Can Change your Daily Work Experience">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group mt-4">
                        <img id="previewImg" src="{{ asset($homes->image) }}" class="img-thumbnail img-fluid" alt="view the image" />
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