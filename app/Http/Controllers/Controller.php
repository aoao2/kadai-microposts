<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_microposts = $user->microposts()->count();
        $count_following = $user->followings()->count();
        $count_follower = $user->followers()->count();
        return [
            'count_microposts' => $count_microposts,
            'count_following' => $count_following,
            'count_follower' => $count_follower
        ];
    }
}
