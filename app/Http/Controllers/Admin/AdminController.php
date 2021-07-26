<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $posts = Post::paginate(12);

        //blog9件で1ページとする
        //dd($blogs);

        return view('admin.home',compact('posts'));//view側に変数blogsを渡す
    }

    public function list()
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
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('admin.list'));
    }
}
