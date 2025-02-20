<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\ImportStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::all();
        return response()->json([
          'status' => true,
          'message' => "data student berhasil di tampilkan",
          'data' => $students
        ], 200);
    }

    public function getByUser(Request $request)
    {
        $students = Student::where('users_id', Auth::id())->get();
        return response()->json([
          'status' => true,
          'message' => "data student berhasil di tampilkan",
          'data' => $students
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        return response()->json([
          'status' => true,
          'message' => "data student berhasil ditambahkan",
          'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Display the specified email
     */
    public function Getbyemail($name)
    {
        $student = Student::where('name', $name)->first();
        
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $student
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        $users = User::where('id' , $student->users_id)->first();
        $users->update($request->all());
        return response()->json([
          'status' => true,
          'message' => "Data guru berhasil diubah",
          'data' => $users
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, Request $request)
    {
        $student->delete();
        return response()->json([
          'status' => true,
          'message' => "data student berhasil dihapus",
          'data' => $student
        ], 201);
    }

    public function import(ImportStudentRequest $request)
    {
        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return response()->json([
                'message' => 'Data student berhasil diimport'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat import.',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
