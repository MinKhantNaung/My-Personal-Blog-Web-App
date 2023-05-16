@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            Post Details
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm float-end"><< back</a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $post->title }}</h4>
                            <div class="text-muted">{{ $post->created_at->diffForHumans() }} |
                                {{ $post->category->name }}
                            </div>
                            <p class="mt-3">
                                <img src="{{ asset("storage/post_images/$post->image") }}" alt="image" class="w-100 p-sm-5">
                                {{ $post->content }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.edit', $post->id) }}" class="card-link btn btn-secondary">Edit</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
