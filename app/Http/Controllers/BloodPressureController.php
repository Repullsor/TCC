<?php

namespace App\Http\Controllers;

use App\Imports\BloodPressureImport;
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

        // Formatar a data antes de enviar para a view
        $formattedbloodPressureData = $bloodPressureData->map(function ($data) {
            $data->measurement_date = \Carbon\Carbon::parse($data->measurement_date)->format('d/m/Y');
            return $data;
        });

        return view('pressure.index', compact('formattedbloodPressureData'));
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
    public function destroy(BloodPressure $bloodPressure)
    {
        // Verifique se o usuário autenticado é o proprietário do registro
        if (auth()->user()->id == $bloodPressure->user_id) {
            $bloodPressure->delete();

            return redirect()->route('blood-pressure.index')->with('success', 'Registro excluído com sucesso.');
        } else {
            return redirect()->route('blood-pressure.index')->with('error', 'Você não tem permissão para excluir este registro.');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');
        $user = auth()->user(); // Obtenha o usuário autenticado

        // Use a instância do importador para processar o arquivo Excel
        $import = new BloodPressureImport($user);
        Excel::import($import, $file);

        return redirect()->back()->with('success', 'Dados importados com sucesso!');
    }
}
