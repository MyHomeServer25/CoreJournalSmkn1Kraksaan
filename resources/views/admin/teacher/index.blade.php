@extends('admin.layouts.app')
@section('content')
    {{-- create data  --}}
    <div id="bs-example-modal-md" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Tambah pembimbing
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teacher.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Nama</p>
                                <input type="text" class="form-control" id="name" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">email</p>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-12 mt-3 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Password</p>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                                data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end create data  --}}
    {{-- update data  --}}
    <div id="update-modal" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Edit pembimbing
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  method="post" id="form-update">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Nama</p>
                                <input type="text" class="form-control" id="data-name" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">email</p>
                                <input type="email" class="form-control" id="data-email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-12 mt-3 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Password</p>
                                <input type="password" class="form-control" id="data-password" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                                data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end update data  --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="mb-4" style="font-weight: 600">
                            Data Pembimbing
                        </h4>
                    </div>
                    <div class="">
                        <button class="btn me-1 mb-1 btn-light-primary text-primary btn-lg px-4 fs-4 font-medium"
                            data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                            Tambah pempimbing
                        </button>
                    </div>
                </div>

                <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $teacher)
                            <tr>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $teacher->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $teacher->user->email }}</p>
                                </td>
                                <td>
                                    <div class="d-flex gap-3 ">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-edit" data-id="{{ $teacher->id }}"
                                            data-name="{{ $teacher->name }}" data-email="{{ $teacher->user->email }}" data-password="{{ $teacher->user->password }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h6.525q.5 0 .75.313t.25.687t-.262.688T11.5 5H5v14h14v-6.525q0-.5.313-.75t.687-.25t.688.25t.312.75V19q0 .825-.587 1.413T19 21zm4-7v-2.425q0-.4.15-.763t.425-.637l8.6-8.6q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662l-8.6 8.6q-.275.275-.637.438t-.763.162H10q-.425 0-.712-.288T9 14m12.025-9.6l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" />
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-delete"
                                            data-id="{{ $teacher->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center">Data pembimbing kosong.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
    @include('student.components.delete-modal-component')
@endsection
@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        $(document).ready(function() {
        // Fungsi untuk teacher management
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/teacher/delete/' + id);
            $('#modal-delete').modal('show');
        });

        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var password = $(this).data('password');
            $('#form-update').attr('action', '/teacher/update/' + id);
            $('#data-name').val(name);
            $('#data-email').val(email); 
            $('#update-modal').modal('show');
        });
    });
    </script>
@endsection
