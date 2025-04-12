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
                    <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <form id="filter-form" action="{{ route('user') }}" method="GET" class="row g-3 needs-validation">

                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="___" value="{{ request('name') }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" name="email" placeholder="___" value="{{ request('email') }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="is_verified">
                                    <option value="">--Choose Status--</option>
                                    <option value="0" {{ request('is_verified') == '0' ? "selected" : "" }}>Not Verified</option>
                                    <option value="1" {{ request('is_verified') == '1' ? "selected" : "" }}>Verified</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" id="filter-submit" type="submit">Submit</button>
                                <button class="ms-3 btn btn-light" id="filter-reset" type="button">Reset</button>
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
                            <h5 class="card-title">{{ $title }} List</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                        <table class="display border table-striped" id="main-table">
                            <thead>
                                <tr>
                                    <th class="text-start" width="5%">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-start">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            @if (isset($user->email_verified_at) && $user->email_verified_at != "")
                                                <span class="badge rounded-pill badge-success">Verified</span>
                                            @else
                                                <span class="badge rounded-pill badge-danger">Not Verified</span>
                                            @endif
                                        </td>
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

        $('#filter-reset').on('click', function() {
            const form = document.getElementById('filter-form');
            form.querySelectorAll('input, select').forEach(el => el.value = '');
        });
    });
</script>
@endsection
