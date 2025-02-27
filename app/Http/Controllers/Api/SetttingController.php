<?php

namespace App\Http\Controllers\Api;

use App\Models\Dudi;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\StudentRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\ApprovalSettingRequest;

class SetttingController extends Controller
{
    public function index()
    {
        $students = Student::where('users_id' , auth()->user()->id)->first();
        $teacher = Teacher::all();
        $dudi = Dudi::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Ditampilkan',
            'data' => [
              'students' => $students,
              'teacher' => $teacher,
              'dudi' => $dudi,
            ]
        ], 200);
    }

    public function getStatus()
    {
        try {
            // Ambil data student berdasarkan user yang sedang login
            $student = Student::where('users_id', auth()->user()->id)->first();
            // dd($student->id);

            // Jika student tidak ditemukan, kirim response error
            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Student tidak ditemukan',
                ], 404);
            }

            // Debugging: Cetak student ID
            Log::info('Student ID: ' . $student->id);

            // Ambil data studentRequest berdasarkan student_id
            $studentRequests = StudentRequest::where('student_id', $student->id)->get();
            // dd($studentRequests);

            // Debugging: Jika kosong, log pesan
            if ($studentRequests->isEmpty()) {
                Log::info('StudentRequest tidak ditemukan untuk student_id: ' . $student->id);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Ditampilkan',
                'studentRequests' => $studentRequests
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateSettingRequest $request, Student $student, StudentRequest $StudentRequest)
    {
        $studentRequest = StudentRequest::updateOrCreate(
            ['student_id' => $student->id],
            [
                'teacher_id' => $request->teachers_id,
                'dudi_id' => $request->dudis_id,
                'status' => 'pending',
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Diperbarui',
            'data' => $studentRequest,
        ], 201);
    }

    public function approve(ApprovalSettingRequest $request, StudentRequest $StudentRequest)
    {
        $validatedData = $request->validated();
        // Validasi data student dari relasi
        $student = $StudentRequest->student;

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student tidak ditemukan untuk request ini.',
            ], 404);
        }

        if ($request->status === 'approved') {
            // Update data siswa di tabel student
            $StudentRequest->status = 'approved';
            $student->update([
                'teachers_id' => $StudentRequest->teacher_id,
                'dudis_id' => $StudentRequest->dudi_id,
                'status' => 'approved',
                'reject_reason' => null
            ]);

            // Perbarui tabel jurnal jika diperlukan
            $journals = Journal::where('users_id', $student->users_id)->get();
            foreach ($journals as $journal) {
                $journal->update([
                    'teachers_id' => $StudentRequest->teacher_id,
                ]);
            }

            // Hapus data dari tabel student_requests
            $StudentRequest->delete();

            $message = 'Permintaan berhasil disetujui.';
        } elseif ($request->status === 'rejected') {
            $student->update([
                'status' => 'rejected',
                'reject_reason' => $validatedData['reason']
            ]);
            // Hapus data jika status ditolak
            $StudentRequest->delete();
    
            $message = 'Permintaan ditolak dengan alasan: ' . $validatedData['reason'];
        } else {
            $message = 'Status tidak valid.';
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $student
        ], 200);
    }
}
