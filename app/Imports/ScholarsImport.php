<?php

namespace App\Imports;

ini_set('max_execution_time', 15000);

use App\Scholar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class ScholarsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $level;
    
    public function __construct($level)
    {
        $this->level = $level;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Scholar::firstOrCreate(
            ['id' => $row['INT_ID'] ?? $row['int_id']],
            [
                'nameScholar' => $row['NOM_BEC'] ?? $row['nom_bec'],
                'firstSurname' => $row['AP1'] ?? $row['ap1'],
                'secondSurname' => $row['AP2'] ?? $row['ap2'],
                'gender' => $row['GENERO'] ?? $row['genero'],
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'],
                'curp' =>  $row['CURP'] ?? $row['curp'],
                'level' =>  $this->level,
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.int_id' => 'required|integer|unique:scholars,id',
            'nom_bec' => 'required|string',
            'ap1' => 'required|string',
            'ap2' => 'required|string',
            'genero' => 'required|string',
            'fec_nac' => 'required|integer',
            'curp' => 'required|string',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 700;
    }

    public function chunkSize(): int
    {
        return 700;
    }
}
