@extends('layouts.app')

@section('content')

<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="h3">Expérience</div>
				<ul class="pageIndicate">
					<li><a href="">photo</a></li>
					<li><a href="">index</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

@if(Session::has('message'))
<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<!-- ======= 3.01 Domain Area ====== -->
<div class="domainSearchArea secPdng">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			</div>
			<div class="col-md-10 col-md-offset-1 clearfix">

			</div>
			<div class="col-md-12">
				<ul class="domains">
					<li class="availableDomain clearfix  animated">
						<div class="aDomainLeft clearfix">
							<div class="DomainName">
								<div class="h3"> Vos photos : {{ link_to_route('exp.photo.hotspot.index', $exp->name, [$exp->id, 0]) }}</div>
								<span>{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'cartBtn Btn add']) }}</span>
							</div>
						</div>
						<div class="domainBtn clearfix">         
							@if ($exp->photo)
							{{ link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btnCart Btn']) }}
							@else
							favoris d'abord
							@endif

							{{ link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default']) }}
						</div>

					</li>
					@for ($i = 0; $i < sizeOf($joins); $i++)
					@if($joins[$i]->delete != 1)
					<li class="singleDomain  animated">
						<div class="h4">
								<a href="">
									<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG') }}" alt="immovr" class="photo" style="width:199px;height:99px;">
								</a>
								{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'cartBtn add']) }}
							<div class="singleDomainRight">
								<span>
									@if ($joins[$i]->id == $exp->photo)
									<i class="fa fa-star" aria-hidden="true"></i> favoris
									@else
									{!! Form::open(array('route'=>['cover'])) !!}
									<input type="text" name="exp" value="{{$exp->id}}" hidden>
									<input type="text" name="name" value="{{$exp->name}}" hidden>
									<input type="text" name="id" value="{{$joins[$i]->id}}" hidden>
									{!! Form::button('Choix  <i class="fa fa-star-o" aria-hidden="true"></i>', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
									{!! Form::close() !!}
									@endif
	<!-- {{ link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info']) }} -->
								</span>
								<span>
									{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
									<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
									{!! Form::button('Effacer la photo', ['class'=>'btnCart Btn added', 'type'=>'submit']) !!}
									{!! Form::close() !!}
								</span>
							</div>
						</div>
					</li>
					@endif
					@endfor
					</ul>
				</div>
			</div>
		</div>
		</div

		
<!-- ======= /3.01 Domain Area ====== -->

    <div class="sectionBar"></div>






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
<!-- 									<th>Gallerie</th>
-->								<tr>
@for ($i = 0; $i < sizeOf($joins); $i++)
@if($joins[$i]->delete != 1)
<td>
	<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG') }}"
	alt="immovr" class="photo" style="width:100px;height:50px;">

</td>
<td>
	{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-primary']) }}
</td>
<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
	<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
	{!! Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
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
<!-- 									<td>
										{{ link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info']) }}
									</td> -->
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
