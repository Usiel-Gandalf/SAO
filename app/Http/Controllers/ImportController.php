<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Imports\RegionsImport;
use App\Imports\MunicipalitiesImport;
use App\Imports\LocalitiesImport;
use App\Imports\SchoolsImport;
use App\Imports\ScholarsImport;
use App\Imports\TitularsImport;
use App\Imports\BasicsImport;
use App\Imports\BasicsupdateImport;
use App\Imports\MediumsImport;
use App\Imports\MediumsupdateImport;
use App\Imports\ReissueImport;
use App\Imports\ReissueupdateImport;
use App\Imports\HigersImport;
use App\Imports\HigersupdateImport;

use Exception;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }

    public function importRegion(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'region' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('region');

        try {
            $import = new RegionsImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (Exception $ex) {
            $err = $ex->getMessage();
            return back()->with('err',$err);
            die();
        }

        return back()->with('regionAlert', 'Se a completado la importacion de regiones');
    }

    public function importMunicipality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'municipality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('municipality');

        try {
            $import = new MunicipalitiesImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (Exception $ex) {
            $err = $ex->getMessage();
            return back()->with('err', $err);
            die();
        }

        return back()->with('municipalityAlert', 'Se a completado la importacion de municipios');
    }

    public function importLocality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'locality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('locality');

        try {
            $import = new LocalitiesImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }

        return back()->with('localityAlert', 'Se a completado la importacion de localidades');
    }

    public function importSchool(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'school' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('school');

        try {
            $import = new SchoolsImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }

        return back()->with('schoolAlert', 'Se a completado la importacion de escuelas');
    }

    public function importBasic(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $val = $request->validate([
            'basicUniverse' => 'required|mimes:xlsx, xls',
            'type' => 'required',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $type = $request->input('type');
        $status = 0;
        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('basicUniverse');

        try {
            $import = new BasicsImport($type, $status, $bimester, $year);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }

        if ($type == 1) {
            return back()->with('importBasicAlert', 'Importacion de CERMS completada');
        } elseif ($type == 2) {
            return back()->with('importBasicAlert', 'Importacion de Avisos de cobro completada');
        }
    }


    public function updateBasic(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'basicUniverse' => 'required|mimes:xlsx, xls',
            //'type' => 'required',
            'status' => 'required',
            //'bimester' => 'required',
            //'year' => 'required',
        ]);

        // $type = $request->input('type');
        //$bimester = $request->input('bimester');
        //$year = $request->input('year');
        $status = $request->input('status');
        $file = $request->file('basicUniverse');

        try {
            $import = new BasicsupdateImport($status);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (Exception $ex) {
            $err = $ex->getMessage();
            return back()->with('err',$err);
            die();
        }

        return back()->with('updateBasicAlert', 'Actualizacion completada');
    }


    public function importMedium(Request $request)
    {
        $request->validate([
            'mediumUniverse' => 'required|mimes:xlsx, xls',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('mediumUniverse');
        $status = 0;

        try {
            $import = new MediumsImport($bimester, $year, $status);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }
        return back()->with('importMediumAlert', 'Importacion de informacion exitosa');
    }

    public function updateMedium(Request $request){
     
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'mediumUniverse' => 'required|mimes:xlsx, xls',
            //'type' => 'required',
            'status' => 'integer',
            //'bimester' => 'required',
            //'year' => 'required',
        ]);
       
        // $type = $request->input('type');
        //$bimester = $request->input('bimester');
        //$year = $request->input('year');
        $status = $request->input('status');
        $file = $request->file('mediumUniverse');

        try {
            $import = new MediumsupdateImport($status);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (Exception $ex) {
            $err = $ex->getMessage();
            return back()->with('err',$err);
            die();
        }

        return back()->with('updateMediumAlert', 'Actualizacion completada');
    }

    public function importReissue(Request $request){
        $request->validate([
            'mediumUniverse' => 'required|mimes:xlsx, xls',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $bimester = $request->input('bimester');
        $file = $request->file('mediumUniverse');
        $status = 0;
        $year = $request->input('year');

        try {
            $import = new ReissueImport($bimester, $status, $year);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->with('importReissueFailures');
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }
        return back()->with('importReissueAlert', 'Inportacion de reexpediciones completada');
    }

    public function updateReissue(Request $request){

        $request->validate([
            'mediumUniverse' => 'required|mimes:xlsx, xls',
            'status' => 'required|integer',
        ]);

        $file = $request->file('mediumUniverse');
        $status = $request->input('status');

        try {
            $import = new ReissueupdateImport($status);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
                die();
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
            die();
        }
        return back()->with('updateReissueAlert', 'Actualizacion de informacion exitosa');
        die();
    }

    public function importHiger(Request $request)
    {
        $request->validate([
            'higerUniverse' => 'required|mimes:xlsx, xls',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $bimester = $request->input('bimester');
        $file = $request->file('higerUniverse');
        $status = 0;
        $year = $request->input('year');

        try {
            $import = new HigersImport($bimester, $status, $year);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }
        return back()->with('importHigerAlert', 'Inportacion de JEF completada');
    }

    public function updateHiger(Request $request){
        $request->validate([
            'higerUniverse' => 'required|mimes:xlsx, xls',
            'status' => 'required|integer',
        ]);

        $file = $request->file('higerUniverse');
        $status = $request->input('status');

        try {
            $import = new HigersupdateImport($status);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
                die();
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
            die();
        }
        return back()->with('updateHigerAlert', 'Actualizacion de informacion exitosa');
        die();
    }

    public function importScholar(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'scholarsInformation' => 'required|mimes:xlsx, xls',
            'level' => 'required',
        ]);

        $file = $request->file('scholarsInformation');
        $level = $request->input('level');

        try {
            $import = new ScholarsImport($level);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        }catch(Exception $e){
            $err = $e->getMessage();
            return back()->with('err', $err);
        }
        return back()->with('scholarAlert', 'Inportacion de informacion de los becarios completada');
    }

    public function importTitular(Request $request){
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'titularsInformation' => 'required|mimes:xlsx, xls',
        ]);

        $file = $request->file('titularsInformation');

        try {
            $import = new TitularsImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                //return back()->withFailures($import->failures());
                $failures = $import->failures();
                return back()->with('failures', $failures);
            }
        }catch(Exception $e){
           return $err = $e->getMessage();
            return back()->with('err', $err);
        }
        return back()->with('titularAlert', 'Inportacion de informacion de titulares completada');
    }

}
