@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3>Hello!</h3>
            <p>Your new password is - <b>{{$password}}</b> </p>
        </div>
    </div>
@endsection
