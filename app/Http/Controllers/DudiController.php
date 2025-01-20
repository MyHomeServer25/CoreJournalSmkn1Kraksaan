<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Http\Requests\StoreDudiRequest;
use App\Http\Requests\UpdateDudiRequest;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dudis = Dudi::all();
        return view('admin.dudi.index', compact('dudis'));
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
        Dudi::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
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
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dudi $dudi)
    {
        $dudi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
