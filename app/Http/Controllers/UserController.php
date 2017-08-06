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
        return view('user.show', [
            'user_s' => $user]);
    }
}