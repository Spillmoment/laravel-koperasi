@extends('layouts.app')

@section('title', 'Data Admin')

@section('content')

@if (session('success'))
@push('scripts')
<script>
    swal({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush

@endif

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="row">

                    <div class="table-settings mb-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col col-md-6 col-lg-3 col-xl-4">
                                <form action="">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><span
                                                class="fas fa-search"></span></span>
                                        <input type="text" name="q" class="form-control" id="exampleInputIconLeft"
                                            placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="font-weight-normal">{{ $user->name }}</span>
                                    </td>
                                    <td><span class="font-weight-normal">{{ $user->email }}</span></td>
                                    <td>
                                        @if ($user->image)
                                        <img src="{{ Storage::url('public/'. $user->image) }}" width="100">
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->roles == 'admin')
                                        <span class="text-warning font-weight-bold">Admin</span>
                                        @else
                                        <span class="text-success font-weight-bold">Ketua</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button
                                                class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                                </span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.edit',$user->id) }}"><span
                                                        class="fas fa-eye mr-2"></span>View Details</a>
                                                <a class="dropdown-item" href="#"><span
                                                        class="fas fa-edit mr-2"></span>Edit</a>
                                                <a class="dropdown-item text-danger"
                                                    href="{{ route('admin.destroy',$user->id) }}" onclick="event.preventDefault();
            document.getElementById('delete-form').submit();"><span class="fas fa-trash-alt mr-2"></span>Remove</a>
                                                <form id="delete-form" action="{{ route('admin.destroy',$user->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer px-3 border-0 d-flex align-items-center justify-content-between">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
