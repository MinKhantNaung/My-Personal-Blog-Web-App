@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 class="mt-5">Projects
                        <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm float-end">+ Add New</a>
                    </h4>
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{ $projects->links() }}

                    <table class="table table-striped table-responsive table-bordered table-hover table-primary">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>URL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $key => $project)
                                <tr>
                                    <td>{{ $key + $projects->firstItem() }}</td>
                                    <td class="col-2">
                                        <img src="{{ asset('storage/images/' . $project->image) }}"
                                            class="img-thumbnail img-fluid w-100 object-fit-cover">
                                    </td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->url }}</td>
                                    <td>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection
