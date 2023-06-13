@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr class="mt-5 mt-sm-0">
                    <h4 class="mt-5">Create Post
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm float-end"><< back</a>
                    </h4>
                    <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="mb-3">
                            <label for="image">Choose Image</label><br>
                            <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id">Choose Category</label><br>
                            <select name="category_id" id="category_id" value="{{ old('category_id') }}" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Choose Category...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <input type="text" name="title" id="title" placeholder="Post title..." class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" rows="5" placeholder="Content here..." class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection
