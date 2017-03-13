@extends('layouts.app')

@section('content')

<div class="animate-box">
  <div class="container">
    <div class="row loginForm">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="blueTitle center mrg5prct">{{ trans('login.reset') }}</div>
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{ trans('login.mail') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

              @if ($errors->has('email'))
              <strong>{{ $errors->first('email') }}</strong>
              @endif
            </div>
          </div>
          <div class="form-group wrapbutton center">
            <button type="submit" class="btn btn-blue">{{ trans('login.send') }}</button>

        </form>
        <button type="submit" class="btn btn-grey">
          <a href="{{ url('/user/reactivation') }}">{{ trans('login.resend') }}</a>
        </button>
      </div>
      </div>
    </div>
  </div>
</div>

@endsection
