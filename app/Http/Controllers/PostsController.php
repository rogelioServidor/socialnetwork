<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Relationship;
use Auth;

class PostsController extends Controller
{

	public function getHome(){
        $user = Auth::user()->id;
        $friendRequest = Relationship::whereNested(function($query){
                                $user = Auth::user()->id;
                                $query->where('user1','=', $user);
                                $query->orWhere('user2','=', $user);
                            })
                            ->where('action_user_id','!=',$user)
                            ->where('status_id','=',1)
                            ->get();
		$posts = Post::whereUserId($user)->orderBy('created_at','desc')->get();
    	return view('users.home', compact('posts','friendRequest'));
    }

    public function getPosts(){
        /*$user = Auth::user()->id;
        $posts = Post::whereUserId($user)->orderBy('created_at','desc')->get();
        return view('posts.posts', compact('posts'));
*/
        $posts = Post::orderBy('created_at','desc')->get();
        $relationships = Relationship::all();
        return view('posts.posts', compact('posts','relationships'));
    }

    public function getProfilePosts($userId){
        /*$posts = Post::orderBy('created_at','desc')->get();*/
        $posts = Post::whereUserId($userId)->get();
        return view('posts.profile_posts', compact('posts'));
    }

    public function addPost(Request $request){
    	Post::create($request->all());
    }
}
