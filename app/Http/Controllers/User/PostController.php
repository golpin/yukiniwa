<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\SkiResort;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class PostController extends Controller
{
    public function home(Request $request)
    {

        $posts = Post::with(['ski_resort', 'user'])
            ->sortBySkiResort($request->ski_resort ?? '0') 
            //スキー場による検索
            ->sortByKeyword($request->keyword) 
            //キーワード検索
            ->sortBy($request->sort) 
            //作成日によるソート
            ->paginate(20);

        $ski_resorts = SkiResort::all();

        //$likes = Like::all();

        $likes = Like::where('user_id', Auth::user()->id)
            ->get();
        //dd($likes);


        return view('user.home', compact('posts', 'ski_resorts', 'likes'));
    }

    public function guest(Request $request)
    {

        $posts = Post::with(['ski_resort', 'user'])
            ->sortBySkiResort($request->ski_resort ?? '0') 
            //スキー場による検索
            ->sortByKeyword($request->keyword) 
            //キーワード検索
            ->sortBy($request->sort) 
            //作成日によるソート
            ->paginate(20);

        $ski_resorts = SkiResort::all();

        return view('guest.home', compact('posts', 'ski_resorts')); 
    }

    public function mypost()
    {

        $posts = Post::with(['ski_resort', 'user'])
            ->where('user_id', Auth::id())->paginate(12);
            //12投稿ごとにページネーション

        $likes = Like::where('user_id', Auth::user()->id)
            ->get();

        return view('user.mypost', compact('posts', 'likes')); 
    }

    public function create()
    {
        $ski_resorts = SkiResort::select('id', 'name')->get();

        return view('user.create', compact('ski_resorts'));
    }

    public function store(PostRequest $request)
    {

        $user = User::findOrFail(Auth::id());
        try {
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = $user->id; 
            $post->ski_resort_id = $request->input('ski_resort_id');
            if ($request->hasfile('image')) { 
                //画像ファイルが存在するときのみ処理
                $file = $request->file('image');
                //$extention = $file->getClientOriginalExtension(); 
                //拡張子を取得
                //$filename = time() . '.' . $extention;
                //現在の時間と拡張子を繋げる 
                //$file->storeAs('public/images', $filename); 
                //画像ファイルをimagesに保存
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                //S3に保存
                $post->image = $path;
                //ファイル名だけ取得してimageカラムに保存
            }
            $post->save();
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
        \Session::flash('err_msg', '記事を登録しました'); 
        return redirect()->route('user.home');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (is_null($post)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('user.home'));
        }
        $ski_resorts = SkiResort::select('id', 'name')->get();

        return view('user.edit', compact('post', 'ski_resorts'));
    }

    public function update(PostRequest $request, $id)
    {

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->ski_resort_id = $request->input('ski_resort_id');


        if ($request->hasfile('image')) {
            //$path = 'public/images/' . $post->image;
            //if (Storage::exists($path)) {
            //    Storage::delete($path);
            //}
            if (Storage::disk('s3')->exists($post->image)) {
                Storage::disk('s3')->delete($post->image);
            }
            //S3から既存のファイルを削除
            $file = $request->file('image');
            //$extention = $file->getClientOriginalExtension();
            //$filename = time() . '.' . $extention;
            //$file->storeAs('public/images', $filename);
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            //s3に画像を保存
            $post->image = $path;
            //imageカラムにs3保存時のファイル名を保存
        }
        $post->update();


        \Session::flash('err_msg', 'ブログを更新しました');

        return redirect()->route('user.home');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        //$path = 'public/images/' . $post->image;
        //if (Storage::exists($path)) {
        //    Storage::delete($path);
        //}
        if ($post->image) {
            if (Storage::disk('s3')->exists( $post->image)) {
                Storage::disk('s3')->delete( $post->image);
            }
            //s3の画像を削除
        }
        $post->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('user.home'));
    }

    public function like(Post $post, Request $request)
    {
        try {
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = Auth::user()->id;
            $like->save();
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return back();
    }

    public function unlike(Post $post, Request $request)
    {
        $like = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        $like->delete();

        return back();
    }
}