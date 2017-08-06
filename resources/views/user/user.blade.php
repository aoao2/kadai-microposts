@if (count($user_a) > 0)
<ul class="media-list">
@foreach ($user_a as $user)
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>{{ $user->name }}</div>
            <div>
                <p>{!! link_to_route('users.show', 'View Profile', ['id' => $user->id]) !!}</p>
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $user_a->render() !!}
@endif
