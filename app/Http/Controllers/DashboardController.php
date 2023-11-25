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
        $measurements = Diabetes::where('user_id', $user->id)->get();

        $startDate = $measurements->min('created_at');
        $endDate = $measurements->max('created_at');

        $labels = [];
        $values = [];

        $currentDate = Carbon::parse($startDate);

        while ($currentDate->lte(Carbon::parse($endDate))) {
            $labels[] = $currentDate->format('Y-m-d');
            $values[] = $measurements->where('created_at', '>=', $currentDate)->where('created_at', '<', $currentDate->copy()->addDay())->avg('glucose_level') ?? 0;
            $currentDate->addDay();
        }

        return view('dashboard.index', compact('user', 'labels', 'values'));
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
