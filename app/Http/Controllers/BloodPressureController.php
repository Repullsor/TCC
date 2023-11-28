<?php

namespace App\Http\Controllers;

use App\Imports\DiabetesImport;
use App\Models\BloodPressure;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BloodPressureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $bloodPressureData = BloodPressure::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('pressure.index', compact('user', 'bloodPressureData'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
