@extends('layouts.app')
@section('content')
  <div class="animate-box">
    <div class="container">
      <div class="row loginForm">
        <div class="col-md-2"></div>
        <div class="col-md-8">
      <h2>{{ trans('layout.error') }}</h2>
      <p>{{ trans('layout.some') }}</p>
      <p>
        @if (!Auth::guest())
        <a href="{{ url('/login') }}" class="btn btn-blue">{{ trans('layout.login') }}</a>
        @endif
        <a href="{{ url('/register') }}" class="btn btn-grey ">{{ trans('layout.register') }}</a></p>
      </div>
    </div>
  </div>
  </div>

  @endsection
