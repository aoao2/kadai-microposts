@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user_u->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user_u->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user_u])
        </aside>
    <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user_u->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user_u->id]) }}">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/following') ? 'active' : '' }}"><a href="{{ route('user.following', ['id' => $user_u->id]) }}">Followings <span class="badge">{{ $count_following }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/follower') ? 'active' : '' }}"><a href="{{ route('user.follower', ['id' => $user_u->id]) }}">Followers <span class="badge">{{ $count_follower }}</span></a></li>
            </ul>
            @include ('user.user', ['users' => $user_f])
        </div>
    </div>
@endsection