@extends('ui-panel.layouts.master')

@section('title', 'Mr.Min Personal Blog')
@section('content')

    {{-- Account Edit Section --}}
    <section class="bg-white">
        <div class="container">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-5 bg-secondary">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" alt="Profile Image" class="w-100 p-sm-5 p-3">
                        @else
                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="Profile Image" class="w-100 p-sm-5 p-3">
                        @endif

                        <label for="image" class="text-white">Choose Profile Image</label>
                        <input type="file" class="form-control my-2 @error('image') is-invalid @enderror" name="image" id="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-7 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Account</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-check me-1"></i>Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
