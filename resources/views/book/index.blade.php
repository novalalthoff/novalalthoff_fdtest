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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="card-title">{{ $title }} List</h5>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a class="btn btn-success f-w-500" href="#!" data-bs-toggle="modal" data-bs-target="#create-modal">
                                <i class="fa fa-plus pe-2"></i> Add Data
                            </a>

                            <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content category-popup">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add New {{ $title }}</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0 custom-input">
                                            <div class="text-start">
                                                <div class="p-20">
                                                    <form id="create-form" class="row g-3 needs-validation" action="{{ route($route.'.store') }}" method="POST">
                                                        @csrf

                                                            <div class="col-md-12">
                                                                <label class="form-label fw-bold" for="title">Title<span class="txt-danger">*</span></label>
                                                                <input class="form-control" id="title" type="text" name="title" placeholder="Insert Title" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label fw-bold" for="author">Author</label>
                                                                <input class="form-control" id="author" type="text" name="author" placeholder="Insert Author">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label fw-bold" for="rating">Rating</label>
                                                                <select class="form-select" id="rating" name="rating">
                                                                    <option value="">--Choose Rating--</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label fw-bold" for="description">Description</label>
                                                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label fw-bold" for="thumbnail">Thumbnail</label>
                                                                <input class="form-control" id="thumbnail" name="thumbnail" type="file" accept=".jpg, .jpeg, .png">
                                                            </div>

                                                            <div class="col-md-12 d-flex justify-content-end">
                                                                <button class="btn btn-success" id="create-submit" type="submit">Create</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                    <th>Action</th>
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
                                        <td>
                                            <ul class="action">
                                                <li class="me-1">
                                                    <a href="{{ route($route.'.show', ['id' => $book->id]) }}" target="_blank">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#edit-modal"
                                                        onclick="setEditForm(`{{ route($route.'.update', ['id' => $book->id]) }}`, `{{ $book->title }}`, `{{ $book->author }}`, `{{ $book->rating }}`, `{{ $book->description }}`, `{{ $book->thumbnail }}`, `{{ $book->thumbnail_path }}`)"
                                                    >
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="setDeleteForm(`{{ route($route.'.destroy', ['id' => $book->id]) }}`, `{{ $book->title }}`)">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </li>
                                            </ul>
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

<div class="modal fade" id="edit-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content category-popup">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{ $title }}</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 custom-input">
                <div class="text-start">
                    <div class="p-20">
                        <form id="edit-form" class="row g-3 needs-validation" action="" method="POST">
                            @csrf

                                <div class="col-md-12">
                                    <label class="form-label fw-bold" for="edit-title">Title<span class="txt-danger">*</span></label>
                                    <input class="form-control" id="edit-title" type="text" name="title" placeholder="Insert Title" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold" for="edit-author">Author</label>
                                    <input class="form-control" id="edit-author" type="text" name="author" placeholder="Insert Author">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold" for="edit-rating">Rating</label>
                                    <select class="form-select" id="edit-rating" name="rating">
                                        <option value="">--Choose Rating--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold" for="edit-description">Description</label>
                                    <textarea class="form-control" id="edit-description" rows="3" name="description"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Thumbnail</label>
                                    <input class="form-control" name="thumbnail" type="file" accept=".jpg, .jpeg, .png">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold" for="edit-thumbnail"></label>
                                    <input class="form-control" id="edit-thumbnail" type="text" disabled>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" id="edit-submit" type="submit">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content category-popup">
            <div class="modal-header">
                <h5 class="modal-title">Delete {{ $title }}</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 custom-input">
                <div class="text-start">
                    <div class="p-20">
                        <form id="delete-form" class="row g-3 needs-validation" action="" method="POST">
                            @csrf
                                <p>Are you sure want to <span class="text-danger">delete</span> <span id="delete-title" class="fst-italic text-primary"></span> ?</p>
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-danger" id="delete-submit" type="submit">Delete</button>
                                </div>
                        </form>
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
    function setEditForm(url, title, author, rating, description, thumbnail, thumbnail_path) {
        $('#edit-form').attr('action', url);
        $('#edit-title').val(title);
        $('#edit-author').val(author ?? "");
        $('#edit-rating').val(rating ?? "").change();
        $('#edit-description').val(description ?? "");
        $('#edit-thumbnail').val(thumbnail == "" ? "-" : thumbnail);
    }

    function setDeleteForm(url, title) {
        $('#delete-form').attr('action', url);
        $('#delete-title').text(title);
    }

    $(document).ready(function() {
        $('#main-table').DataTable();

        $('#create-form').on('submit', function(e) {
            e.preventDefault();
            submitForm($(this), $('#create-submit'));
        });

        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            submitForm($(this), $('#edit-submit'));
        });

        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            submitForm($(this), $('#delete-submit'));
        });
    });
</script>
@endsection
