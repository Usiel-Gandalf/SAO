<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\School;
use Exception;
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
        $cve_esc = $row['CVE_ESC'] ?? $row['cve_esc'] ?? null;
        $nom_esc = $row['NOM_ESC'] ?? $row['nom_esc'] ?? null;
        $claveofi = $row['CLAVEOFI'] ?? $row['claveofi'] ?? null;

        if ($cve_esc == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_esc ó CVE_ESC que hace referencia a las claves de las escuelas e intente nuevamente');
        }

        if ($nom_esc == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_esc ó NOM_ESC que hace referencia a los nombres de las escuelas e intente nuevamente');
        }

        if ($claveofi == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna claveofi ó CLAVEOFI que hace referencia a las claves de las localidades a las que pertenecen las escuelas e intente nuevamente');
        }

        School::firstOrCreate(
            ['id' => $row['CVE_ESC'] ?? $row['cve_esc']],
            [
                'nameSchool' => $row['NOM_ESC'] ?? $row['nom_esc'],
                'locality_id' =>  $row['CLAVEOFI'] ?? $row['claveofi'],
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
