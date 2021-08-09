<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkiResort;
use App\Models\Admin;

class SkiResortController extends Controller
{
    public function skiResortList()
    {
        $skiResorts=SkiResort::select('id','name','address','created_at')->orderBy('name', 'asc')->get();

        return view('admin.ski_resort',compact('skiResorts'));
    }
    public function skiResortDelete($id)
    {
        $skiResort = SkiResort::findOrFail($id);
        $skiResort->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('admin.skiResortList'));
    }

    public function skiResortEdit($id)
    {
        $ski_resort = SkiResort::findOrFail($id);
        if (is_null($ski_resort)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('admin.skiResortList'));
        }

        return view('admin.ski_resort_edit', compact('ski_resort'));
    }

    public function skiResortUpdate(Request $request, $id)
    {

        $ski_resort = SkiResort::findOrFail($id);
        $ski_resort->name = $request->input('name');
        $ski_resort->address = $request->input('address');
        $ski_resort->update();

        \Session::flash('err_msg', 'スキー場を更新しました');

        return redirect(route('admin.skiResortList'));
    }

    public function skiResortCreate()
    {

        return view('admin.ski_resort_create');
    }

    public function skiResortStore(Request $request)
    {
        try {
            $ski_resort = new SkiResort();
            $ski_resort->name = $request->input('name');
            $ski_resort->address = $request->input('address');
            $ski_resort->save();
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        \Session::flash('err_msg', 'スキー場を登録しました'); //(session('err_msg'))に第2引数の値を渡す
        return redirect(route('user.home'));
    }
}
