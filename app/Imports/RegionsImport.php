<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Region::firstOrCreate(
            ['id' => $row['CVE_REG'] ?? $row['cve_reg']],
            ['nameRegion' => $row['NOM_REG'] ?? $row['nom_reg'] ?? null,
             'region' => $row['REGION'] ?? $row['region'] ?? null,
            ]
        );
    }
}
