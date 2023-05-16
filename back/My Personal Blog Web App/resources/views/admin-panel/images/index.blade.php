@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 class="mt-5">Images From Social Media
                        @if ($images->count() != 6)
                            <a href="{{ route('images.create') }}" class="btn btn-primary btn-sm float-end">+ Add New</a>
                        @endif
                    </h4>
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-striped table-responsive table-bordered table-hover table-primary">
                        <caption>You can create only 6 photos!</caption>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td class="col-1">
                                        <img src="{{ asset("storage/social_images/$image->name") }}" class="w-100 img-thumbnail">
                                    </td>
                                    <td>
                                        {{ $image->name }}
                                    </td>
                                    <td>
                                        <form action="{{ route('images.destroy', $image->id) }}" method="POST">

                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete?')">Delete</button>
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
