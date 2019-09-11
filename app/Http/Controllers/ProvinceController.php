<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Province;

class ProvinceController extends Controller
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
        
        $provinces = Province::all();

        return view('province.index', [
            "msgs"=>$msgs,
            "provinces"=>$provinces,
        ]);
    }

    public function create(Request $request) {
        $province = new Province;
        if(!$request->isMethod('post')) {
            return view('province.create', [
                "province"=>$province,
            ]);
        }

        $province->name = $request->input('name');

        $province->save();
        
        $request->session()->flash('msg_success', 'استان مورد نظر با موفقیت ثبت شد');
        return redirect('/statistics_province');
    }

    public function edit(Request $request, $id) {
        $province = Province::find($id);
        if(!$province) {
            $request->session()->flash('msg_danger', 'استان مورد نظر پیدا نشد');
            return redirect('/statistics_province');
        }
        if(!$request->isMethod('post')) {
            return view('province.create', [
                "province"=>$province,
            ]);
        }

        $province->name = $request->input('name');

        $province->save();

        $request->session()->flash('msg_success', 'استان مورد نظر با موفقیت ویرایش شد');
        return redirect('/statistics_province');
    }

    public function delete(Request $request, $id) {
        $province = Province::find($id);
        if(!$province) {
            $request->session()->flash('msg_danger', 'استان مورد نظر پیدا نشد');
            return redirect('/statistics_province');
        }

        $province->delete();
        $request->session()->flash('msg_success', 'حذف استان با موفقیت انجام شد');
        
        return redirect('/statistics_province');
    }
}
