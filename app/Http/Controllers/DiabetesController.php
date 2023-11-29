<?php

namespace App\Http\Controllers;

use App\Imports\DiabetesImport;
use App\Models\Diabetes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;



class DiabetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $diabetesData = Diabetes::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();


        return view('diabetes.index', compact('diabetesData'));
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

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    $file = $request->file('file');
    $user = auth()->user(); // Obtenha o usuário autenticado

    // Use a instância do importador para processar o arquivo Excel
    $import = new DiabetesImport($user);
    Excel::import($import, $file);

    return redirect()->back()->with('success', 'Dados importados com sucesso!');
}
}
