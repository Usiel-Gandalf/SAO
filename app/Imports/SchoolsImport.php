<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class SchoolsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        School::firstOrCreate(
            ['id' => $row['CVE_ESC'] ?? $row['cve_esc']],
            [
                'nameSchool' => $row['NOM_ESC'] ?? $row['nom_esc'] ?? null,
                'locality_id' =>  $row['CLAVEOFI'] ?? $row['claveofi'] ?? null,
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
