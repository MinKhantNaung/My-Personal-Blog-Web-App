@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr class="mt-5 mt-sm-0">
                    <h4 class="mt-5">Edit Project
                        <a href="{{ route('posts.detail', $post->id) }}" class="btn btn-secondary btn-sm float-end">
                            << back</a>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/post_images/' . $post->image) }}" alt="project image" class="img-thumbnail img-fluid object-fit-cover w-100">
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="mb-3">
                                    <label for="image">Choose Image</label><br>
                                    <input type="file" name="image" id="image"
                                        class="@error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category_id">Choose Category</label>
                                    <select name="category_id" id="category_id" class="form-select @error('cateogry_id') is-invalid @enderror">
                                        <option value="">Choose category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $post->category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" placeholder="Post Title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection
