@extends('Backend.layouts.app')
@section('title')
    Contact
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary mt-3">
        <div class="card-header">
          <h3 class="card-title">Contact</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('contact.store') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Experience The">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="e.g. Experience The">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" id="description" name="description" placeholder="e.g. lorem ipsum dolor sit amet"></textarea>
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