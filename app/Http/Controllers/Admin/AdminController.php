<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Report;
use App\Notifications\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();
        $recentPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPosts',
            'totalComments',
            'recentPosts'
        ));
    }

    public function users()
    {
        $users = User::paginate(8);

        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function posts()
    {
        $posts = Post::with('user')->paginate(8);

        return view('admin.posts', compact('posts'));
    }

    public function destroyBlog(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Blog deleted.');
    }

    public function comments()
    {
        $comments = Comment::with('user', 'post')->latest()->paginate(30);
        return view('admin.comments', compact('comments'));
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function reports()
    {
        // Example: posts that have reports relationship or flag
        // $reported = Post::where('reports_count', '>', 0)->with('user')->latest()->paginate(20);
        $reportedPosts = Report::with('user', 'post', 'post.user')
            ->get()
            ->groupBy('post_id');

        return view('admin.reports', compact('reportedPosts'));
    }

    public function broadcast()
    {
        return view('admin.broadcast');
    }

    public function sendBroadcast(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:10',
            'message' => 'required|string|max:100'
        ]);

        $users = User::all();

        // save broadcast
        $broadcast = Broadcast::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'total_send' => $users->count(),
            'send_at' => now(),
        ]);

        Notification::send($users, new Announcement($broadcast));

        return back()->with('success', 'Broadcast sent.');
    }

    public function analytics()
    {
        // generate small data set for cards / charts
        $usersPerDay = User::selectRaw('DATE(created_at) as day, count(*) as c')
            ->groupBy('day')->orderBy('day', 'desc')->limit(7)->get()->reverse();

        return view('admin.analytics', compact('usersPerDay'));
    }
}
