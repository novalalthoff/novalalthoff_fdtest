@extends('layouts/app')

@section('css-library')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> --}}
@endsection

@section('css-custom')
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
            <div class="col-sm-6">
                <h3>{{ $header }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route($route) }}">{{ $title }}</a>
                    </li>
                    <li class="breadcrumb-item active">Details</li>
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
                            <h5 class="card-title">{{ $title }} Details</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4 d-flex justify-content-center">
                            @if (isset($book->thumbnail_path) && Storage::disk('public')->exists($book->thumbnail_path))
                                <img src="{{ asset('storage/' . $book->thumbnail_path) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $book->title }}">
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-justify">
                            <tbody>
                                <tr>
                                    <td class="text-sm-end fw-bold" width="15%">Title</td>
                                    <td class="text-center" width="5%">:</td>
                                    <td class="text-sm-start">{{ $book->title }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end fw-bold">Author</td>
                                    <td class="text-center">:</td>
                                    <td class="text-sm-start">{{ $book->author }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end fw-bold">Rating</td>
                                    <td class="text-center">:</td>
                                    <td class="text-sm-start">{{ $book->rating }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end fw-bold">Description</td>
                                    <td class="text-center">:</td>
                                    <td class="text-sm-start"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-sm-start">{{ $book->description }}</td>
                                </tr>
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
@endsection
