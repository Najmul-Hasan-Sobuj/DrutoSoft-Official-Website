@extends('Backend.layouts.app')
@section('title')
Contact
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{ route('contact.create') }}" class="btn btn-success float-right"  >Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($contacts)
                    <tbody>
                            @foreach ($contacts as $key => $contact)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control-sm w-100" disabled
                                            rows="3">{{ $contact->description }}</textarea>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('contact.edit', [$contact->id]) }}" class="btn btn-app-sm bg-primary edit_btn"> <i class="fas fa-edit"></i></a>
                                    <a id="destroy" href="{{ route('contact.destroy', [$contact->id]) }}" class="btn btn-app-sm bg-danger delete_btn" > @csrf <i class="fas fa-trash"></i></a>
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
