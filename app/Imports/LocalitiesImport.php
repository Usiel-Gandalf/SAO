<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Locality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class LocalitiesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Locality::firstOrCreate(
            ['id' => $row['CLAVEOFI'] ?? $row['claveofi']],
            [
                'keyLocality' => $row['CVE_LOC'] ?? $row['cve_loc'] ?? null,
                'nameLocality' => $row['NOM_LOC'] ?? $row['nom_loc'] ?? null,
                'municipality_id' =>  $row['CVE_MUN'] ?? $row['cve_mun'] ?? null,
            ]
        );
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
