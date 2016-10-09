@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>
                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                        </tr>
                        @foreach($exps as $exp)
                        <tr>
                            <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                            <td>
                                {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                     {{ link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary']) }}
                                |
                                    {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach 
                    </table>            
                </div>
            </div>
            {{ link_to_route('exp.create', 'Add new experience', null, ['class' => 'btn btn-success']) }}
        </div>
    </div>
</div>
@endsection
