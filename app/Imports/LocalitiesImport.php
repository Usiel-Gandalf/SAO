<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Locality;
use App\Municipality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Exception;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class LocalitiesImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if (Municipality::where('id', '=', $row['cve_mun'])->exists()) {
            Locality::firstOrCreate(
                ['id' => $row['CLAVEOFI'] ?? $row['claveofi']],
                [
                    'keyLocality' => $row['CVE_LOC'] ?? $row['cve_loc'],
                    'nameLocality' => $row['NOM_LOC'] ?? $row['nom_loc'],
                    'municipality_id' =>  $row['CVE_MUN'] ?? $row['cve_mun'],
                ]
            );
        }else{
            Locality::firstOrCreate(
                ['id' => $row['CLAVEOFI'] ?? $row['claveofi']],
                [
                    'keyLocality' => $row['CVE_LOC'] ?? $row['cve_loc'],
                    'nameLocality' => $row['NOM_LOC'] ?? $row['nom_loc'],
                    'municipality_id' =>  null,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.claveofi' => 'required|integer|unique:localities,id',
            '*.cve_mun' => 'required|integer',
            '*.cve_loc' => 'required|integer',
            '*.nom_loc' => 'required|string',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
