@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user_s->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user_s->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user_s])
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user_s->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user_s->id]) }}">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('user.following', ['id' => $user_s->id]) }}">Followings <span class="badge">{{ $count_following }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('user.follower', ['id' => $user_s->id]) }}">Followers <span class="badge">{{ $count_follower }}</span></a></li>
            </ul>
            @if (count($microposts_s) > 0)
                @include ('micropost.micropost', ['microposts_t' => $microposts_s])
            @endif
        </div>
    </div>
@endsection