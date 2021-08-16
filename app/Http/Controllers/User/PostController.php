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
            ->sortBySkiResort($request->ski_resort ?? '0') //スキー場による検索
            ->sortByKeyword($request->keyword) //キーワード検索
            ->sortBy($request->sort) //作成日によるソート
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
            ->sortBySkiResort($request->ski_resort ?? '0') //スキー場による検索
            ->sortByKeyword($request->keyword) //キーワード検索
            ->sortBy($request->sort) //作成日によるソート
            ->paginate(20);

        $ski_resorts = SkiResort::all();

        return view('guest.home', compact('posts', 'ski_resorts')); //view側に変数postsを渡す
    }

    public function mypost()
    {

        $posts = Post::with(['ski_resort', 'user'])
            ->where('user_id', Auth::id())->paginate(12);

        $likes = Like::where('user_id', Auth::user()->id)
            ->get();

        //$like = Like::all();
        //post9件で1ページとする
        //dd($posts);

        return view('user.mypost', compact('posts', 'likes')); //view側に変数postsを渡す
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
            $post->user_id = $user->id; //認証されているidをuser_idカラムに保存
            $post->ski_resort_id = $request->input('ski_resort_id');
            $post->created_at = now();
            if ($request->hasfile('image')) { //画像ファイルが存在するときだけ処理を行う。ただし、validationではrequiredなので不要かもしれない
                $file = $request->file('image');
                //元々の拡張子を取得
                //$extention = $file->getClientOriginalExtension(); 
                //現在の時間と拡張子を繋げる
                //$filename = time() . '.' . $extention; 
                //storage/app/public/imagesに保存
                //$file->storeAs('public/images', $filename); 
                //S3に保存
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                //画像のフルパスを取得してimageカラムに保存
                //$post->image = Storage::disk('s3')->url($path);
                //ファイル名だけ取得してimageカラムに保存
                $post->image = $path;
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
        $ski_resorts = SkiResort::select('id', 'name')->get();//編集画面でスキー場を選択するために

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
            //S3から既存のファイルを削除する
            if (Storage::disk('s3')->exists( $post->image)) {
                Storage::disk('s3')->delete( $post->image);
            }
            $file = $request->file('image');
            //$extention = $file->getClientOriginalExtension();
            //$filename = time() . '.' . $extention;
            //$file->storeAs('public/images', $filename);
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            //ファイル名だけ取得してimageカラムに保存
            $post->image = $path;
        }
        $post->update();


        \Session::flash('err_msg', 'ブログを更新しました');

        return redirect()->route('user.home');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {

            if (Storage::disk('s3')->exists( $post->image)) {
                Storage::disk('s3')->delete( $post->image);
            }
            //カラムの値だけだとファイルが残留するので画像そのものも削除する
            
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
