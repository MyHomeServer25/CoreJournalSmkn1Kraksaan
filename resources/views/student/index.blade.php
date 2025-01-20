@extends('student.layouts.app')
@section('content')
<h1 class="text-center">
    Hello Siswa {{ auth()->user()->name }}
 </h1>
@endsection
