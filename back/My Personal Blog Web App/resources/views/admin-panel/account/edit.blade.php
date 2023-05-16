@extends('admin-panel.layouts.master')

@section('content')
    <hr class="mt-5">
    <section class="bg-white mt-5">
        <div class="container">
            <div class="row">
                <form action="{{ route('admin.update', Auth::user()->id) }}" enctype="multipart/form-data" method="POST">

                    @csrf
                    <div class="row">
                        <div class="col-md-5 bg-secondary">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('images/default.png') }}" alt="Profile Image"
                                            class="w-100 p-sm-5 p-3 img-thumbnail">
                                    @else
                                        <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="Profile Image"
                                            class="w-100 p-sm-5 p-3">
                                    @endif
                                </div>
                            </div>
                            <label for="image">New Image?</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="col-8 offset-2 btn btn-info text-white my-2"><i
                                    class="fa-solid fa-pen me-1"></i>Update</button>
                        </div>
                        <div class="col-md-7 mt-5">
                            <div class="card">
                                @if (session('successMsg'))
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa-solid fa-check me-1"></i>{{ session('successMsg') }}
                                    </div>
                                @endif
                                <div class="card-header">
                                    <h3>Update Admin</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', Auth::user()->name) }}" placeholder="Enter name..."
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', Auth::user()->email) }}" placeholder="Enter email..."
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <h5>Role: Admin</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
