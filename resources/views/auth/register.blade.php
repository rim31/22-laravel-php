@extends('layouts.app')

@section('content')
<div class="animate-box">
  <div class="container fullPageLogin">
    <div class="row registerForm">
      <div class="col-md-2"></div>
      <div class="col-md-8 ">
        <h1 class="center">{{ trans('register.welcome') }}</h1>
        <p class="center">{{ trans('register.title') }}</p>
        <div class="encadre">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class=" col-md-12">{{ trans('register.name') }}</label>

              <div class="col-md-12">
                <input id="name" type="text" class="form-control inputForm" name="name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-12">{{ trans('register.email') }}</label>

              <div class="col-md-12">
                <input id="email" type="email" class="form-control inputForm" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-12">{{ trans('register.password') }}</label>

              <div class="col-md-12">
                <input id="password" type="password" class="form-control inputForm" name="password">

                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password-confirm" class="col-md-12">{{ trans('register.confpass') }}</label>

              <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control inputForm" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <!-- ============= IP ======== contournable avec un proxy ou autre-->
            <input id="ip" type="text" name="ip" value={{Request::ip()}}  hidden>
            @if ($errors->has('ip'))
            <span class="help-block">
              <strong>{{ $errors->first('ip') }}</strong>
            </span>
            @endif

            <!-- ====================/IP======================= -->

            <div class="form-group ">
              <div class="col-md-12 center">
                <button type="submit" class="btn btn-blue">
                  {{ trans('register.register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
