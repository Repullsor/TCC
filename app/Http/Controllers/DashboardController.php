<?php

namespace App\Http\Controllers;

use App\Models\Diabetes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $glucoseData = $this->getGlucoseDataForUser($user->id);

        $labels = $glucoseData->pluck('measurement_date');
        $values = $glucoseData->pluck('glucose_level');

        // Passando os dados para a visualização
        return view('dashboard.index', compact('user', 'labels', 'values', 'glucoseData'));
    }

    private function getGlucoseDataForUser($userId)
    {
        return Diabetes::where('user_id', $userId)->get();
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
