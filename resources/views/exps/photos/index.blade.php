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
					<h1>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</h1>{{$exp->adress}}<BR>
					<BR>
					{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success']) }}
                     <table class="table">
                        <tr>
                            <th>Photo</th>
                            <th>Action</th>
                            <th>Editer</th>
                            <th>Photo de couverture</th>
                        </tr>
                        <tr>
					<BR>
					@foreach($joins as $join)
					@if($exp->id == $join->exp_id)
					@foreach($images as $image)
						@if($image->id == $join->image_id)
 						<td><img src="/img/{{$exp->id}}/{{$image->name}}" alt="/img/{{$exp->id}}/{{$image->name}}" style="width:200px;height:100px;"/> </td>
						<td><a class="btn btn-info" href="{{ url('hotspot') }}"> Editer hotspot</a> </td>
						<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'DELETE')) !!}
					    <input type="text" name="image" value="{{$image->id}}" hidden>
						{!! Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!} </td>
						{!! Form::close() !!}
						</td>
						<td>
							@if(!$image->cover_image)
							{!! Form::open(array('route'=>['cover', $exp->id, $image->id], 'method'=>'POST'))!!}
							<input type="text" name="exp" value="{{$exp->id}}" hidden>
							<input type="text" name="photo" value="{{$image->id}}" hidden>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{!! Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
							{!! Form::close() !!}
							exp n°{{$exp->id}}
							photo n°{{$image->id}}
							@else
							<td><img src="/img/{{$exp->id}}/{{$image->name}}" alt="/img/{{$exp->id}}/{{$image->name}}" style="width:200px;height:100px;"/> </td>
							@endif

						</td>
						</tr>
						@endif
					@endforeach
					@endif
					@endforeach


				</div>
			</div>
		</div>
	</div>
</div>

@endsection
