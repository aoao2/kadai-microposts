@extends('layouts.app')

@section('content')
    @if (count($microposts) > 0)
        @include('micropost.micropost', ['microposts' => $microposts])
    @endif
@endsection