@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr class="mt-5 mt-sm-0">
                    <h4 class="mt-5">Create Categories
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm float-end"><< back</a>
                    </h4>
                    <form action="{{ route('categories.store') }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Category Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection
