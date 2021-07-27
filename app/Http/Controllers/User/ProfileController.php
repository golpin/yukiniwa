<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Models\SkiResort;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function myprofile()
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $user = User::where('id',Auth::user()->id)->first();

        return view('user.profile.myprofile',compact('profile','user'));
    }

    public function create()
    {
        $ski_resorts = SkiResort::select('id', 'name')->get();
        $user = User::where('id',Auth::user()->id)->first();

        return view('user.profile.create',compact('ski_resorts','user'));
    }

    public function store(Request $request )
    {

        $user = User::findOrFail(Auth::id());
        try{
            $profile = new Profile();
            $profile->content = $request->input('content');
            $profile->user_id = $user->id;//認証されているidをuser_idカラムに保存
            $profile->ski_resort_id = $request->input('ski_resort_id');
            if ($request->hasfile('icon')) {//画像ファイルが存在するときだけ処理を行う。ただし、validationではrequiredなので要らない処理かも
                $file = $request->file('icon');
                $extention = $file->getClientOriginalExtension();//元々の拡張子のみ取得
                $filename = time() . '.' . $extention;//現在の時間と拡張子をくっつける
                $file->storeAs('public/icons',$filename); //画像はpublicを経由してstorage/app/public/imagesに保存
                $profile->icon = $filename;//imageカラムにファイル名を保存
            }
            $profile->save();
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        \Session::flash('err_msg', '記事を登録しました');//(session('err_msg'))に第2引数の値を渡す
        return redirect()->route('user.profile.myprofile');
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        if (is_null($profile)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('user.home'));
        }
        $ski_resorts = SkiResort::select('id', 'name')->get();
        return view('user.profile.edit', compact('profile','ski_resorts'));
    }

    public function update(Request $request,  $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->user->name = $request->input('name');
        $profile->content = $request->input('content');
        $profile->ski_resort_id = $request->input('ski_resort_id');

        if ($request->hasfile('icon')) {
            $path ='public/icons/'.$profile->image;
            if(Storage::exists($path))
            {
                Storage::delete($path);
            }
            //既存のファイルを削除する
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('public/icons',$filename);
            $profile->image = $filename;
        }
        $profile->update();


        \Session::flash('err_msg', 'ブログを更新しました');

        return redirect()->route('user.profile.myprofile');
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
