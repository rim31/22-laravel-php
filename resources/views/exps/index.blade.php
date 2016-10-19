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
                    {{ link_to_route('exp.create', 'Add new experience', null, ['class' => 'btn btn-success']) }}
                    <br>
                    <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                            <th>Hotspot</th>
                            <th>Photo</th>
                        </tr>
                        @foreach($users as $user)
                            @if($user->id_user == Auth::user()->id)
                                @foreach($exps as $exp)
                                <tr>
                                  @if($user->id_exp == $exp->id)
                                    <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                                    <td>
                                        {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                        {{ link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary']) }}
                                        |
                                        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        @if($exp->photo)
                                            <a class="btn btn-info" href="{{ url('hotspot') }}"> Hotspot</a></td>
                                        @else
                                            aucune photo
                                        @endif
                                    <td>
                                        @if($exp->photo)
                                            <a href="{{route('exp.photo.index',[$exp->id])}}"><img src="/img/{{$exp->id}}/{{$exp->photo}}" alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>
                                        @else
                                            {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
