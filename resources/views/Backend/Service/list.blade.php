@extends('Backend.layouts.app')
@section('title')
Service
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{ route('service.create') }}" class="btn btn-success float-right"  >Add</a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($services)
                    <tbody>
                            @foreach ($services as $key => $service)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $service->title }}</td>
                                <td><img src="{{ asset('uploads/thumb/' . $service->image) }}" alt="" class="p-2" id="previewImg" height="50px" width="50px"></td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control-sm w-100" disabled
                                            rows="3">{{ $service->description }}</textarea>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('service.edit', [$service->id]) }}" class="btn btn-app-sm bg-primary edit_btn"> <i class="fas fa-edit"></i></a>
                                    <a id="destroy" href="{{ route('service.destroy', [$service->id]) }}" class="btn btn-app-sm bg-danger delete_btn" > @csrf <i class="fas fa-trash"></i></a>
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
