@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Experiences</div>

        <div class="panel-body">
          our form
          {!! Form::open(array('route' => 'account.store')) !!}


          on veut un formulaire pour editer le titre
          <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null, ['class' =>'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('adress', 'Adresse') !!}
            {!! Form::textarea('adress', null, ['class' =>'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('price', 'prix') !!}
            {!! Form::text('price', null, ['class' =>'form-control']) !!}
          </div>

          <button class="btn btn-primary">Envoyer</button>
          {!! Form::close() !!}

        </div>
      </div>
      @if($errors->has())
      <ul class="aler alert-danger">
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
      </ul>
      @endif
    </div>
  </div>
</div>
@endsection
