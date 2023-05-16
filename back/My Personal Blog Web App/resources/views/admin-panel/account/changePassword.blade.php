@extends('admin-panel.layouts.master')

@section('content')

    <section class="bg-white mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card text-center my-5">

                        {{-- Old Password Not Match Error --}}
                        @if (session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="card-header">
                            Change Password
                        </div>
                        <form action="{{ route('admin.updatePassword', Auth::user()->id) }}" method="POST">

                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="oldPassword">Old Password</label>
                                    <input type="password" name="oldPassword" id="oldPassword"
                                        class="form-control @error('oldPassword') is-invalid @enderror" placeholder="xxxxxxxx">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" name="newPassword" id="newPassword"
                                        class="form-control @error('newPassword') is-invalid @enderror" placeholder="xxxxxxxx">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        placeholder="xxxxxxxx">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>

@endsection
