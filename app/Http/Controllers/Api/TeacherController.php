<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\JournalResource;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json([
          'status' => true,
          'message' => "Data guru berhasil diambil",
          'data' => $teachers
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
    public function store(StoreTeacherRequest $request)
    {
       $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'teacher',
        ]);
        Teacher::create([
            'name' => $request->name,
            'users_id' => $users->id
        ]);
        return response()->json([
          'status' => true,
          'message' => "Data guru berhasil ditambahkan",
          'data' => $users
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        $users = User::where('id' , $teacher->users_id)->first();
        $users->update($request->all());
        return response()->json([
          'status' => true,
          'message' => "Data guru berhasil diubah",
          'data' => $teacher
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher, Request $request)
    {
        $teacher->delete();
        return response()->json([
          'status' => true,
          'message' => "Data guru berhasil dihapus",
          'data' => $teacher
        ], 200);
    }

    public function journal(Request $request)
    {
        $teachers = Teacher::where('users_id' , auth()->user()->id)->first();
        $journals = Journal::where('teachers_id', $teachers->id)->latest()->paginate(10);
        return response()->json([
            'status' => true,
            'message' => "Data jurnal berhasil diambil",
            'data' => JournalResource::collection($journals)
        ], 200);
    }

    public function student(Request $request)
    {
        $teachers = Teacher::where('users_id' , auth()->user()->id)->first();
        $students = Student::where('teachers_id', $teachers->id)->get();
        return response()->json([
            'status' => true,
            'message' => "Data siswa berhasil diambil",
            'data' => StudentResource::collection($students)
        ], 200);
    }

    public function detailStudent (Student $student, Request $request)
    {   
        $journals = Journal::where('users_id' , $student->users_id)->get();
        return response()->json([
          'status' => true,
          'message' => "Data details siswa berhasil diambil",
          'data' => JournalResource::collection($journals),
        ], 200);
    }
}
