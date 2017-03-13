@extends('layouts.app')

@section('content')

<div class="animate-box">
  <div class="container">
    <div class="row loginForm">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <h1 class="center">{{ trans('login.welcome') }}</h1>
        <p class="center">{{ trans('login.enter') }}<br/>{{ trans('login.if') }}</p>
        <div class="encadre">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-12">{{ trans('login.email') }}</label>

              <div class="col-md-12 col-xs-12">
                <input id="email" type="email" class="form-control inputForm left" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password"  class="col-md-12">{{ trans('login.password') }}</label>
              <div class="col-md-12 col-xs-12">
                <input id="password" type="password" class="form-control inputForm" name="password">
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-4 mBot15 center">
                <button type="submit">
                  <div class="btn btn-blue">
                    <span>{{ trans('login.login') }}</span>
                  </div>
                </div>
              </button>
              <div class=" col-md-4">
              </div>
            </div>
            <div class="row">
              <div class=" col-md-4">
              </div>
              <div class=" col-md-4 center">
                <a class="btn btn-grey" href="{{ url('/password/reset') }}">{{ trans('login.forget') }}</a>
              </div>
              <div class=" col-md-4">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
