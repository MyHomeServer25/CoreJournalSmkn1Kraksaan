@extends('admin.layouts.app')
@section('content')
    {{-- create data  --}}
    <div id="bs-example-modal-md" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Tambah siswa
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('student.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Import data siswa by excel</p>
                                <input type="file" class="form-control" id="file" name="file">
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">email</p>
                                <input type="email" class="form-control" id="name" name="email">
                            </div>
                            <div class="col-xl-12 mt-3 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Password</p>
                                <input type="password" class="form-control" id="name" name="password">
                            </div> --}}
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
                {{-- <form  method="post" id="form-update">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Nama</p>
                                <input type="text" class="form-control" id="data-name" name="name">
                            </div>
                            <div class="col-xl-6 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">email</p>
                                <input type="email" class="form-control" id="data-email" name="email">
                            </div>
                            <div class="col-xl-12 mt-3 col-12 ">
                                <p style="font-weight:500" class="text-dark mb-2">Password</p>
                                <input type="password" class="form-control" id="data-password" name="password">
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
                </form> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Modal Detail -->
    <div id="detail-modal" class="modal fade" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Detail Permintaan</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <form id="form-update" method="post" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="id" id="update-id">
                    <p><strong>Nama:</strong> <span id="detail-name"></span></p>
                    <p><strong>Email:</strong> <span id="detail-email"></span></p>
                    <p><strong>Guru:</strong> <span id="detail-teacher"></span></p>
                    <p><strong>Dudi:</strong> <span id="detail-dudi"></span></p>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-none" id="reject-reason-container">
                        <label for="reason" class="form-label">Alasan Penolakan</label>
                        <textarea name="reason" id="reject-reason" class="form-control" rows="3"></textarea>
                        @error('reason')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
      </div>
  </div>
    {{-- end update data  --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="mb-4" style="font-weight: 600">
                            Data Siswa
                        </h4>
                    </div>
                    <div class="">
                        <button class="btn me-1 mb-1 btn-light-primary text-primary btn-lg px-4 fs-4 font-medium"
                            data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                            Import Data Siswa 
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="search-student" class="form-label fw-semibold">Cari Siswa</label>
                    <div class="input-group">
                        <input type="text" id="search-student" class="form-control" placeholder="Cari siswa berdasarkan email..." autofocus>
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
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
                                <h6 class="fs-4 fw-semibold mb-0">Guru</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Dudi</h6>
                            </th>
                            @if (isset($hasPendingRequests) && $hasPendingRequests)
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $student->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $student->user->email }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $student->teacher->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal fs-4">{{ $student->dudi->name }}</p>
                                </td>
                                @foreach ($studentRequests as $request)
                                    @if ($request->student_id === $student->id) 
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="btn btn-primary btn-detail position-relative" 
                                                    data-id="{{ $request->id }}"
                                                    data-name="{{ $request->student->name }}" 
                                                    data-email="{{ $request->student->user->email }}" 
                                                    data-teacher="{{ $request->teacher->name }}" 
                                                    data-dudi="{{ $request->dudi->name }}" 
                                                    data-status="{{ $request->status }}">
                                                    Detail
                                                    @if ($request->status == 'pending')
                                                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center">Data siswa kosong.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $students->links() }}
            </div>
        </div>
    </div>
    @include('student.components.delete-modal-component')
@endsection
@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script>
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
            $('#update-modal').modal('show');
        });
    </script> --}}
    <script>
      $(document).ready(function () {
        $('.btn-detail').click(function () {
            var id = $(this).data('id'); 
            var name = $(this).data('name');
            var email = $(this).data('email');
            var teacher = $(this).data('teacher');
            var dudi = $(this).data('dudi');
            var status = $(this).data('status');

            // Set action form
            if (id) {
                $('#form-update').attr('action', '/settings/approve/' + id);
            }

            // Isi form dengan data
            $('#update-id').val(id);
            $('#status').val(status);
            $('#detail-name').text(name);
            $('#detail-email').text(email);
            $('#detail-teacher').text(teacher);
            $('#detail-dudi').text(dudi);

            // Tampilkan/ sembunyikan alasan jika status ditolak
            if (status === 'rejected') {
            $('#reject-reason-container').removeClass('d-none');
            } else {
                $('#reject-reason-container').addClass('d-none');
            }

            // Tampilkan modal
            $('#detail-modal').modal('show');
        });

        // Tampilkan textarea alasan hanya jika statusnya "Ditolak"
        $('#status').change(function () {
            if ($(this).val() === 'rejected') {
                $('#reject-reason-container').removeClass('d-none');
            } else {
                $('#reject-reason-container').addClass('d-none');
            }
        });
    });

    $(document).ready(function () {
        let timeout = null; // Variabel untuk menunda request
        
        // $('#search-student').on('input', function () {
        //     let query = $(this).val().trim(); // Ambil input & hapus spasi di awal/akhir

        //     if (query.length >= 3) {
        //         clearTimeout(timeout); // Hentikan request sebelumnya
        //         timeout = setTimeout(() => {
        //             window.location.href = "/student/" + query; // Redirect otomatis
        //         }, 500); // Delay 500ms untuk menghindari request berulang saat mengetik
        //     }
        // });
        $('#search-student').on('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Mencegah submit default form
            let query = $(this).val().trim();
            if (query.length > 0) {
                window.location.href = "/student/" + query;
            }
        }
    });
    });
  </script>
@endsection
