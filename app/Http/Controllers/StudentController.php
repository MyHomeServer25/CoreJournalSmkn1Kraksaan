<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentRequest;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\ImportStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);
        $studentRequests = StudentRequest::with(['student', 'teacher', 'dudi'])
        ->where('status', 'pending')
        ->get();
        $hasPendingRequests = \App\Models\StudentRequest::where('status', 'pending')->exists();

        // return view('admin.student.index', compact('students', 'studentRequests'));
        return view('admin.student.index', [
            'students' => $students,
            'studentRequests' => $studentRequests,
            'hasPendingRequests' => $hasPendingRequests
        ]);
    }

    // public function studentRequest(Student $student)
    // {
    //     $studentRequests = StudentRequest::with(['student', 'teacher', 'dudi'])->where('status', 'pending')->first();
            
    //     return view('admin.student.index', compact('studentRequests'));
    // }

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
        Student::create($request->all());
        return redirect()->route('student.index')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    public function Getbyemail($name)
    {
        $students = Student::where('name', 'LIKE', "%$name%")->paginate(10);
        $studentRequests = StudentRequest::with(['student', 'teacher', 'dudi'])
        ->where('status', 'pending')
        ->get();
        $hasPendingRequests = \App\Models\StudentRequest::where('status', 'pending')->exists();
        // $hasPendingRequests = StudentRequest::where('status', 'pending')->exists();
        return view('admin.student.index', [
            'students' => $students,
            'studentRequests' => $studentRequests,
            'hasPendingRequests' => $hasPendingRequests
        ]);
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
        $users = User::where('id', $student->users_id)->first();
        $users->update($request->all());
        
        return redirect()->back()->with('success', 'Data guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student,)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Data student berhasil dihapus');
    }

    public function import(ImportStudentRequest $request)
    {
        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data student berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
}
