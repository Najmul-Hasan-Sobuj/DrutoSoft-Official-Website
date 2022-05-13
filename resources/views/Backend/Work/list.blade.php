@extends('Backend.layouts.app')
@section('title')
Our Work
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{ route('work.create') }}" class="btn btn-success float-right"  >Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($works)
                    <tbody>
                            @foreach ($works as $key => $work)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $work->title }}</td>
                                <td><img src="{{ asset('uploads/thumb/' . $work->image) }}" alt="" class="p-2" id="previewImg" height="50px" width="50px"></td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control-sm w-100" disabled
                                            rows="3">{{ $work->description }}</textarea>
                                    </div>
                                </td>
                                <td><a href="#" class="nav-link" >{{ $work->link }}</a></td>
                                <td class="text-center">
                                    <a href="{{ route('work.edit', [$work->id]) }}" class="btn btn-app-sm bg-primary edit_btn"> <i class="fas fa-edit"></i></a>
                                    <a id="destroy" href="{{ route('work.destroy', [$work->id]) }}" class="btn btn-app-sm bg-danger delete_btn" > @csrf <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                        
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection
