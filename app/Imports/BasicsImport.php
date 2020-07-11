<?php

namespace App\Imports;

ini_set('max_execution_time', 4800);

use App\Basic;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class BasicsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithValidation
{
    private $type;
    private $status;
    private $bimester;
    private $year;

    public function __construct($type, $status, $bimester, $year)
    {
        $this->type = $type;
        $this->status = $status;
        $this->bimester = $bimester;
        $this->year = $year;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fol_form = $row['FOL_FORM'] ?? $row['fol_form'] ?? $row['FOLIO_FORM'] ?? $row['folio_form'] ?? null;
        $fam_id = $row['FAM_ID'] ?? $row['fam_id'] ?? null;
        $claveofi = $row['CLAVEOFI'] ?? $row['claveofi'] ?? null;
        $remesa = $row['REMESA'] ?? $row['remesa'] ?? null;

        if ($fol_form == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna fol_form ó FOL_FORM que hace referencia al folio de formato de las titulares e intente nuevamente');
        }

        if ($fam_id == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna fam_id ó FAM_ID que hace referencia a las claves de las titulares e intente nuevamente');
        }

        if ($claveofi == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna claveofi ó CLAVEOFI que hace referencia a las claves de las localidades donde se entrega el aviso o cerm e intente nuevamente');
        }

        if ($remesa == null) {
            throw new Exception('Falta columna: Verifique que su archivo contenga la columna remesa ó REMESA que hace referencia a el aviso o cerm e intente nuevamente');
        }

        if ($this->status == 0) {
            Basic::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form'] ?? $row['FOLIO_FORM'] ?? $row['folio_form']],
                [
                    'titular_id' => $row['FAM_ID'] ?? $row['fam_id'],
                    'locality_id' => $row['CLAVEOFI'] ?? $row['claveofi'],
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'],
                    'bimester' =>  $this->bimester,
                    'year' =>  $this->year,
                    'status' =>  $this->status,
                    'type' =>  $this->type,
                ]
            );
        } else {
            Basic::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
                ->where('titular_id', $row['FAM_ID'] ?? $row['fam_id'])
                ->where('consignment', $row['REMESA'] ?? $row['remesa'])
                ->update(['status' => $this->status]);
        }
    }

    public function rules(): array
    {
        return [
            'titular_id' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'locality_id' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'consignment' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'fol_form' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'bimester' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'year' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'status' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'type' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
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
