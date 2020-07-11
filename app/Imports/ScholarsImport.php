<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Scholar;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class ScholarsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithValidation
{
    private $level;

    public function __construct($level)
    {
        $this->level = $level;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $int_id = $row['INT_ID'] ?? $row['int_id'] ?? null;
        $nom_bec = $row['NOM_BEC'] ?? $row['nom_bec'] ?? null;
        $ap1 = $row['AP1'] ?? $row['ap1'] ?? null;
        $ap2 = $row['AP2'] ?? $row['ap2'] ?? null;
        $genero = $row['GENERO'] ?? $row['genero'] ?? null;
        $fec_nac = $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'] ?? null;
        $curp = $row['CURP'] ?? $row['curp'] ?? null;

        if ($int_id == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna int_id ó INT_ID que hace referencia a las claves de los becarios e intente nuevamente');
        }

        if ($nom_bec == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna nom_bec ó NOM_BEC que hace referencia a los nombres de los becarios e intente nuevamente');
        }

        if ($ap1 == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap1 ó AP1 que hace referencia a los apellidos paternos de los becarios e intente nuevamente');
        }

        if ($ap2 == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap2 ó AP2 que hace referencia a los apellidos maternos de los becarios e intente nuevamente');
        }

        if ($genero == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna ap2 ó AP2 que hace referencia a los generos de los becarios e intente nuevamente');
        }

        if ($fec_nac == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna fec_nac ó FEC_NAC que hace referencia a las fechas de macimiento de los becarios e intente nuevamente');
        }

        if ($curp == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna curp ó CURP que hace referencia a las curps de los becarios e intente nuevamente');
        }


        Scholar::firstOrCreate(
            ['id' => $row['INT_ID'] ?? $row['int_id']],
            [
                'nameScholar' => $row['NOM_BEC'] ?? $row['nom_bec'] ,
                'firstSurname' => $row['AP1'] ?? $row['ap1'],
                'secondSurname' => $row['AP2'] ?? $row['ap2'],
                'gender' => $row['GENERO'] ?? $row['genero'],
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'],
                'curp' =>  $row['CURP'] ?? $row['curp'],
                'level' =>  $this->level,
            ]
        );
    }

    public function rules(): array
    {
        return [
             'nom_bec' => function($attribute, $value, $onFailure) {
                  if ($value == '') {
                       $value = null;
                  }
              },
              'ap1' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'ap2' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'genero' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'fec_nac' => function($attribute, $value, $onFailure) {
                if ($value == [0-9] || $value == "") {
                     $value = null;
                }
            },
            'curp' => function($attribute, $value, $onFailure) {
                if ($value == "") {
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
