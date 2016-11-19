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
								<div class="h3"> Vos photos : {{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</div>
								<span>{{ link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'cartBtn Btn add']) }}</span>
							</div>
						</div>
						<div class="domainBtn clearfix flexButton">
							<div>
								@if ($exp->photo)
								{{ link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btn greenButton buttonPhoto']) }}
							</div>
							<div>									<!-- =====test Quartz===== -->
								{!! Form::open(array('route'=>['quartz'])) !!}
								<input type="text" name="exp" value="{{$exp->id}}" hidden>
								<input type="text" name="name" value="{{$exp->name}}" hidden>
								<input type="text" name="id" value="{{$exp->photo}}" hidden>
								{!! Form::button('Quartz  <i class="fa fa-video-camera fa-1x" aria-hidden="true"></i>', ['class'=>'Btn', 'type'=>'submit']) !!}
								<!-- =====/test Quartz===== -->
								{!! Form::close() !!}
							</div>
							<div>
								@else
								favoris d'abord
								@endif

								{{ link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default']) }}
							</div>



						</div>

					</li>
					@for ($i = 0; $i < sizeOf($joins); $i++)
					@if($joins[$i]->delete != 1)
					<li class="singleDomain animated">
						<div class="h4 photosList">
							<div>					
								<a href="">
									<img src="{{ URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG') }}" alt="immovr" class="imgIndex">
								</a>
							</div>
							<div class="buttonPhoto">
								{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btnCart Btn greenButton']) }}
							</div>
							<div class="singleDomainRight buttonPhoto">
								<span>
									@if ($joins[$i]->id == $exp->photo)
									<i class="fa fa-star fa-1x" aria-hidden="true"></i> favoris
									@else
									{!! Form::open(array('route'=>['cover'])) !!}
									<input type="text" name="exp" value="{{$exp->id}}" hidden>
									<input type="text" name="name" value="{{$exp->name}}" hidden>
									<input type="text" name="id" value="{{$joins[$i]->id}}" hidden>
									<div class="buttonPhoto">
										{!! Form::button('Choix  <i class="fa fa-star-o fa-1x" aria-hidden="true"></i>', ['class'=>'btnCart Btn btn-default', 'type'=>'submit']) !!}
										{!! Form::close() !!}
									</div>
									@endif
									<!-- {{ link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info']) }}-->
								</span>
								<div>
									{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
									<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
									{!! Form::button('Effacer la photo', ['class'=>'btnCart Btn added', 'onclick'=>"return(confirm('Etes-vous sûr de vouloir supprimer cette photo?'));", 'type'=>'submit']) !!}
									{!! Form::close() !!}
								</div>
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
	<!-- ==========upoload photo ============ -->
	<div class="domainCtaArea  animated">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="domainCta">
						<form action="{{ route('exp.photo.store', $exp->id)}}" method="post"
							enctype="multipart/form-data">
							<div class="fileInput">
								<span class="fileTxt">Glisser et déposer ou</span>
								<span class="fileSpan">
									<input type="file" name="file" id="file" class="inputfile">
									<label for="file">importer</label>
									<input type="text" name="id" value="{{$exp->id}}" hidden>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</span>
								<span class="fileTxt">votre image ici</span>
							</div>
							<div class="captcha" data-toggle="tooltip" data-placement="top" title="Active Me!"><span></span> I am not a robot</div>
							<input type="submit" value="envoyer la photo" class="btn btn-success">
							{{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btnCart Btn added']) }}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ==========/upoload photo ============ -->


	@endsection
