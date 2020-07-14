<?php

namespace App\Imports;

use App\Medium;
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

class ReissueImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $bimester;
    private $year;
    private $status;

    public function __construct($bimester, $status, $year)
    {
        $this->bimester = $bimester;
        $this->year = $year;
        $this->status = $status;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (School::where('id', '=', $row['cve_esc'])->exists()) {
            Medium::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'],
                    'school_id' => $row['CVE_ESC'] ?? $row['cve_esc'],
                    'consignment' => $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                    'bimester' => $this->bimester,
                    'year' => $this->year,
                    'status' => $this->status,
                    'reissue' => 1,
                ]
            );
        } else {
            Medium::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'],
                    'school_id' => null,
                    'consignment' => $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                    'bimester' => $this->bimester,
                    'year' => $this->year,
                    'status' => $this->status,
                    'reissue' => 1,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'int_id' => 'required|integer',
            'cve_esc' => 'string',
            'impresion' => 'required|string',
            '*.fol_form' => 'required|integer|unique:media,fol_form',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
