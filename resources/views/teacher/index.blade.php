@extends('teacher.layouts.app')
@section('content')
    <h1 class="text-center">
       Hello Pembimbing {{ auth()->user()->name }}
    </h1>
@endsection
