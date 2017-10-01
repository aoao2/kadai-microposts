@extends('layouts.app')

@section('content')
    @include('user.user', ['users' => $users])
@endsection