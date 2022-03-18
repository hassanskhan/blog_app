<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\comments;
use App\Notifications\Replay;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        try {
            $post->comments()->create($request->data);

            $user = User::first();
            $details = [
                'greeting' => Auth::user()->name,
                'body' => 'commented on a Post => '.$request->data['comments'],

            ];
            Notification::send($user,new Replay($details));
            return response(' ',200);

        } catch (\Exception $e) {
            info($e);
        }
    }


}
