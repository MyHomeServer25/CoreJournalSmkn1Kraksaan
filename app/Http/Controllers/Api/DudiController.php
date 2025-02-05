<?php

namespace App\Http\Controllers\Api;

use App\Models\Dudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDudiRequest;
use App\Http\Requests\UpdateDudiRequest;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dudis = Dudi::all();
        return response()->json([
          'status' => true,
          'message' => 'Data dudi berhasil diambil',
          'data' => $dudis
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
    public function store(StoreDudiRequest $request)
    { 
      $dudi = Dudi::create($request->all());
        return response()->json([
          'status' => true,
          'message' => 'Data berhasil ditambahkan',
          'data' => $dudi
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dudi $dudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dudi $dudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDudiRequest $request, Dudi $dudi)
    {
        $dudi->update($request->all());
        return response()->json([
          'status' => true,
          'message' => 'Data berhasil diubah',
          'data' => $dudi
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dudi $dudi, Request $request)
    {
        $dudi->delete();
        return response()->json([
           'status' => true,
           'message' => 'Data berhasil dihapus',
            'data' => $dudi
        ], 200);
    }
}
