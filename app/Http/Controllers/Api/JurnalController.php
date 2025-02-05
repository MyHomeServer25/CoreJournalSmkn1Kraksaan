<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Dudi;

use App\Models\Journal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\JurnalResource;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\UpdateJournalRequest;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Journal = Journal::where('users_id', Auth::id())->latest()->paginate(10);
        return response()->json([
            'status' => true,
            'message' => "data berhasil di ambil",
            'data' => $Journal        
        ], 200);
    }

    public function monitoring(Request $request)
    {
        $journals = Journal::latest()->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'data jurnal berhasil di tampilkan',
            'data' => $journals
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJournalRequest $request)
    {
        $students = Student::where('users_id' , auth()->user()->id)->first();
        $Journal = Journal::create([
            'teachers_id' => $students->teachers_id,
            'users_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date
        ]);
        
        return response()->json([
            'status' => true,
            'message' => "data berhasil di tambahkan",
            'data' => $Journal
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalRequest $request, Journal $journal)
    {
        $today = now()->format('Y-m-d');
        $journalDate = Carbon::parse($journal->date)->format('Y-m-d');
    
        if ($today !== $journalDate) {
            return response()->json([
                'status' => false,
                'message' => 'Update jurnal hanya dapat dilakukan pada tanggal saat jurnal di buat'
            ], 400);
        }
        try {
            $journal->update([
                'users_id' => auth()->user()->id,
                'name' => $request->name,
                'description' => $request->description,
                // 'date' => $request->date
            ]);

            return response()->json ([
                'status' => true,
                'message' => 'Data berhasil di perbarui',
                'data' => $journal
            ], 201);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'error' => 'Anda sudah mengisi jurnal di tanggal tersebut'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal)
    {
        $journal->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $journal
        ], 200);
    }

    /**
     * Data Journal export to Word
     */
    public function exportPDF(Request $request)
    {
        $journals = Journal::where('users_id', Auth::id())->latest()->get();
        $student = Student::where('users_id', Auth::id())->first();

        $teacherName = $student->teacher ? $student->teacher->name : 'Tidak Diketahui';
        $dudiName = $student->dudi ? $student->dudi->name : 'Tidak Diketahui';

        $data = [
            'journals' => $journals,
            'teacherName' => $teacherName,
            'dudiName' => $dudiName
        ];

        $pdf = PDF::loadView('exports.journal_pdf', $data);
        return $pdf->download('Jurnal Pkl.pdf');
    }
};