<?php

namespace App\Imports;
ini_set('max_execution_time', 9600);

use App\Titular;
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
        $Titular = Titular::where('idTitular', $row['fam_id'])->exists();
        if ($Titular === false) {
            return new Titular([
                'idTitular' => $id = $row['FAM_ID'] ?? $row['fam_id'],
                'nameTitular' => $nameTitular = $row['NOM_TIT'] ?? $row['nom_tit'] ?? $row['NOM_BEC'] ?? $row['nom_bec']  ?? null,
                'firstSurname' => $firstSurname = $row['AP1'] ?? $row['ap1'] ?? $row['APE1_BEC'] ?? $row['ape1_bec'] ?? null,
                'secondSurname' => $secondSurname = $row['AP2'] ?? $row['ap2'] ?? $row['APE2_BEC'] ?? $row['ape2_bec'] ?? null,
                'gender' => $gender = $row['GENERO'] ?? $row['genero'] ?? null,
                'birthDate' => $birthDate = $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'] ?? null,
                'curp' =>  $curp = $row['CURP'] ?? $row['curp'] ?? null,
            ]);
            Titular::connection()->disableQueryLog();
            print_r('no existe');
        }
    }

    public function rules(): array
    {
        return [
            'int_id' => function ($attribute, $value, $onFailure) {
                if ($value == '' || !isset($attribute)) {
                    $value = null;
                }
            },
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

    public function batchSize(): int
    {
        return 900;
    }

    public function chunkSize(): int
    {
        return 900;
    }
}
