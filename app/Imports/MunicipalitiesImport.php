<?php

namespace App\Imports;

use App\Municipality;
use App\Region;
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


class MunicipalitiesImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (Region::where('id', '=', $row['cve_reg'])->exists()) {
        Municipality::firstOrCreate(
            ['id' => $row['cve_mun'] ?? $row['CVE_MUN']],
            [
                'nameMunicipality' => $row['nom_mun'] ?? $row['NOM_MUN'],
                'region_id' =>  $row['cve_reg'] ?? $row['CVE_REG'],
            ]
        );
        }else {
            Municipality::firstOrCreate(
                ['id' => $row['cve_mun'] ?? $row['CVE_MUN']],
                [
                    'nameMunicipality' => $row['nom_mun'] ?? $row['NOM_MUN'],
                    'region_id' =>  null,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.cve_mun' => 'required|integer|unique:municipalities,id',
            '*.nom_mun' => 'required|string',
            '*.cve_reg' => 'required|integer',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 900;
    }

    public function chunkSize(): int
    {
        return 900;
    }
}
