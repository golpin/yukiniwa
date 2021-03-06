<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Models\SkiResort;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

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

    public function store(ProfileRequest $request )
    {

        $user = User::findOrFail(Auth::id());
        try{
            $profile = new Profile();
            $profile->content = $request->input('content');
            $profile->user_id = $user->id;//認証されているidをuser_idカラムに保存
            $profile->ski_resort_id = $request->input('ski_resort_id');
            if ($request->hasfile('icon')) {//画像ファイルが存在するときだけ処理を行う。ただし、validationではrequiredなので要らない処理かも
                $file = $request->file('icon');
                //$extention = $file->getClientOriginalExtension();//拡張子を取得
                //$filename = time() . '.' . $extention;//現在の時間と拡張子をくっつける
                //$file->storeAs('public/icons',$filename); //画像はpublicを経由してstorage/app/public/imagesに保存
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                //$profile->icon = $filename;//imageカラムにファイル名を保存
                $profile->icon = $path;
            }
            $profile->save();
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        \Session::flash('err_msg', 'プロフィールを更新しました');//(session('err_msg'))に第2引数の値を渡す
        return redirect()->route('user.profile.myprofile');
    }

    public function edit($id)
    {
        $user = User::where('id',Auth::user()->id)->first();
        $profile = Profile::findOrFail($id);
        if (is_null($profile)) {
            \Session::flash('err_msg', 'プロフィールがありません。');
            return redirect(route('user.home'));
        }
        $ski_resorts = SkiResort::select('id', 'name')->get();

        return view('user.profile.edit', compact('profile','ski_resorts','user'));
    }

    public function update(ProfileRequest $request,  $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->user->name = $request->input('name');
        $profile->content = $request->input('content');
        $profile->ski_resort_id = $request->input('ski_resort_id');

        if ($request->hasfile('icon')) {
            //if(Storage::exists($path))
            //{
            //    Storage::delete($path);
            //}
            //S3から既存のファイルを削除する
            if (Storage::disk('s3')->exists( $profile->icon )) {
                Storage::disk('s3')->delete( $profile->icon );
            }
            $file = $request->file('icon');
            //$extention = $file->getClientOriginalExtension();
            //$filename = time() . '.' . $extention;
            //$file->storeAs('public/icons',$filename);
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            //$profile->icon = $filename;
            $profile->icon = $path;
        }
        $profile->update();


        \Session::flash('err_msg', 'プロフィールを更新しました');

        return redirect()->route('user.profile.myprofile');
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
