@extends('layouts.app')

@section('content')
<DIV class="container">
    <DIV class="row">
        <DIV class="col-md-10 col-md-offset-1">
            <DIV class="panel panel-default">
                <DIV class="panel-heading">{{ $exp->name}}</DIV>

                <DIV class="panel-body">
                    Informations : </BR>
                    <h2>{{ $exp->about }}</h2>

                    address : </BR>
                    <h2>{{ $exp->adress }}</h2>

                    <DIV class="panel-body">
                    price :    </BR>
                    {{ $exp->price }} €
                    </DIV>
                    <DIV class="panel-body">
                    owner :    </BR>
                    {{ $exp->name_owner }}
                    </DIV>
                    <DIV class="form-group">
                        Surface {{ $exp->surface }}m²
                        | Room {{ $exp->room}}
                        | Level {{ $exp->level}}
                        |
                        @if(!$exp->parking)
                            no
                            @endif
                        Parking
                        @if(!$exp->elevator)
                            no
                        @endif
                        | Elevator
                        |
                        | Heat @if(!$exp->electicity)
                          Gas
                        @else
                          Electricity
                        @endif
                        | Class energy {{ $exp->class_nrj}}
                        | Class gaz {{ $exp->class_gaz }}
                        |
                        @if(!$exp->availability)
                            no
                        @endif
                        available


                    </DIV>
                    <DIV class="form-group">
                        Photo{!! Form::file('image') !!}
                    </DIV>
                    <DIV class="form-group">
                        video{!! Form::file('video') !!}
                    </DIV>

                    <button class="btn btn-primary">Envoyer</button>
                    {!! Form::close() !!}

                </DIV>
            </DIV>

        </DIV>
    </DIV>
</DIV>
@endsection
