<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Region;
use Exception;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class RegionsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $cve_reg = $row['cve_reg'] ?? $row['CVE_REG'] ?? null;
        $nom_reg = $row['nom_reg'] ?? $row['NOM_REG'] ?? null;
        $region = $row['region'] ?? $row['REGION'] ?? null;

        if ($cve_reg == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna cve_reg ó CVE_REG que hace referencia a las claves de las regiones e intente nuevamente');
        }

        if ($nom_reg == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_reg ó NOM_REG que hace referencia a los nombres de las regiones e intente nuevamente');
        }

        if ($region == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna region ó REGION que hace referencia al numero de las regiones e intente nuevamente');
        }

        Region::firstOrCreate(
            ['id' => $row['CVE_REG'] ?? $row['cve_reg']],
            [
                'nameRegion' => $row['NOM_REG'] ?? $row['nom_reg'],
                'region' => $row['REGION'] ?? $row['region'],
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
