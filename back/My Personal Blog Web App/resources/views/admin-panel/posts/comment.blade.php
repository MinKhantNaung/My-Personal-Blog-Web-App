@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 class="mt-5">Manage Comments
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm float-end">
                            << back</a>
                    </h4>
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- {{ $projects->links() }} --}}

                    <table class="table table-striped table-responsive table-bordered table-hover table-primary">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Text</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post->comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->text }}</td>
                                    <td>
                                        <form action="{{ route('comments.showHide', $comment->id) }}" method="POST">

                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $comment->status == 'show' ? 'btn-danger' : 'btn-success' }}">
                                                {{ $comment->status == 'show' ? 'Hide' : 'Show' }}
                                            </button>
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
