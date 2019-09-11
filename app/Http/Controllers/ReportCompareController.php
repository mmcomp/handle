<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Unit;
use App\Service;
use App\Protocol;

class ReportCompareController extends Controller
{
    public function index(Request $request) {
        $icons = [
            "success"=>"check",
            "danger"=>"ban"
        ];
        $msgs = [];
        $sessions = $request->session()->all();
        foreach($sessions as $key=>$value) {
            if(strpos($key, 'msg_')!==false && isset($icons[str_replace('msg_', '', $key)])) {
                $msgs[] = [
                    "msg"=>$value,
                    "type"=>str_replace('msg_', '', $key),
                    "icon"=>$icons[str_replace('msg_', '', $key)],
                ];
            }
        }
        
        $results = [];
        $units = Unit::all();
        $units_ids = [];
        $services_id = '';
        if($request->getMethod()=='POST') {
            $services_id = $request->input('services_id');
            $units_ids = $request->input('units_id');
            $allUnits = false;
            if(!$units_ids) {
                $allUnits = true;
            }else {
                foreach($units_ids as $id) {
                    if($id == null) {
                        $allUnits = true;
                    }
                }
            }
            if($allUnits) {
                $units_ids = [];
            }
            $selectedUnits = ($allUnits)?$units:Unit::whereIn('id', $units_ids)->get();
            $protocolRelations = ['contractor'];
            $selectedProtocols = ($allUnits)?Protocol::where('services_id', $services_id)->with($protocolRelations)->get():Protocol::whereIn('giving_units_id', $units_ids)->where('services_id', $services_id)->with($protocolRelations)->get();
            $protocols = [];
            foreach($selectedUnits as $unt) {
                $protocols[$unt->id] = [];
                foreach($selectedProtocols as $prt) {
                    if($prt->giving_units_id==$unt->id) {
                        $protocols[$unt->id][] = $prt;
                    }
                    if(!isset($prt->duration)) {
                        $endDate = new \DateTime($prt->end_date);
                        $startDate = new \DateTime($prt->start_date);
                        $interval = $endDate->diff($startDate);
                        $prt->duration = $interval->format('%a');
                    }
                }
            }
            $results = [
                "units"=>$selectedUnits,
                "service"=>Service::find($services_id),
                "protocols"=>$protocols
            ];
        }
        $services = Service::all();

        return view('report_compare.index', [
            "msgs"=>$msgs,
            "results"=>$results,
            "units"=>$units,
            "services"=>$services,
            "units_ids"=>$units_ids,
            "services_id"=>$services_id
        ]);
    }
}
