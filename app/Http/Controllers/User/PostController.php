<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function home()
    {

        $posts = Post::paginate(12);

        //post9件で1ページとする
        //dd($posts);

        return view('user.home',compact('posts'));//view側に変数postsを渡す
    }

    public function guest()
    {

        $posts = Post::paginate(12);
        //post9件で1ページとする
        //dd($posts);

        return view('guest.home',compact('posts'));//view側に変数postsを渡す
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(PostRequest $request )
    {

        $user = User::findOrFail(Auth::id());
        try{
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = $user->id;//認証されているidをuser_idカラムに保存
            if ($request->hasfile('image')) {//画像ファイルが存在するときだけ処理を行う。ただし、validationではrequiredなので要らない処理かも
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();//元々の拡張子のみ取得
                $filename = time() . '.' . $extention;//現在の時間と拡張子をくっつける
                $file->storeAs('public/images',$filename); //画像はpublicを経由してstorage/app/public/imagesに保存
                $post->image = $filename;//imageカラムにファイル名を保存
            }
            $post->save();
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        \Session::flash('err_msg', '記事を登録しました');//(session('err_msg'))に第2引数の値を渡す
        return redirect()->route('user.home');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (is_null($post)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('user.home'));
        }
        return view('user.edit', ['post' => $post]);

    }

    public function update(PostRequest $request,$id)
    {

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasfile('image')) {
            $path ='public/images/'.$post->image;
            if(Storage::exists($path))
            {
                Storage::delete($path);
            }
            //既存のファイルを削除する
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('public/images',$filename);
            $post->image = $filename;
        }
        $post->update();


        \Session::flash('err_msg', 'ブログを更新しました');

        return redirect()->route('user.home');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ( $post->image ) {
            $path ='public/images/'.$post->image;
            if(Storage::exists($path))
            {
                Storage::delete($path);
            }
            //カラムの値だけだとファイルが残留するので現物も削除する
        $post->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('user.home'));
        }
    }
}