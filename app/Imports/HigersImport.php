<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Higer;
use App\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class HigersImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    private $status;
    private $bimester;
    private $year;

    public function __construct($bimester, $status, $year)
    {
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
        if (School::where('id', '=', $row['cve_esc'])->exists()) {
            Higer::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'] ?? $row['INTID'] ?? $row['intid'],
                    'school_id' => $row['CVE_ESC'] ?? $row['cve_esc'],
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                    'bimester' =>  $this->bimester,
                    'year' =>  $this->year,
                    'status' =>  $this->status,
                ]
            );
        } else {
            Higer::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'] ?? $row['INTID'] ?? $row['intid'],
                    'school_id' => null,
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                    'bimester' =>  $this->bimester,
                    'year' =>  $this->year,
                    'status' =>  $this->status,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'int_id' => 'required|integer',
            'cve_esc' => 'string',
            'remesa' => 'required|string',
            '*.fol_form' => 'required|integer|unique:higers,fol_form',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 700;
    }

    public function chunkSize(): int
    {
        return 700;
    }
}
