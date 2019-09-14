<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Company;
use App\Ownership;
use App\Service;
use App\Province;
use App\City;
use App\Protocol;
use App\Agent;

class ReportCompanyController extends Controller
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
        $ownerships = Ownership::all();
        $services = Service::all();
        $provinces = Province::all();
        $cities = City::all();
        $req = $request->all();
        if($request->getMethod()!='GET'){
            $start_date = $request->input('start_date');
            if($start_date) {
                $start_date = Protocol::g2j($start_date);
            }
            $end_date = $request->input('end_date');
            if($end_date) {
                $end_date = Protocol::g2j($end_date);
            }
            $req['start_date'] = $start_date;
            $req['end_date'] = $end_date;

            $ceos = Agent::where(function($query) use ($request) {
                if($request->input('ceo_fname') && trim($request->input('ceo_fname'))!='') {
                    $query->where('fname', 'like', '%' . $request->input('ceo_fname') . '%');
                }
                if($request->input('ceo_lname') && trim($request->input('ceo_lname'))!='') {
                    $query->where('lname', 'like', '%' . $request->input('ceo_lname') . '%');
                }
            })->pluck('id');

            $protocols = Protocol::where(function($query) use ($request) {
                if($request->input('start_date') && trim($request->input('start_date'))!='') {
                    $query->where('start_date', $request->input('start_date'));
                }
                if($request->input('end_date') && trim($request->input('end_date'))!='') {
                    $query->where('end_date', $request->input('end_date'));
                }
                if($request->input('has_protocol')) {
                    $query->where('status', '!=', 'finish');
                }
            })->pluck('contractor_company_id');
            
            $companies = Company::with('ceo')->with('ownership')->with('service')->with('city.province')->with('protocols')
                ->where(function($query) use ($request, $ceos, $protocols) {
                    if($request->input('name') && trim($request->input('name'))!='') {
                        $query->where('name', 'like', '%' . $request->input('name') . '%');
                    }
                    if($request->input('ownership') && trim($request->input('ownership'))!='') {
                        $query->where('ownerships_id', $request->input('ownership'));
                    }
                    if($request->input('service') && trim($request->input('service'))!='') {
                        $query->where('services_id', $request->input('service'));
                    }
                    if($request->input('city') && trim($request->input('city'))!='') {
                        $query->where('cities_id', $request->input('city'));
                    }
                    if(($request->input('ceo_fname') && trim($request->input('ceo_fname'))!='') || ($request->input('ceo_lname') && trim($request->input('ceo_lname'))!='')) {
                        $query->whereIn('ceo_agents_id', $ceos);
                    }
                    if(($request->input('start_date') && trim($request->input('start_date'))!='') || ($request->input('end_date') && trim($request->input('end_date'))!='') || $request->input('has_protocol')) {
                        $query->whereIn('id', $protocols);
                    }
                })
                ->get();
        }else {
            $companies = Company::with('ceo')->with('ownership')->with('service')->with('city.province')->with('protocols')->get();
        }
        return view('report_company.index', [
            "msgs"=>$msgs,
            "companies"=>$companies,
            "ownerships"=>$ownerships,
            "services"=>$services,
            "provinces"=>$provinces,
            "cities"=>$cities,
            "req"=>$req,
        ]);
    }
}
