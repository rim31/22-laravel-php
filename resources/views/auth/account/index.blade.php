@extends('layouts.app')

@section('content')

<div id="best-deal">
  <div class="container headerExp">
    <div class="row">

      <div class="col-md-12 text-center fh5co-heading" data-animate-effect="fadeIn">
        <div class="col-md-12 titleExp whiteWallpaper">
          <h1 class="wordBreak left">My account</h1>
          <ul class="pageIndicate left">
            <a href="">Home ></a>
            <a href="{{ url('/') }}">Account ></a>
            <a>Edit</a>
          </ul>
          <div class="wrapButton">
            <div>{{ link_to_route('account.edit', 'edit', $users[0]->id, ['class' => 'btn btn-primary']) }}</div>
            <div>{{ link_to_route('account.edit', 'delete', $users[0]->id, ['class' => 'btn btn-danger']) }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Account</div>

          <div class="panel-body">
            <table class="table">
              <tr>
                <th>Name</th>
                <th>your account</th>
              </tr>
              @foreach($users as $user)
              <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <td>Firstname</td>
                <td>{{ $user->firstname }}</td>
              </tr>
              @endforeach
              <p>name : {{ $user->name }}</p>
              <p>firstname : {{ $user->firstname }}</p>
              <p>email : {{ $user->email }}</p>
              <p>phone : {{ $user->phone }}</p>
              <p>society : {{ $user->society }}</p>
              <p>adress : {{ $user->adress }}</p>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
