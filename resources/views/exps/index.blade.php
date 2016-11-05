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
                    {{ link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'btn btn-success']) }}
                    <br>
                    <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                            <th>Vue (en cours)</th>
                            <th>Gallerie</th>
                            <th>Lien</th>
                        </tr>
                        @foreach($users as $user)
                            @if($user->id_user == Auth::user()->id)
                                @foreach($exps as $exp)
                                <tr>
                                  @if($user->id_exp == $exp->id AND $exp->delete != 1)
                                    <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                                    <td>
                                        {{ link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btn btn-primary']) }}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                          Supprimer
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Suppression de l'expérience</h4>
                                              </div>
                                              <div class="modal-body">
                                                Voulez-vous vraiment supprimer ?
                                                <br>
                                                {{$exp->name}}
                                              </div>
                                                <div class="modal-footer" style="display: flex; flex-direction: row;" >
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                                {!! Form::button('Effacer', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                                {!! Form::close() !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    </td>
                                    <td>
                                        @if($exp->photo)
                                            <a class="btn btn-info" href="{{ url('hotspot') }}"> Hotspot</a></td>
                                        @else
                                            aucune photo
                                        @endif
                                    <td>
                                        @if($exp->photo)
                                            <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}"
                                            alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>

                                        @else
                                            {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}
                                        @endif
                                    </td>
                                    <td>
                                        "embed"
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>

                    <!-- pagination-->
                    {{ $exps->links() }}

                </div>
            </div>
        </div>
    </div>
</div>




@endsection
