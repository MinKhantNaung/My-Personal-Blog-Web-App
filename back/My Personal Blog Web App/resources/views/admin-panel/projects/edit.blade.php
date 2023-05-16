@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr class="mt-5 mt-sm-0">
                    <h4 class="mt-5">Edit Project
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm float-end">
                            << back</a>
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset("storage/images/$project->image") }}" alt="project image" class="img-thumbnail img-fluid object-fit-cover w-100">
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('projects.update', $project->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
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
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Project Name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $project->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="url">URL</label>
                                    <input type="text" name="url" id="url" placeholder="https://example.com"
                                        class="form-control @error('url') is-invalid @enderror"
                                        value="{{ old('url', $project->url) }}">
                                    @error('url')
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
