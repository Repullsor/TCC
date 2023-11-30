<?php

namespace App\Imports;

use App\Models\BloodPressure;
use Illuminate\Contracts\Auth\Authenticatable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BloodPressureImport implements ToModel, WithHeadingRow
{
    protected $userId;

    public function __construct(Authenticatable $user)
    {
        $this->userId = $user->id;
    }

    public function model(array $row)
    {
        if (!empty($row['systolic']) && !empty($row['diastolic']) && $this->userId) {

            if (is_numeric($row['measurement_date'])) {
                $measurementDate = Date::excelToDateTimeObject($row['measurement_date'])->format('Y-m-d');
                $measurementTime = Date::excelToDateTimeObject($row['measurement_time'])->format('h:i:s');
            }

            $classification = $this->classifyBloodPressure($row['systolic'], $row['diastolic']);

            return new BloodPressure([
                'device_id' => 1,
                'user_id' => $this->userId,
                'systolic' => $row['systolic'],
                'diastolic' => $row['diastolic'],
                'classification' => $classification,
                'measurement_date' => $measurementDate,
                'measurement_time' => $measurementTime,
            ]);
        }

        return null;
    }

    protected function classifyBloodPressure($systolic, $diastolic)
    {
        if ($systolic < 90 && $diastolic < 60) {
            return 'Baixa';
        } elseif (($systolic >= 90 && $systolic <= 120) && ($diastolic >= 60 && $diastolic <= 80)) {
            return 'Normal';
        } else {
            return 'Alta';
        }
    }
}
