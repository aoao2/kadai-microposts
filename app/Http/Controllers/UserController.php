<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(3);
        return view('user.index', [
            'user_p' => $users]);
    }
    
    public function show($id) {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(3);
        $count_microposts = $user->microposts()->count();
        
        $data = [
            'user_s' => $user,
            'microposts_s' => $microposts
        ];
        
        $data += $this->counts($user);
        
        return view('user.show', $data);
    }
}