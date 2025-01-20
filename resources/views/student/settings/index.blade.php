@extends('student.layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h4 class="mb-4" style="font-weight: 600">
                        Setting  Data  anda {{ auth()->user()->name }}
                    </h4>
                </div>
            </div>
        </div>
        <form action="/update/setting/{{ $students->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <label for="">Pilih dudi</label>
                    <select name="dudis_id" id="" class="form-select mt-2">
                        <option value="" disabled {{ $students->dudis_id == null ? 'selected' : '' }}>Pilih dudi</option>
                        @foreach ($dudi as $dudi)
                        <option value="{{ $dudi->id }}" {{ $students->dudis_id == $dudi->id ? 'selected' : '' }}>{{ $dudi->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-xl-6">
                    <label for="">Pilih Pembimbing</label>
                    <select name="teachers_id" id="" class="form-select mt-2">
                        <option value="" disabled {{ $students->teachers_id == null ? 'selected' : '' }}>Pilih Pembimbing</option>
                        @foreach ($teacher as $teacher)
                        <option value="{{ $teacher->id }}" {{ $students->teachers_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
