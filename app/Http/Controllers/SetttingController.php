<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Dudi;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SetttingController extends Controller
{
    public function index()
    {
        $students = Student::where('users_id' , auth()->user()->id)->first();
        $teacher = Teacher::all();
        $dudi = Dudi::all();
        return view('student.settings.index' , compact('students' , 'teacher' , 'dudi'));
    }

    public function update(UpdateSettingRequest $request, Student $student)
    {
        $student->update($request->all());

        $journals = Journal::where('users_id', auth()->user()->id)->get();
        foreach ($journals as $journal) {
            $journal->update([
                'teachers_id' => $request->teachers_id
            ]);
        }

        return redirect()->route('setting.index')->with('success', 'Data berhasil diubah');
    }
}
