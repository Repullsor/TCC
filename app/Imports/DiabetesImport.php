<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Diabetes;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;


class DiabetesImport implements ToModel, WithStartRow
{
    use Importable;

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Pule a primeira linha (cabeçalho)
    }

    public function model(array $row)
    {
        // Certifique-se de que o array $row possui pelo menos 2 elementos (created_at, glucose_level)
        if (count($row) >= 2) {
            // Verifique se glucose_level é null e, se for, defina um valor padrão ou ignore o registro
            if ($row[1] === null) {
                Log::warning('O valor de glucose_level é nulo. Ignorando este registro.');
                return null;
            }

            return new Diabetes([
                'device_id' => 1, // Substitua isso pelo ID do dispositivo correto
                'user_id' => auth()->id(), // Se desejar associar o registro ao usuário autenticado
                'glucose_level' => $row[1],
                'created_at' => Carbon::parse($row[0]), // Converta a string para um objeto Carbon
            ]);
        } else {
            // Trate o caso em que o array $row não possui as chaves esperadas
            // Isso pode incluir o log de um erro ou outro tratamento adequado
            Log::error('Número insuficiente de elementos no array $row durante a importação.');
            return null;
        }
    }
}

