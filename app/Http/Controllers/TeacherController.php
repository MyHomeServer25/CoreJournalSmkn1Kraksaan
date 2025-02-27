<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Journal;
use App\Models\Student;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $teachers = Teacher::latest()->paginate(10);
            $guru = Teacher::all();
            return view('admin.teacher.index', compact('teachers', 'guru'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menampilkan data guru');
        }
    }

    // public function showall()
    // {
    //     $guru = Teacher::all();
    //     return view('admin.teacher.index', compact('guru'));
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
    public function store(StoreTeacherRequest $request)
    {
        try {
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

            return redirect()->route('teacher.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data guru, periksa kembali halaman create');
        }
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
        try {
            $teacher->update($request->all());
            $users = User::where('id', $teacher->users_id)->first();
            $users->update($request->all());
            
            return redirect()->route('teacher.index')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data guru, periksa kembali halaman update');
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return redirect()->route('teacher.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data guru');
        }
    }

    public function mentor()
    {
        return view('teacher.index');
    }

    public function journal()
    {
        $teachers = Teacher::where('users_id' , auth()->user()->id)->first();
        $journals = Journal::where('teachers_id', $teachers->id)->get();
        return view('teacher.journal.index' , compact('teachers' ,'journals'));
    }

    public function student()
    {
        $teachers = Teacher::where('users_id' , auth()->user()->id)->first();
        $students = Student::where('teachers_id', $teachers->id)->get();
        return view('teacher.student.index' , compact('teachers','students'));
    }

    public function detailStudent (Student $student)
    {
        $journals = Journal::where('users_id' , $student->users_id)->get();
        return view('teacher.student.detail' , compact('student' , 'journals'));
    }
}
