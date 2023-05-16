@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h4 class="mt-5">Posts:
                        <span class="badge bg-danger">{{ $posts->total() }}</span>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-end">+ Add New</a>
                    </h4>
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{ $posts->links() }}

                    <table class="table table-striped table-responsive table-bordered table-hover table-primary">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMAGE</th>
                                <th>CATEGORY</th>
                                <th>TITLE</th>
                                <th>CONTENT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td class="col-2">
                                        <img src="{{ asset('storage/post_images/' . $post->image) }}" alt="image"
                                            class="w-100 img-thumbnail object-fit-cover">
                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ substr($post->content, 0, 50) }}...</td>
                                    <td>
                                        <form action="{{ route('posts.delete', $post->id) }}" method="POST">

                                            @csrf
                                            <a href="{{ route('posts.detail', $post->id) }}" class="btn btn-info btn-sm mt-1">Detail</a>
                                            <button type="submit" class="btn btn-danger btn-sm mt-1"
                                                onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                            <a href="{{ route('posts.comments', $post->id) }}" class="btn btn-info btn-sm mt-1">Comments</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
