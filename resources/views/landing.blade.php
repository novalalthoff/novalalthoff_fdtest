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
                <h3>Hi{{ isset($title) ? " ".$title : "" }}!</h3>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="card-title">Worldwide {{ $title }} List</h5>
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
                                    <th class="text-center">Thumbnail</th>
                                    <th>Title</th>
                                    <th class="text-center">Rating</th>
                                    <th>Uploader</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="text-start">{{ $loop->iteration }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>
                                            @if (isset($book->thumbnail_path) && Storage::disk('public')->exists($book->thumbnail_path))
                                                <img src="{{ asset('storage/' . $book->thumbnail_path) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $book->title }}">
                                            @endif
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td class="text-center">{{ $book->rating }}</td>
                                        <td>{{ $book->user->name }}</td>
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
