@extends('teacher.layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h4 class="mb-4" style="font-weight: 600">
                        Data Siswa bimbingan anda
                    </h4>
                </div>
            </div>
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>
                                <p class="mb-0 fw-normal fs-4">{{ $student->user->name }}</p>
                            </td>
                            <td>
                                <a href="/detail/student/{{ $student->id }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <h5 class="text-center">Data jurnal kosong.</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
