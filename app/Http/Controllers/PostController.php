<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($data);
        $users = User::where('notification_allowed', true)->get();
        Notification::send($users, new PostNotification($post));
        
        return redirect()->route('post.create')->with('success', 'Пост створено та нотифікації відправлено.');
    }
}