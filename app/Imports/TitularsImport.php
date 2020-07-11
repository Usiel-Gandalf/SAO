<?php

namespace App\Imports;

ini_set('max_execution_time', 9600);

use App\Titular;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class TitularsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fam_id = $row['FAM_ID'] ?? $row['fam_id'] ?? null;
        $nom_tit = $row['NOM_TIT'] ?? $row['nom_tit'] ?? null;
        $ap1 = $row['AP1'] ?? $row['ap1'] ?? null;
        $ap2 = $row['AP2'] ?? $row['ap2'] ?? null;
        $genero = $row['GENERO'] ?? $row['genero'] ?? null;
        $fec_nac = $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'] ?? null;
        $curp = $row['CURP'] ?? $row['curp'] ?? null;

        if ($fam_id == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna fam_id ó FAM_ID que hace referencia a las claves de las titulares e intente nuevamente');
        }

        if ($nom_tit == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_tit ó NOM_TIT que hace referencia a los nombres de las titulares e intente nuevamente');
        }

        if ($ap1 == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap1 ó AP1 que hace referencia a los apellidos paternos de las titulares e intente nuevamente');
        }

        if ($ap2 == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap2 ó AP2 que hace referencia a los apellidos maternos de las titulares e intente nuevamente');
        }

        if ($genero == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap2 ó AP2 que hace referencia a los generos de las titulares e intente nuevamente');
        }

        if ($fec_nac == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna fec_nac ó FEC_NAC que hace referencia a las fechas de macimiento de las titulares e intente nuevamente');
        }

        if ($curp == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna curp ó CURP que hace referencia a las curps de las titulares e intente nuevamente');
        }

        Titular::firstOrCreate(
            ['id' => $row['FAM_ID'] ?? $row['fam_id']],
            [
                'nameTitular' => $row['NOM_TIT'] ?? $row['nom_tit'],
                'firstSurname' => $row['AP1'] ?? $row['ap1'],
                'secondSurname' => $row['AP2'] ?? $row['ap2'],
                'gender' => $row['GENERO'] ?? $row['genero'],
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'],
                'curp' =>  $row['CURP'] ?? $row['curp'],
            ]
        );
    }

    public function rules(): array
    {
        return [
            'nom_tit' => function ($attribute, $value, $onFailure) {
                if ($value == '' || !isset($attribute)) {
                    $value = null;
                }
            },
            'ap1' => function ($attribute, $value, $onFailure) {
                if ($value == '' || !isset($attribute)) {
                    $value = null;
                }
            },
            'ap2' => function ($attribute, $value, $onFailure) {
                if ($value == '' || !isset($attribute)) {
                    $value = null;
                }
            },
            'genero' => function ($attribute, $value, $onFailure) {
                if ($value == '' || !isset($attribute)) {
                    $value = null;
                }
            },
            'fec_nac' => function ($attribute, $value, $onFailure) {
                if ($value == [0 - 9] || $value == "" || !isset($attribute)) {
                    $value = null;
                }
            },
            'curp' => function ($attribute, $value, $onFailure) {
                if ($value == "" || !isset($attribute)) {
                    $value = null;
                }
            },
        ];
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
