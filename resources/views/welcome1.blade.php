@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">BIENVENUE</div>
				<div class="panel-body">
                     <table class="table">
                        <tr>
                            <th>Photo</th>
                            <th>Action</th>
                            <th>Editer</th>
                            <th>Numéro</th>
                        </tr>
                        <tr>
					<BR>
                    @foreach($exps as $exp)
					@foreach($joins as $join)
					@if($exp->id == $join->exp_id)
					@foreach($images as $image)
						@if($image->id == $join->image_id)
 						<td><img src="/img/{{$exp->id}}/{{$image->name}}" alt="{{$image->name}}" style="width:200px;height:100px;"/> </td>
						<td><a class="btn btn-info" href="{{ url('hotspot') }}"> Editer hotspot</a> </td>
						<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'DELETE')) !!}
					    <input type="text" name="image" value="{{$image->id}}" hidden>
						{!! Form::button('Delete photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!} </td>
						{!! Form::close() !!}
						</td>
						<td>
							{{$image->id}}
						</td>
						</tr>
						@endif
					@endforeach
					@endif
					@endforeach
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
