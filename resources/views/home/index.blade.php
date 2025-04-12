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
                    <li class="breadcrumb-item active">
                        <a href="#!">
                            <svg class="stroke-icon">
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
                            <h5 class="card-title">Hi {{ $title }}</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table text-justify">
                            <tbody>
                                <tr>
                                    <td class="text-sm-end fw-bold" width="15%">Full Name</td>
                                    <td class="text-center" width="5%">:</td>
                                    <td class="text-sm-start">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end fw-bold">Email</td>
                                    <td class="text-center">:</td>
                                    <td class="text-sm-start">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end fw-bold">Status</td>
                                    <td class="text-center">:</td>
                                    <td class="text-sm-start">
                                        @if (isset($user->email_verified_at) && $user->email_verified_at != "")
                                            <span class="badge rounded-pill badge-success">Verified</span>
                                        @else
                                            <span class="badge rounded-pill badge-danger">Not Verified</span>
                                        @endif
                                    </td>
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
