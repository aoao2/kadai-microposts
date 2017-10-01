<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('user.index', [
            'users' => $users]);
    }
    
    public function show($id) {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        $count_microposts = $user->microposts()->count();
        
        $data = [
            'user' => $user,
            'microposts' => $microposts
        ];
        
        $data += $this->counts($user);
        
            return view('user.show', $data);
    }
    
    public function following($id) {
        $user = User::find($id);
        $following = $user->followings()->paginate(10);
        
        $data = [
            'user_u' => $user,
            'user_f' => $following
        ];
        
        $data += $this->counts($user);
        
        return view('user.following', $data);
    }
    
    public function follower($id) {
        $user = User::find($id);
        $follower = $user->followers()->paginate(10);
        
        $data = [
            'user_u' => $user,
            'user_f' => $follower
        ];
        
        $data += $this->counts($user);
        
        return view('user.follower', $data);
    }
    
    public function liking() {
        $user = \Auth::user();
        $microposts = $user->liking()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts];
        
        return view('user.liking', $data);
    }
}