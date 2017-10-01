@if (Auth::user()->like_item($micropost->id))
    {!! Form::open(['route' => ['micropost.unlike', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('★を外す', ['class' => 'btn btn-warning btn-xs']) !!}
    {!! Form::close() !!}
@else    
    {!! Form::open(['route' => ['micropost.like', $micropost->id]]) !!}
        {!! Form::submit('★に登録', ['class' => 'btn btn-success btn-xs']) !!}
    {!! Form::close() !!}
@endif