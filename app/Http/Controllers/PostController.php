<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        try {

            $posts=Post::all();
            return view('home',['posts' => $posts]);

        }catch (\Exception $e){

            info($e);

        }

    }

    public function create()
    {
        try {
            return view('createPost');
        }catch (\Exception $e){

            info($e);

        }


    }
    public function store(Request $request)
    {
        try {

            Post::create([
                'title' => $request->data['title'],
                'description' => $request->data['description'],
                'user_id'  => auth()->user()->id
            ]);
            return response(' ',200);
        }catch (\Exception $e){

            info($e);

        }

    }
    public function userspost()
    {   $userId=Auth::id();
        $userPosts=User::find($userId)->posts;
        return view('userposts',['userPosts' => $userPosts]);
    }
    public function updatepost(Request $request , Post $post)
    {
        //  dd($request->all());
        try {
            $post->update([
                'title' => $request->data['title'],
                'description' => $request->data['description'],
            ]);
            // $post->update($request->all());

            return response(' ',200);
        } catch (\Exception $e) {
            info($e);
        }

    }
    public function destroy(Post $id){

        $id->delete();

        return response(' ',200);

    }

    public function show($id){

        $details=Post::with('comments')->find($id);

        return view('details',['details' => $details]);
    }

    public function poststatus(Request $request,$id)
    {
        $postStatus = Post::find($id);

        //dd($postStatus);

        $postStatus->status = "public";

        $postStatus->save();

        return response(' ',200);

    }
    public function statusprivate(Request $request,$id)
    {
        $postStatus = Post::find($id);

        //dd($postStatus);

        $postStatus->status = "private";

        $postStatus->save();

        return response(' ',200);
    }
}
