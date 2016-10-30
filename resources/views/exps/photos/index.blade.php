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
							<div class="col-sm-10">
								{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success']) }}
							</div>
							<div class="col-sm-2">
								{{ link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default']) }}
							</div>

							<table class="table">
								<tr>
									<th>Photo</th>
									<th>Action</th>
									<th>Editer</th>
									<th>Photo de couverture</th>
								</tr>
								<tr>
									@for ($i = 0; $i < sizeOf($joins); $i++)
									@if($joins[$i]->delete != 1)
									<td>
										/img/{{$exp->id}}/{{$joins[$i]->id}}.JPG
										<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.JPG') }}"
										alt="immovr" class="photo" style="width:200px;height:100px;">
									</td>
									<td>
										{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-info']) }}
									</td>
									<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
										<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
										{!! Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
									</td>
									{!! Form::close() !!}
									<td>
										{!! Form::open(array('route'=>['cover', $exp->id, $joins[$i]->id])) !!}
										{!! Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
										{!! Form::close() !!}
										{{ link_to_route('exp.photo.hotspot.index', 'gallerie', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-info']) }}
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
