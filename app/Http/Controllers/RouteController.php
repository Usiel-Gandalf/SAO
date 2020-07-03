<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic;
use App\Medium;
use App\Higer;

class RouteController extends Controller
{
    public function importEntities()
    {
        return view('user.import.importEntities');
    }

    public function importScholars()
    {
        return view('user.import.importScholars');
    }

    public function importBasics()
    {
        return view('user.import.importBasic');
    }

    public function importMediums()
    {
        return view('user.import.importMedium');
    }

    public function importHigers()
    {
        return view('user.import.importHiger');
    }

    public function basicReport()
    {
        return view('user.basics.basicReport');
    }

    public function basicBimestersCerm()
    {
        $basics = Basic::with('locality')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Basic::where('status', 0)->get();
        $pendingEntities = $pending->unique('loacality_id')->load('locality.municipality.region');
        $cermYes = Basic::where('status', 1)->get();
        $cermYesEntities = $cermYes->unique('locality_id')->load('locality.municipality.region');
        $cermNot = Basic::where('status', 2)->get();
        $cermNotEntities = $cermNot->unique('locality_id')->load('locality.municipality.region');
        $cermDrop = Basic::where('status', 3)->get();
        $cermDropEntities = $cermDrop->unique('locality_id')->load('locality.municipality.region');
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.basics.basicCerm.basicBimestersCerm', compact('basics', 'pending', 'cermYes', 'cermNot', 'cermDrop', 
        'pendingEntities', 'cermYesEntities', 'cermNotEntities', 'cermDropEntities'));
    }

    public function basicBimestersDelivery()
    {
        $basics = Basic::with('locality')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Basic::where('status', 0)->get();
        $pendingEntities = $pending->unique('loacality_id')->load('locality.municipality.region');
        $cermYes = Basic::where('status', 1)->get();
        $cermYesEntities = $cermYes->unique('locality_id')->load('locality.municipality.region');
        $cermNot = Basic::where('status', 2)->get();
        $cermNotEntities = $cermNot->unique('locality_id')->load('locality.municipality.region');
        $cermDrop = Basic::where('status', 3)->get();
        $cermDropEntities = $cermDrop->unique('locality_id')->load('locality.municipality.region');
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.basics.basicDelivery.basicBimestersDelivery', compact('basics', 'pending', 'cermYes', 'cermNot', 'cermDrop', 
        'pendingEntities', 'cermYesEntities', 'cermNotEntities', 'cermDropEntities'));
    }

    public function mediumBimestersDelivery()
    {
        $mediums = Medium::with('school')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Medium::where('status', 0)->get();
        $pendingEntities = $pending->unique('school_id')->load('school.locality.municipality.region');
        $deliveryYes = Medium::where('status', 1)->get();
        $deliveryYesEntities = $deliveryYes->unique('school_id')->load('school.locality.municipality.region');
        $deliveryNot = Medium::where('status', 2)->get();
        $deliveryNotEntities = $deliveryNot->unique('school_id')->load('school.locality.municipality.region');
        $deliveryDrop = Medium::where('status', 3)->get();
        $deliveryDropEntities = $deliveryDrop->unique('school_id')->load('school.locality.municipality.region');
        $deliveryReshipment = Medium::where('status', 4)->get();
        $deliveryReshipmentEntities = $deliveryDrop->unique('school_id')->load('school.locality.municipality.region');
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.mediums.mediumDelivery.mediumBimestersDelivery', compact('mediums', 'pending', 'deliveryYes', 'deliveryNot', 'deliveryDrop', 'deliveryReshipment', 
        'pendingEntities', 'deliveryYesEntities', 'deliveryNotEntities', 'deliveryDropEntities', 'deliveryReshipmentEntities'));
    }

    public function higerBimestersDelivery()
    {
        $higers = Higer::with('school')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Higer::where('status', 0)->get();
        $pendingEntities = $pending->unique('school_id')->load('school.locality.municipality.region');
        $cermYes = Higer::where('status', 1)->get();
        $cermYesEntities = $cermYes->unique('school_id')->load('school.locality.municipality.region');
        $cermNot = Higer::where('status', 2)->get();
        $cermNotEntities = $cermNot->unique('school_id')->load('school.locality.municipality.region');
        $cermDrop = Higer::where('status', 3)->get();
        $cermDropEntities = $cermDrop->unique('school_id')->load('school.locality.municipality.region');;
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.higers.higerCerm.higerBimestersCerm', compact('higers', 'pending', 'cermYes', 'cermNot', 'cermDrop', 
        'pendingEntities', 'cermYesEntities', 'cermNotEntities', 'cermDropEntities'));
    }
}
