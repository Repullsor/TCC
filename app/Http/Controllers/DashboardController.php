<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
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
        $bloodPressureData = $this->getBloodPressureDataForUser($user->id);

        // Ordenando os dados por data para garantir a consistência
        $glucoseData = $glucoseData->sortBy('measurement_date');
        $bloodPressureData = $bloodPressureData->sortBy('measurement_date');

        // Obtendo os rótulos e valores para glicose
        $glucoseLabels = $glucoseData->pluck('measurement_date');
        $glucoseValues = $glucoseData->pluck('glucose_level');

        // Obtendo os rótulos e valores para pressão arterial
        $systolicValues = $bloodPressureData->pluck('systolic');
        $diastolicValues = $bloodPressureData->pluck('diastolic');
        $bloodPressureLabels = $bloodPressureData->pluck('measurement_date');

        // Calculando as cores para o gráfico de glicose
        $pointBorderColors = [];
        foreach ($glucoseValues as $glucoseLevel) {
            if ($glucoseLevel > 150) {
                $pointBorderColors[] = 'red'; // Cor do contorno para medição alta
            } elseif ($glucoseLevel < 80) {
                $pointBorderColors[] = 'blue'; // Cor do contorno para medição baixa
            } else {
                $pointBorderColors[] = 'rgba(75, 192, 192, 1)'; // Cor padrão
            }
        }



        // Passando os dados para a visualização
        return view('dashboard.index', compact('user', 'glucoseLabels', 'glucoseValues', 'systolicValues', 'diastolicValues', 'bloodPressureLabels', 'pointBorderColors'));
    }

    private function getGlucoseDataForUser($userId)
    {
        return Diabetes::where('user_id', $userId)->get();
    }

    private function getBloodPressureDataForUser($userId)
    {
        return BloodPressure::where('user_id', $userId)->get();
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
