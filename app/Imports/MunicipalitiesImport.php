<?php

namespace App\Imports;

use App\Municipality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MunicipalitiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Municipality::firstOrCreate(
            ['id' => $row['cve_mun'] ?? $row['CVE_MUN']],
            [
                'nameMunicipality' => $row['nom_mun'] ?? $row['NOM_MUN'] ?? null,
                'region_id' =>  $row['cve_region'] ?? $row['CVE_REGION'] ?? null,
            ]
        );
    }
}
