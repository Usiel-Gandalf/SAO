<?php

namespace App\Imports;

ini_set('max_execution_time', 4800);

use App\Basic;
use App\Locality;
use Exception;
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



class BasicsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
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
    }

    public function rules(): array
    {
        return [
            '*.fam_id' => 'required|integer',
            '*.claveofi' => 'required|integer|exists:localities,id',
            '*.remesa' => 'required|string',
            '*.fol_form' => 'required|integer|unique:basics,fol_form',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'fol_form.unique' => 'EL folio de formato ya esta registrado, se omitio el registro para evitar duplicidad',
            'fol_form.integer' => 'El folio de formato solo puede ser de tipo numerico, verificar el tipo de dato',
            'fol_form.required' => 'El folio de formato no puede estar vacio, verificar nuevamente',
            'fam_id.required' => 'la clave de la titular no puede estar vacio, verificar nuevamente',
            'fam_id.integer' => 'la clave de la titular solo puede ser de tipo numerico, verificar el tipo de dato',
            'claveofi.required' => 'la clave de la localidad no puede estar vacia, verificar nuevamente',
            'claveofi.integer' => 'la clave de la escuela solo puede ser de tipo numerico, verificar el tipo de dato',
            'claveofi.exists' => 'Localidad no encontrada(clave), primero debe de registrarla en la seccion de localidades e intentar nuevamente',
            'remesa.required' => 'la remesa no puede estar vacia, verificar nuevamente',
            'remesa.string' => 'la remesa solo puede ser de tipo letras y numeros, verificar el tipo de dato',
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
