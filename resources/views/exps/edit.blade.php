@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update experiences</div>

                <div class="panel-body">
                    <label>gallerie photos</label>
                    {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}



                    {!! Form::model($exp, array('route' => ['exp.update', $exp->id], 'method'=>'PUT')) !!}

                    Editer votre expérience
                    <div class="form-group">
                        {!! Form::label('name', 'Titre') !!}
                        {!! Form::text('name', null, ['class' =>'form-control']) !!}
                    </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('adress', 'Adresse') !!}
                        {!! Form::textarea('adress', null, ['class' =>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        {!! Form::label('price', 'Prix (€)') !!}
                        {!! Form::text('price', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name_owner', 'Contact') !!}
                        {!! Form::text('name_owner', null, ['class' =>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        Surface(m²) {!! Form::selectRange('surface', 1, 9999)!!}
                        | Pièce {!! Form::selectRange('room', 1, 20)!!}
                        | niveau {!! Form::selectRange('level', 1, 20)!!}
                        | Parking{{ Form::checkbox('parking', '1') }}
                        | Ascenceur{{ Form::checkbox('lift', '1') }}
                        | chauffage elec{{ Form::checkbox('electricity', '1') }}
                        | Class energie {!! Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | Class gaz {!! Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | dispo{{ Form::checkbox('availability', '1') }}
                    </div>
                </div>

                    <div class="form-group">
                        <label for="">Photo</label>{!! Form::file('image') !!}
                    </div>
                    <div class="form-group">
                        video{!! Form::file('video') !!}
                    </div>
                    <button class="btn btn-primary">Envoyer</button>

                    <h1>photo upload</h1>

                    {!! Form::close() !!}

                    <form action="{{ URL::to('upload')}}" method="post" enctype="multipart/form-data">
                        <label>up une photo</label>
                        <input type="file" name="file" id="file">
                        <input type="submit" name="submit" value="upload">
                        <input type="text" name="id" value="{{$exp->id}}" hidden>
                            {{$exp->id}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>



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




