@extends('Backend.layouts.app')
@section('title')
    Team Members
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary mt-3">
        <div class="card-header">
          <h3 class="card-title">Team Members</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $teams->name }}"  placeholder="e.g. MD. Najmul Hasan" disabled>
              </div>
              <div class="form-group">
                <label for="skill">Skill</label>
                <input type="text" class="form-control" id="skill" name="skills" value="{{ $teams->skills }}"  placeholder="e.g. php, laravel" disabled>
              </div>
              <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ $teams->designation }}"  placeholder="e.g. Web Developer" disabled>
              </div>
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $teams->facebook }}"  placeholder="e.g. najmulhasan" disabled>
                      </div>
                      <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $teams->linkedin }}"  placeholder="e.g. najmulhasan" disabled>
                      </div>
                      <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $teams->twitter }}"  placeholder="e.g. najmulhasan" disabled>
                      </div>
                      <div class="form-group">
                        <label for="github">Github</label>
                        <input type="text" class="form-control" id="github" name="github" value="{{ $teams->github }}"  placeholder="e.g. najmulhasan" disabled>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group mt-4">
                          <img id="previewImg" src="{{ asset('uploads/' . $teams->image) }}" class="img-thumbnail img-fluid" alt="view the image" />
                      </div>
                  </div>
                </div>
            </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
  </div>
@endsection