@extends('layouts.app')
@section('content')


    <a href="{{$paypalUrl}}">{{$paypalUrl}}</a>

    <h1>{{$array->token}}</h1>
@endsection
