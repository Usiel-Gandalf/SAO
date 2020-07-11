<?php

namespace App\Imports;

use App\Municipality;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MunicipalitiesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $cve_mun = $row['cve_mun'] ?? $row['CVE_MUN'] ?? null;
        $nom_mun = $row['nom_mun'] ?? $row['NOM_MUN'] ?? null;
        $cve_reg = $row['cve_reg'] ?? $row['CVE_REG'] ?? null;

        if ($cve_mun == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_mun ó CVE_MUN que hace referencia a las claves de los municipios e intente nuevamente');
        }

        if ($nom_mun == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_mun ó NOM_MUN que hace referencia a los nombres de los municipios e intente nuevamente');
        }

        if ($cve_reg == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_reg ó CVE_REG que hace referencia a las claves
             de las regiones a las que pertenecen los municipios e intente nuevamente');
        }

        Municipality::firstOrCreate(
            ['id' => $row['cve_mun'] ?? $row['CVE_MUN']],
            [
                'nameMunicipality' => $row['nom_mun'] ?? $row['NOM_MUN'],
                'region_id' =>  $row['cve_reg'] ?? $row['CVE_REG'],
            ]
        );
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
