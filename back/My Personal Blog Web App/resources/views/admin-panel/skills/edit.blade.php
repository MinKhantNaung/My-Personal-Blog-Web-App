@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr class="mt-5 mt-sm-0">
                    <h4 class="mt-5">Edit Skill
                        <a href="{{ route('skills.index') }}" class="btn btn-secondary btn-sm float-end"><< back</a>
                    </h4>
                    <form action="{{ route('skills.update', $skill->id) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Skill Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $skill->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="percent">Percent</label>
                            <input type="number" name="percent" id="percent" placeholder="0-100" class="form-control @error('percent') is-invalid @enderror" value="{{ old('percent', $skill->percent) }}">
                            @error('percent')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection
