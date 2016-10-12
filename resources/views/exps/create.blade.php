@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>

                <div class="panel-body">
                    {!! Form::open(array('route' => 'exp.store')) !!}


                   Nouvelle expérience
                    <div class="form-group">
                        {!! Form::label('name', 'Title') !!}
                        {!! Form::text('name', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('adress', 'adress') !!}
                        {!! Form::textarea('adress', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'price') !!}
                        {!! Form::text('price', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name_owner', 'propriétaire') !!}
                        {!! Form::text('name_owner', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        Surface(m²) {!! Form::selectRange('surface', 1, 9999)!!}
                        | Room {!! Form::selectRange('room', 1, 20)!!}
                        | Level {!! Form::selectRange('level', 1, 20)!!}
                        | Parking{{ Form::checkbox('parking', '1') }}
                        | Elevator{{ Form::checkbox('lift', '1') }}
                        | Heat electricity{{ Form::checkbox('electricity', '1') }}
                        | Class energy {!! Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | Class gaz {!! Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | dispo{{ Form::checkbox('availability', '1') }}

                    </div>
                    <div class="form-group">
                        Photo{!! Form::file('image') !!}
                    </div>
                    <div class="form-group">
                        video{!! Form::file('video') !!}
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
