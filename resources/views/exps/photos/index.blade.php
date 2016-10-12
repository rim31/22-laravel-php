@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">OOO00  EXP.INDEX  OOOOO</div>
				@if(Session::has('message'))
				<div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif
				<div class="panel-body">


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
                                    <td><a class="btn btn-info" href="{{ url('hotspot') }}"> Hotspot</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
						<!-- <img src="/img/{{$exp->id}}/1.JPG" />
						<img src="/img/1/1.JPG" /> -->

                        @foreach($images as $image)
							{{ $image->name}}
						@endforeach
                        @foreach($joins as $join)
							{{ $join->exp_id}} / {{ $join->image_id}}
						@endforeach

				</div>
			</div>
			{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success']) }}
		</div>
	</div>
</div>

@endsection
