<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Locality;
use Exception;
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
        $claveofi = $row['claveofi'] ?? $row['CLAVEOFI'] ?? null;
        $cve_loc= $row['cve_loc'] ?? $row['CVE_LOC'] ?? null;
        $nom_loc= $row['nom_loc'] ?? $row['NOM_LOC'] ?? null;
        $cve_mun= $row['cve_mun'] ?? $row['CVE_MUN'] ?? null;

        if ($claveofi == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna claveofi ó CLAVEOFI que hace referencia a las claves de las localidades e intente nuevamente');
        }

        if ($cve_loc == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_loc ó CVE_LOC que hace referencia a los numeros de las localidades en su municipio e intente nuevamente');
        }

        if ($nom_loc == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_loc ó NOM_LOC que hace referencia a los nombres de las localidades e intente nuevamente');
        }

        if ($cve_mun == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_mun ó CVE_MUN que hace referencia a las claves de los municipios a las que pertenecen las localidades e intente nuevamente');
        }

        Locality::firstOrCreate(
            ['id' => $row['CLAVEOFI'] ?? $row['claveofi']],
            [
                'keyLocality' => $row['CVE_LOC'] ?? $row['cve_loc'],
                'nameLocality' => $row['NOM_LOC'] ?? $row['nom_loc'],
                'municipality_id' =>  $row['CVE_MUN'] ?? $row['cve_mun'],
            ]
        );
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
