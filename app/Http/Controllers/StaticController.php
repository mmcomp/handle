<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class StaticController extends Controller
{
    public function index(Request $request) {
        $modelName = explode('_', Route::getFacadeRoot()->current()->uri());
        $modelName = 'App\\' . $modelName[1];
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
        
        $statics = $modelName::all();
        $sample = new $modelName;

        return view('static.index', [
            "msgs"=>$msgs,
            "statics"=>$statics,
            "path"=>Route::getFacadeRoot()->current()->uri(),
            "sample"=>$sample
        ]);
    }

    public function create(Request $request) {
        $path = explode('/', Route::getFacadeRoot()->current()->uri());
        $path = $path[0];
        $modelName = explode('_', $path);
        $modelName = 'App\\' . $modelName[1];
        $static = new $modelName;
        if(!$request->isMethod('post')) {
            return view('static.create', [
                "static"=>$static,
            ]);
        }

        $static->name = $request->input('name');

        $static->save();
        
        $request->session()->flash('msg_success', 'ثبت با موفقیت انجام شد');
        return redirect('/' . $path);
    }

    public function edit(Request $request, $id) {
        $path = explode('/', Route::getFacadeRoot()->current()->uri());
        $path = $path[0];
        $modelName = explode('_', $path);
        $modelName = 'App\\' . $modelName[1];
        $static = $modelName::find($id);
        if(!$static) {
            $request->session()->flash('msg_danger', 'آیتم مورد نظر پیدا نشد');
            return redirect('/' . $path);
        }
        if(!$request->isMethod('post')) {
            return view('static.create', [
                "static"=>$static,
            ]);
        }

        $static->name = $request->input('name');

        $static->save();

        $request->session()->flash('msg_success', 'ویرایش با موفقیت انجام شد');
        return redirect('/' . $path);
    }

    public function delete(Request $request, $id) {
        $path = explode('/', Route::getFacadeRoot()->current()->uri());
        $path = $path[0];
        $modelName = explode('_', $path);
        $modelName = 'App\\' . $modelName[1];
        $static = $modelName::find($id);
        if(!$static) {
            $request->session()->flash('msg_danger', 'آیتم مورد نظر پیدا نشد');
            return redirect('/' . $path);
        }

        $static->delete();
        $request->session()->flash('msg_success', 'حذف با موفقیت انجام شد');
        
        return redirect('/' . $path);
    }
}
