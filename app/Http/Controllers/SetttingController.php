<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\StudentRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\ApprovalSettingRequest;

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

    public function studentRequest(Student $student)
    {
        $studentRequests = StudentRequest::with(['student', 'teacher', 'dudi'])->where('status', 'pending')->first();
            
        return view('admin.student.index', compact('studentRequests'));
    }

    public function approve(ApprovalSettingRequest $request, StudentRequest $studentRequest, $id)
    {
        // dd($studentRequest);
        $studentRequest = StudentRequest::findOrFail($id);
        if (!$studentRequest->student) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }
    
        $validatedData = $request->validated();
        
        if ($request->status === 'approved') {
            // Update student data
            $studentRequest->student->update([
                'teachers_id' => $studentRequest->teacher_id,
                'dudis_id' => $studentRequest->dudi_id,
                'status' => 'approved',
                'reject_reason' => null
            ]);
    
            // Update related journals if they exist
            Journal::where('users_id', $studentRequest->student->users_id)
                ->update(['teachers_id' => $studentRequest->teacher_id]);
    
            // Delete the request since it's approved
            $studentRequest->delete();
    
            // return redirect()->back()->with('success', 'Permintaan berhasil disetujui.');
            return redirect()->back()->with('success', 'Persetujuan berhasil di kirim.');
        } 
        elseif ($request->status === 'rejected') {
            // Update student with rejection
            $studentRequest->student->update([
                'status' => 'rejected',
                'reject_reason' => $validatedData['reason']
            ]);
            
            // Delete the request
            $studentRequest->delete();
        
            // return redirect()->back()->with('error', 'Permintaan ditolak dengan alasan: ' . $validatedData['reason']);
            return redirect()->back()->with('success', 'Persetujuan berhasil di kirim.');
        }
    
        return redirect()->back()->with('error', 'Status tidak valid.');
    }
}
