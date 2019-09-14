<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Protocol;
use App\ProtocolDoc;

class ReportProtocolController extends Controller
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
        $protocols = Protocol::with('service')->with('service_desc')->with('giving_unit')
            ->with('contractor')->with('winner_select_way')->with('type')->get();
        return view('report_protocol.index', [
            "msgs"=>$msgs,
            "protocols"=>$protocols,
        ]);
    }

    public function indexWarranty(Request $request) {
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
        $warranties = ProtocolDoc::where('warranty_type', '!=', null)->with('protocol')
            ->with('protocol.service')->with('protocol.service_desc')->with('protocol.giving_unit')
            ->with('protocol.contractor')->with('protocol.winner_select_way')->with('protocol.type')->get();

        return view('report_warranty.index', [
            "msgs"=>$msgs,
            "warranties"=>$warranties,
        ]);
    }
}
