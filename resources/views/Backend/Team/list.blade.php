@extends('Backend.layouts.app')
@section('title')
Team Members
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{ route('team.create') }}" class="btn btn-success float-right"  >Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Skill</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($teams)
                    <tbody>
                            @foreach ($teams as $key => $team)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->skills }}</td>
                                <td>{{ $team->designation }}</td>
                                <td class="text-center">
                                    <a href="{{ route('team.show', [$team->id]) }}" class="btn btn-app-sm bg-success view_btn"> <i class="fas fa-eye"></i></a>
                                    <a href="{{ route('team.edit', [$team->id]) }}" class="btn btn-app-sm bg-primary edit_btn"> <i class="fas fa-edit"></i></a>
                                    <a id="destroy" href="{{ route('team.destroy', [$team->id]) }}" class="btn btn-app-sm bg-danger delete_btn" > @csrf <i class="fas fa-trash"></i></a>
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
