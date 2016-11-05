@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Gallerie photos</div>
				@if(Session::has('message'))
				<div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif
				<div class="panel-body">
					<h2>{{ link_to_route('exp.photo.hotspot.index', $exp->name, [$exp->id, 0]) }}</h2>{{$exp->adress}}<BR>
						<BR>
							<div class="col-sm-8">
								{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success']) }}
							</div>
							<div class="col-sm-2">
								@if ($exp->photo)
								{{ link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btn btn-success']) }}
								@else
									favoris d'abord
								@endif
							</div>
							<div class="col-sm-2">
								{{ link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default']) }}
							</div>

							<table class="table">
								<tr>
									<th>Photo</th>
									<th>Editer</th>
									<th>Action</th>
									<th>Favoris</th>
									<th>Gallerie</th>
								<tr>
									@for ($i = 0; $i < sizeOf($joins); $i++)
									@if($joins[$i]->delete != 1)
									<td>	<!-- /img/{{$exp->id}}/{{$joins[$i]->id}}.PNG -->
										<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG') }}"
										alt="immovr" class="photo" style="width:100px;height:50px;">
										<!-- 	<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.JPG') }}"
										alt="immovr" class="photo" style="width:100px;height:50px;"> -->
									</td>
									<td>
										{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-primary']) }}
									</td>
									<td>
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
                                                <h4 class="modal-title" id="myModalLabel">Suppression de l'image</h4>
                                              </div>
                                              <div class="modal-body">
                                                Voulez-vous vraiment supprimer ?
												<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG') }}"
												alt="immovr" class="photo">
                                              </div>
                  								<div class="modal-footer" style="display: flex; flex-direction: row;" >
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		       									{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
												<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
												{!! Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>

									</td>
									{!! Form::close() !!}
									<td>
										@if ($joins[$i]->id == $exp->photo)
											favoris
										@else
											{!! Form::open(array('route'=>['cover'])) !!}
											<input type="text" name="exp" value="{{$exp->id}}" hidden>
											<input type="text" name="name" value="{{$exp->name}}" hidden>
											<input type="text" name="id" value="{{$joins[$i]->id}}" hidden>
											{!! Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
											{!! Form::close() !!}
										@endif
									</td>
									<td>
										{{ link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info']) }}
									</td>
									@endif
								</tr>
								@endfor
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
