@extends('admin-panel.layouts.master')

@section('content')
    {{-- Account Detail Section --}}
    <hr class="mt-5">
    <section class="bg-white mt-5">
        <div class="container">
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

                    <a href="{{ route('admin.edit', Auth::user()->id) }}"
                        class="col-8 offset-2 btn btn-info text-white mb-2"><i class="fa-solid fa-pen me-1"></i>Edit</a>
                </div>
                <div class="col-md-7 mt-5">
                    <div class="card">
                        @if (session('successMsg'))
                            <div class="alert alert-info" role="alert">
                                <i class="fa-solid fa-check me-1"></i>{{ session('successMsg') }}
                            </div>
                        @endif
                        <div class="card-header">
                            <h3>Admin Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
