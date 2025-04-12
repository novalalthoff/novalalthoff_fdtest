@extends('layouts/app')

@section('css-library')
@endsection

@section('css-custom')
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
            <div class="col-sm-6">
                <h3>Explore Our Collection of Books!</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <svg class="stroke-icon active">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                        </a>
                    </li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="card-title">Search Filter</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" action="{{ route('landing') }}" method="GET" class="row g-3 needs-validation">

                            <div class="col-md-12">
                                <label class="form-label" for="author">Author</label>
                                <input class="form-control" id="author" type="text" name="author" placeholder="___" value="{{ request('author') }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="created_at">Uploaded date</label>
                                <input class="form-control" id="created_at" type="date" name="created_at" placeholder="___" value="{{ request('created_at') }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="rating">Rating</label>
                                <select class="form-select" name="rating">
                                    <option value="">--Choose Rating--</option>
                                    <option value="1" {{ request('rating') == '1' ? "selected" : "" }}>1</option>
                                    <option value="2" {{ request('rating') == '2' ? "selected" : "" }}>2</option>
                                    <option value="3" {{ request('rating') == '3' ? "selected" : "" }}>3</option>
                                    <option value="4" {{ request('rating') == '4' ? "selected" : "" }}>4</option>
                                    <option value="0" {{ request('rating') == '5' ? "selected" : "" }}>5</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" id="btnSearch" type="submit">Submit</button>
                                <button class="ms-3 btn btn-light" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>









    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="card-title">Uploaded Book by Users</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                        <table class="display border table-striped" id="main-table">
                            <thead>
                                <tr>
                                    <th class="text-start" width="5%">#</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th class="text-center">Rating</th>
                                    <th class="text-center">Thumbnail</th>
                                    <th>User</th>
                                    <th>Uploaded at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="text-start">{{ $loop->iteration }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td class="text-center">{{ $book->rating }}</td>
                                        <td>
                                            @if (isset($book->thumbnail_path) && Storage::disk('public')->exists($book->thumbnail_path))
                                                <img src="{{ asset('storage/' . $book->thumbnail_path) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $book->title }}">
                                            @endif
                                        </td>
                                        <td>{{ $book->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($book->created_at)->format("d/m/Y"); }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        $('#main-table').DataTable();
    });
</script>
@endsection
