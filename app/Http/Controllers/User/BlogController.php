<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 


class BlogController extends Controller
{
    public function home()
    {

        $blogs = Blog::paginate(12);

        //blog9件で1ページとする
        //dd($blogs);

        return view('user.home',compact('blogs'));//view側に変数blogsを渡す
    }

    public function guest()
    {

        $blogs = Blog::paginate(12);
        //blog9件で1ページとする
        //dd($blogs);

        return view('guest.home',compact('blogs'));//view側に変数blogsを渡す
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(BlogRequest $request )
    {

        $user = User::findOrFail(Auth::id());
        try{
            $blog = new Blog();
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->user_id = $user->id;//認証されているidをuser_idカラムに保存
            if ($request->hasfile('image')) {//画像ファイルが存在するときだけ処理を行う。ただし、validationではrequiredなので要らない処理かも
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();//元々の拡張子のみ取得
                $filename = time() . '.' . $extention;//現在の時間と拡張子をくっつける
                $file->storeAs('public/images',$filename); //画像はpublicを経由してstorage/app/public/imagesに保存
                $blog->image = $filename;//imageカラムにファイル名を保存
            }
            $blog->save();
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        \Session::flash('err_msg', '記事を登録しました');//(session('err_msg'))に第2引数の値を渡す
        return redirect()->route('user.home');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('user.home'));
        }
        return view('user.edit', ['blog' => $blog]);

    }

    public function update(BlogRequest $request,$id)
    {

        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');

        if ($request->hasfile('image')) {
            $path ='public/images/'.$blog->image;
            if(Storage::exists($path))
            {
                Storage::delete($path);
            }
            //既存のファイルを削除する
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('public/images',$filename);
            $blog->image = $filename;
        }
        $blog->update();


        \Session::flash('err_msg', 'ブログを更新しました');

        return redirect()->route('user.home');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        if ( $blog->image ) {
            $path ='public/images/'.$blog->image;
            if(Storage::exists($path))
            {
                Storage::delete($path);
            }
            //カラムの値だけだとファイルが残留するので現物も削除する
        $blog->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('user.home'));
        }
    }
}