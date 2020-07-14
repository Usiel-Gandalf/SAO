<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Locality;
use App\School;
use Exception;
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

class SchoolsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (Locality::where('id', '=', $row['claveofi'])->exists()) {
            School::firstOrCreate(
                ['id' => $row['CVE_ESC'] ?? $row['cve_esc']],
                [
                    'nameSchool' => $row['NOM_ESC'] ?? $row['nom_esc'],
                    'locality_id' =>  $row['CLAVEOFI'] ?? $row['claveofi'],
                ]
            );
        }else{
            School::firstOrCreate(
                ['id' => $row['CVE_ESC'] ?? $row['cve_esc']],
                [
                    'nameSchool' => $row['NOM_ESC'] ?? $row['nom_esc'],
                    'locality_id' => null,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.cve_esc' => 'required|string|unique:schools,id',
            '*.nom_esc' => 'required|string',
            '*.claveofi' => 'required|integer',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
