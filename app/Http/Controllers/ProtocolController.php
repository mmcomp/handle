<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Agent;
use App\Protocol;
use App\ProtocolType;
use App\ProtocolDoc;
use App\ProtocolComplement;
use App\ProtocolListSimple;
use App\Service;
use App\ServicesDesc;
use App\Unit;
use App\GiveWay;
use App\Province;
use App\City;
use App\Transaction;
use App\WinnerSelectWay;
use App\Company;
use App\FormalityStatus;
use App\FormalityType;
use App\Ownership;

class ProtocolController extends Controller
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
        $protocolTypes = ProtocolType::all();
        if($request->getMethod()!='GET'){
            $protocols = Protocol::with('employer_agent')->with('contractor_agent')->with('type')
                ->with('employer')->with('contractor')->with('docs')
                ->where(function($query) use ($request) {
                    if($request->input('title') && trim($request->input('title'))!='') {
                        $query->where('title', 'like', '%' . $request->input('title') . '%');
                    }
                    if($request->input('type') && trim($request->input('type'))!='') {
                        $query->where('protocol_types_id', $request->input('type'));
                    }
                })
                ->get();
        }else {
            $protocols = Protocol::with('employer_agent')->with('contractor_agent')->with('type')
                ->with('employer')->with('contractor')->with('docs')->get();
        }
        
        return view('protocol.index', [
            "msgs"=>$msgs,
            "protocols"=>$protocols,
            "protocolTypes"=>$protocolTypes,
            "req"=>$request->all(),
        ]);
    }

    public function create(Request $request) {
        $protocol = new Protocol;
        $services = Service::all();
        $services_descs = ServicesDesc::all();
        $units = Unit::all();
        $give_ways = GiveWay::all();
        $cities = City::all();
        $provinces = Province::all();
        $transactions = Transaction::all();
        $winner_select_ways = WinnerSelectWay::all();
        $isSearch = ($request->input('is_search')=='1');
        $companyAdd = $request->session()->get('company_add');
        $theCompany = null;
        if(!$isSearch) {
            $companies = Company::where('id', '>', 0)->with(['ceo', 'city.province', 'service', 'ownership'])->get();
        }else {
            $companyAdd = true;
            $ceosIds = [];
            if((trim($request->input('search_company_fname', ''))!='' || trim($request->input('search_company_lname', ''))!='')) {
                $ceos = Agent::where('fname', 'like', '%' . trim($request->input('search_company_fname', '')) . '%')->where('lname', 'like', '%' . trim($request->input('search_company_lname', '')) . '%')->get();
                foreach($ceos as $ceo) {
                    $ceosIds[] = $ceo->id;
                }
            }
            if(count($ceosIds)==0 && (trim($request->input('search_company_fname', ''))!='' || trim($request->input('search_company_lname', ''))!='')) {
                $companies = [];
            }else {
                $companies = Company::where(function($query) use ($request) {
                    if($request->input('search_company_name')) {
                        $query->where('name', 'like', '%' . trim($request->input('search_company_name')) . '%');
                    }
                })->where(function($query) use ($ceosIds) {
                    if(count($ceosIds)>0) {
                        $query->whereIn('ceo_agents_id', $ceosIds);
                    }
                })->with(['ceo', 'city.province', 'service', 'ownership'])->get();
            }
            if($request->input('company_edit_id')) {
                $theCompany = Company::find($request->input('company_edit_id'));
            }
        }
        $ownerships = Ownership::all();
        $agents = Agent::all();
        $protocol_types = ProtocolType::all();
        $formality_statuses = FormalityStatus::all();
        $formality_types = FormalityType::all();
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
        $data = $request->all();
        if(isset($data['start_date'])) {
            $data['start_date'] = Protocol::g2j($data['start_date']);
        }
        if(isset($data['end_date'])) {
            $data['end_date'] = Protocol::g2j($data['end_date']);
        }
        if(isset($data['notify_date'])) {
            $data['notify_date'] = Protocol::g2j($data['notify_date']);
        }
        if(!$request->isMethod('post') || $isSearch) {
            return view('protocol.create', [
                "msgs"=>$msgs,
                "services"=>$services,
                "services_descs"=>$services_descs,
                "units"=>$units,
                "give_ways"=>$give_ways,
                "provinces"=>$provinces,
                "cities"=>$cities,
                "transactions"=>$transactions,
                "winner_select_ways"=>$winner_select_ways,
                "companies"=>$companies,
                "protocol_types"=>$protocol_types,
                "formality_statuses"=>$formality_statuses,
                "formality_types"=>$formality_types,
                "ownerships"=>$ownerships,
                "agents"=>$agents,
                "companyAdd"=>$companyAdd,
                "data"=>$data,
                "theCompany"=>$theCompany
            ]);
        }
        $user = Auth::getUser();
        $protocolType = ProtocolType::find($request->input('protocol_types_id', 0));
        $hasList = false;
        if($protocolType) {
            if($protocolType->calc_type=='list_simple') {
                $item_names = $request->input('item_name', []);
                $item_prices = $request->input('item_price', []);
                $hasList = (count($item_names)>0 && count($item_prices)==count($item_names));
            }
        }
        // dd($request->all());
        $file_pathes = [];
        if($request->file_path) {
            $files = $request->file('file_path');
            foreach($files as $file_path) {
                $file_pathes[] = $file_path->store('contract_docs');
            }
        }
        $protocolColumns = $protocol->getAllAttributes();
        $changed = false;
        foreach($request->all() as $key=>$value) {
            if($key!='file_path' && in_array($key, $protocolColumns) && $value) {
                $protocol->$key = $value;
                $changed = true;
            }
        }
        if($changed) {
            $protocol->save();
            if($hasList) {
                $protocolListSimples = [];
                $now = new \DateTime;
                foreach($item_names as $i=>$item_name) {
                    $protocolListSimples[] = [
                        "protocols_id"=>$protocol->id,
                        "item_name"=>$item_name,
                        "item_price"=>$item_prices[$i],
                        "register_users_id"=>$user->id,
                        "created_at"=>$now,
                        "updated_at"=>$now,
                    ];
                }
                ProtocolListSimple::insert($protocolListSimples);    
            }
            foreach($file_pathes as $file_path) {
                $protocolDoc = new ProtocolDoc;
                $protocolDoc->protocols_id = $protocol->id;
                $protocolDoc->file_path;
                $protocolDoc->expire_date = $request->input('expire_date', null);
                $protocolDoc->description = $request->input('description', '');
                $protocolDoc->save();
            }
            $request->session()->flash('msg_success', 'قرارداد مورد نظر با موفقیت ثبت شد');
            return redirect('/protocols');
        }else {
            $request->session()->flash('msg_danger', 'قراردادی به علت عدم ورود داده با موفقیت ثبت نشد');
            return redirect('/protocols');
        }

        return redirect('/protocols/create');
    }

    public function edit(Request $request, $id) {
        $protocol = Protocol::find($id);
        if(!$protocol) {
            $request->session()->flash('msg_danger', 'قرارداد مورد نظر پیدا نشد');
            return redirect('/protocols');
        }
        $protocol->load('complements');
        $protocol->load('type');
        if($protocol->type->calc_type=='list_simple') {
            $protocol->load('list_simples');
        }
        $services = Service::all();
        $services_descs = ServicesDesc::all();
        $units = Unit::all();
        $give_ways = GiveWay::all();
        $cities = City::all();
        $provinces = Province::all();
        $transactions = Transaction::all();
        $winner_select_ways = WinnerSelectWay::all();
        $isSearch = ($request->input('is_search')=='1');
        $companyAdd = $request->session()->get('company_add');
        $theCompany = null;
        if(!$isSearch) {
            $companies = Company::where('id', '>', 0)->with(['ceo', 'city.province', 'service', 'ownership'])->get();
        }else {
            $companyAdd = true;
            $ceosIds = [];
            if((trim($request->input('search_company_fname', ''))!='' || trim($request->input('search_company_lname', ''))!='')) {
                $ceos = Agent::where('fname', 'like', '%' . trim($request->input('search_company_fname', '')) . '%')->where('lname', 'like', '%' . trim($request->input('search_company_lname', '')) . '%')->get();
                foreach($ceos as $ceo) {
                    $ceosIds[] = $ceo->id;
                }
            }
            if(count($ceosIds)==0 && (trim($request->input('search_company_fname', ''))!='' || trim($request->input('search_company_lname', ''))!='')) {
                $companies = [];
            }else {
                $companies = Company::where(function($query) use ($request) {
                    if($request->input('search_company_name')) {
                        $query->where('name', 'like', '%' . trim($request->input('search_company_name')) . '%');
                    }
                })->where(function($query) use ($ceosIds) {
                    if(count($ceosIds)>0) {
                        $query->whereIn('ceo_agents_id', $ceosIds);
                    }
                })->with(['ceo', 'city.province', 'service', 'ownership'])->get();
            }
            if($request->input('company_edit_id')) {
                $theCompany = Company::find($request->input('company_edit_id'));
            }
        }
        $user = Auth::getUser();
        $ownerships = Ownership::all();
        $agents = Agent::all();
        $protocol_types = ProtocolType::all();
        $formality_statuses = FormalityStatus::all();
        $formality_types = FormalityType::all();
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
        if($request->input('com_total')) {
            $isSearch = true;
            $protocolComplement = new ProtocolComplement;
            $protocolComplement->protocols_id = $id;
            $protocolComplement->start_date = $request->input('com_start_date');
            $protocolComplement->end_date = $request->input('com_end_date');
            $protocolComplement->notify_date = $request->input('com_notify_date');
            $protocolComplement->total = $request->input('com_total');
            $protocolComplement->registerer_id = $user->id;
            $protocolComplement->save();
            $protocol->load('complements');
        }
        $data = $protocol->toArray();
        if(!$request->isMethod('post') || $isSearch) {
            return view('protocol.create', [
                "msgs"=>$msgs,
                "services"=>$services,
                "services_descs"=>$services_descs,
                "units"=>$units,
                "give_ways"=>$give_ways,
                "provinces"=>$provinces,
                "cities"=>$cities,
                "transactions"=>$transactions,
                "winner_select_ways"=>$winner_select_ways,
                "companies"=>$companies,
                "protocol_types"=>$protocol_types,
                "formality_statuses"=>$formality_statuses,
                "formality_types"=>$formality_types,
                "ownerships"=>$ownerships,
                "agents"=>$agents,
                "companyAdd"=>$companyAdd,
                "data"=>$data,
                "theCompany"=>$theCompany
            ]);
        }
        
        $hasList = false;
        if($protocol->type) {
            if($protocol->type->calc_type=='list_simple') {
                $item_names = $request->input('item_name', []);
                $item_prices = $request->input('item_price', []);
                $hasList = (count($item_names)>0 && count($item_prices)==count($item_names));
            }
        }
        $file_pathes = [];
        if($request->file_path) {
            $files = $request->file('file_path');
            foreach($files as $file_path) {
                $file_pathes[] = $file_path->store('contract_docs');
            }
        }
        $lastComplement = ProtocolComplement::where('protocols_id', $id)->orderBy('id', 'desc')->first();
        $protocolColumns = $protocol->getAllAttributes();
        $changed = false;
        $lastChanged = false;
        foreach($request->all() as $key=>$value) {
            if($key!='file_path' &&  in_array($key, $protocolColumns) && $value) {
                if($lastComplement==null || ($key!='total' && $key!='start_date' && $key!='end_date' && $key!='notify_date')) {
                    $protocol->$key = $value;
                    $changed = true;
                }else if($lastComplement && !($key!='total' && $key!='start_date' && $key!='end_date' && $key!='notify_date')) {
                    $lastComplement->$key = $value;
                    $lastChanged = true;
                }
            }
        }
        
        if($changed) {
            $protocol->save();
        }
        if($lastChanged) {
            $lastComplement->save();
        }
        if($hasList) {
            ProtocolListSimple::where('protocols_id', $id)->delete();
            $protocolListSimples = [];
            $now = new \DateTime;
            foreach($item_names as $i=>$item_name) {
                $protocolListSimples[] = [
                    "protocols_id"=>$protocol->id,
                    "item_name"=>$item_name,
                    "item_price"=>$item_prices[$i],
                    "register_users_id"=>$user->id,
                    "created_at"=>$now,
                    "updated_at"=>$now,
                ];
            }
            ProtocolListSimple::insert($protocolListSimples);    
        }
        if($changed || $lastChanged) {
            foreach($file_pathes as $file_path) {
                $protocolDoc = new ProtocolDoc;
                $protocolDoc->protocols_id = $protocol->id;
                $protocolDoc->file_path;
                $protocolDoc->expire_date = $request->input('expire_date', null);
                $protocolDoc->description = $request->input('description', '');
                $protocolDoc->save();
            }
            $request->session()->flash('msg_success', 'قرارداد مورد نظر با موفقیت ثبت شد');
            return redirect('/protocols');
        }
        return redirect('/protocols/create');
    }
}
