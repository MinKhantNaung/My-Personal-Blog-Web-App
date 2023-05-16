@extends('admin-panel.layouts.master')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <hr class="mt-5">
                    <h4>Students</h4>

                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($students->count() != 1)
                        <form method="POST" action="{{ route('students.create') }}">

                            @csrf
                            <div class="input-group">
                                <input type="number" class="form-control" name="count"
                                    placeholder="Enter total students..." required>
                                <button class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    @else
                        <table class="table table-responsive table-bordered table-success table-hover">
                            <thead>
                                <tr>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $students[0]->count }}</td>
                                    <td>
                                        <button class="btn btn-primary" id="addBtn">+ Add More Students</button>
                                        <form action="{{ route('students.add', 1) }}" method="POST" style="display: none" id="addForm">
                                            @csrf
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="count" placeholder="Enter count...">
                                                <button type="submit" class="btn btn-success btn-sm">+ ADD</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
                <div class="col-md-3"></div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#addBtn').click(function () {
                $(this).hide();
                $('#addForm').css('display', 'block');
            })
        })
    </script>
@endsection
