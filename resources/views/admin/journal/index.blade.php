@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="mb-4" style="font-weight: 600">
                    Data jurnal siswa
                </h4>
                <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Tanggal</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Unit Pekerjaan</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Description</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($journals as $journal)
                        <tr>
                            <td>
                                <p class="mb-0 fw-normal fs-4">{{ $journal->user->name }}</p>
                            </td>
                            <td>
                                <p class="mb-0 fw-normal fs-4">{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('d F Y') }}</p>
                            </td>
                            <td>
                                <p class="mb-0 fw-normal fs-4">
                                    {{ strlen($journal->name) > 40 ? substr($journal->name, 0, 40) . '...' : $journal->name }}
                                  </p>
                            </td>
                            <td>
                                <p class="mb-0 fw-normal fs-4">
                                    {{ strlen($journal->description) > 40 ? substr($journal->description, 0, 40) . '...' : $journal->description }}
                                  </p>
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
                {{ $journals->links() }}
            </div>
        </div>
    </div>
@endsection
