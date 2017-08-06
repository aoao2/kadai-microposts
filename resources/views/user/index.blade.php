@extends('layouts.app')

@section('content')
    @include('user.user', ['user_a' => $user_p])
@endsection