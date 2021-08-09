<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\SkiResort;
use App\Models\Like;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $posts = Post::with(['ski_resort', 'user'])
            ->sortBySkiResort($request->ski_resort ?? '0') //スキー場による検索
            ->sortByKeyword($request->keyword) //キーワード検索
            ->sortBy($request->sort) //作成日によるソート
            ->paginate(20);

        $ski_resorts = SkiResort::all();


        return view('admin.home',compact('posts', 'ski_resorts'));
    }

    public function userList()
    {
        $users=User::select('id','name','email','created_at')->orderBy('id', 'asc')->get();

        return view('admin.list',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('admin.list'));
    }
}
