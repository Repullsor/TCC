<?php

namespace App\Imports;

use App\Models\Diabetes;
use Illuminate\Contracts\Auth\Authenticatable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DiabetesImport implements ToModel, WithHeadingRow
{
    protected $userId;

    public function __construct(Authenticatable $user)
    {
        $this->userId = $user->id;
    }

    public function model(array $row)
    {
        if (!empty($row['glucose_level']) && $this->userId) {
            
            if(is_numeric($row['measurement_date'])) {
                $measurementDate = Date::excelToDateTimeObject($row['measurement_date'])->format('Y-m-d');
                $measurementTime = Date::excelToDateTimeObject($row['measurement_time'])->format('h:i:s');

                // $data = "$measurementDate $measurementTime";
            }

            $classification = $this->classifyGlucoseLevel($row['glucose_level']);

            return new Diabetes([
                'device_id' => 2,
                'user_id' => $this->userId,
                'glucose_level' => $row['glucose_level'],
                'classification' => $classification,
                'measurement_date' => $measurementDate,
                'measurement_time' => $measurementTime
            ]);
        }

        return null;
    }

    protected function classifyGlucoseLevel($glucoseLevel)
    {
        if ($glucoseLevel < 70) {
            return 'Baixa';
        } elseif ($glucoseLevel >= 70 && $glucoseLevel <= 180) {
            return 'Normal';
        } else {
            return 'Alta';
        }
    }
}
