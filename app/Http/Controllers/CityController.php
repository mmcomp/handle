<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\Province;

class CityController extends Controller
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
        
        $cities = City::all();
        $cities->load('province');

        return view('city.index', [
            "msgs"=>$msgs,
            "cities"=>$cities,
        ]);
    }

    public function create(Request $request) {
        $city = new City;
        $provinces = Province::all();
        if(!$request->isMethod('post')) {
            return view('city.create', [
                "city"=>$city,
                "provinces"=>$provinces
            ]);
        }

        $city->name = $request->input('name');
        $city->provinces_id = (int)$request->input('provinces_id');

        $city->save();
        
        $request->session()->flash('msg_success', 'شهر مورد نظر با موفقیت ثبت شد');
        return redirect('/statistics_city');
    }

    public function edit(Request $request, $id) {
        $city = City::find($id);
        if(!$city) {
            $request->session()->flash('msg_danger', 'شهر مورد نظر پیدا نشد');
            return redirect('/statistics_city');
        }
        $provinces = Province::all();
        if(!$request->isMethod('post')) {
            return view('city.create', [
                "city"=>$city,
                "provinces"=>$provinces
            ]);
        }

        $city->name = $request->input('name');
        $city->provinces_id = (int)$request->input('provinces_id');

        $city->save();

        $request->session()->flash('msg_success', 'شهر مورد نظر با موفقیت ویرایش شد');
        return redirect('/statistics_city');
    }

    public function delete(Request $request, $id) {
        $city = City::find($id);
        if(!$city) {
            $request->session()->flash('msg_danger', 'شهر مورد نظر پیدا نشد');
            return redirect('/statistics_city');
        }

        $city->delete();
        $request->session()->flash('msg_success', 'حذف شهر با موفقیت انجام شد');
        
        return redirect('/statistics_city');
    }
}
