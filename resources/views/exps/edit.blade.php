@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Editer votre experience</div>

                <div class="panel-body">
                    <label>gallerie photos</label>
                    {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}
                    {!! Form::model($exp, array('route' => ['exp.update', $exp->id], 'method'=>'PUT')) !!}
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', 'Titre') !!}
                        {!! Form::text('name', null, ['class' =>'form-control']) !!}
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('about', 'informations') !!}
                            {!! Form::textarea('about', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'prix') !!}
                            {!! Form::text('price', null, ['class' =>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('adress', 'adresse') !!}
                            {!! Form::textarea('adress', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_owner', 'propriétaire') !!}
                            {!! Form::text('name_owner', null, ['class' =>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
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
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="photo">PHOTO</label> (obligatoire){!! Form::file('photo') !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="video">VIDEO</label> (optionnel){!! Form::file('video') !!}
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-success">Envoyer</button>
                        {!! Form::close() !!}
                        {{ link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-danger']) }}
                    </div>


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
