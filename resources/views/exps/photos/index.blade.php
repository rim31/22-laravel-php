@extends('layouts.app')

@section('content')
<head>
	<link rel="stylesheet" href="{{ URL::asset('remodal/remodal.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('remodal/remodal-default-theme.css') }}">
	<script
	src="https://code.jquery.com/jquery-2.2.4.min.js"
	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous"></script>
</head>

<div class="headerBanner"></div>
<ul class="breadcrumbNav">
	<a class="breadcrumb1" href="{{ url('/') }}">{{ trans('photoindex.home')}}</a>
	<a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('photoindex.myexp')}}</a>
	<a class="breadcrumb3" href="{{route('exp.photo.index',[$exp->id])}}">{{ trans('photoindex.photo')}}</a>
</ul>
<div class="container">
	<div class="row">
		<div class="col-md-12 photoButtonSection">
			<div class="addMediaTips center">
				<div class="flexColSa">
					@if ($exp->photo && $vrButton)
					<div>
						{{ link_to_route('exp.photo.hotspot.show', trans('photoindex.editspt'), [$exp->id, $exp->photo, $exp->photo], ['class' => 'btn btn-green mrg3prct', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => trans('photoindex.tallhsps')]) }}
					</div>
					<div>
						{!! Form::open(array('route'=>['quartz'], $exp->id)) !!}
						<input type="text" name="exp" value="{{$exp->id}}" hidden>
						<input type="text" name="name" value="{{$exp->name}}" hidden>
						<input type="text" name="id" value="{{$exp->photo}}" hidden>
						{!! Form::button(trans('photoindex.btnvr'), ['class'=>'btn btn-quartz', 'type'=>'submit', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => trans('photoindex.tvr')]) !!}
					</div>
					{!! Form::close() !!}
				</div>
				@else
				<h1 class="blueTitle">{{ trans('photoindex.title') }}</h1>
				<p>{{ trans('photoindex.title1') }}</p>
				<p>{{ trans('photoindex.title2') }}</p>
				@endif
				<!-- ==========upload photo ============ -->
				<form action="{{ route('exp.photo.store', $exp->id)}}" method="post" enctype="multipart/form-data">
					<div class="fileInput" >
						<input type="file" name="file" id="file" class="inputfile" style="display:none" >
						<div class="flexAloneCenter">
							<label class="btn btn-blue mrg3prct" for="file">{{ trans('photoindex.add') }}</label>
						</div>
						<input type="text" name="id" value="{{$exp->id}}" hidden>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</div>
					<div class="col-md-12 center">
						<div id="image-holder"></div>
						<div class="col-md-12">
							<button type="submit" name="button" style="display: none !important;" value="Upload" class="uploadButton mrg5prct btn btn-green" id="buttonSendFile">{{ trans('photoindex.upload') }}</button>
						</div>
					</form>
				</div>
			</div>

			<!-- ================images index================== -->
			@for ($i = 0; $i < sizeOf($joins); $i++)
			@if($joins[$i]->is_delete != 1)
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="imgList">
					<a>
						@if ($joins[$i]->video != 1)
						<a href="{{route('exp.photo.hotspot.show',[$exp->id, $joins[$i]->id, $joins[$i]->id])}}">
							<img src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$joins[$i]->id.'.PNG') }}" alt="immovr" class="imgPreview"></a>
							@else
							<img src="{{ URL::asset('img/images/video.PNG') }}" alt="immovr" class="imgPreview">
							@endif
						</a>
						<div class="flexRowSa padding10px">
							<a href="{{route('exp.photo.hotspot.create',[$exp->id, $joins[$i]->id])}}"> <img class="fakeButton editButton" src="{{ URL::asset('img/images/spot.png') }}"
								alt="{{$exp->photo}}" data-toggle="tooltip" data-placement="top" title="Create a spot"/></a>
								@if ($joins[$i]->id == $exp->photo)
								<div>
									<img class="fakeButton editButton" src="{{ URL::asset('img/images/home.png') }}" alt="{{$exp->photo}}"/>
									<!-- Button trigger modal -->
								</div>
								@else
								<div>
									{!! Form::open(array('route'=>['cover'])) !!}
									<input type="text" name="exp" value="{{$exp->id}}" hidden>
									<input type="text" name="name" value="{{$exp->name}}" hidden>
									<input type="text" name="id" value="{{$joins[$i]->id}}" hidden>
									<button type="button submit" class="fakeButton deleteButton" >
										<img class="fakeButton deleteButton" src="{{ URL::asset('img/images/noHome.png') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('photoindex.tfav') }}"/>
									</button>
									{!! Form::close() !!}

								</div>

								@endif
								<div>
									<a data-remodal-target="modal-{{$joins[$i]->id}}"><img class="fakeButton deleteButton" src="{{ URL::asset('img/images/delete.png') }}"  alt="{{$joins[$i]->id}}" data-toggle="tooltip" data-placement="top" title="{{ trans('photoindex.tdel') }}"/></a>
								</div>
							</div>
							<!-- //////////////////RE-MODAL////////////////    -->
							<div class="remodal" data-remodal-id="modal-{{$joins[$i]->id}}" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

								<button data-remodal-action="close" class="remodal-close"></button>
								<p>{{ trans('photoindex.alert') }}</p>
								<p>
									<img src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$joins[$i]->id.'.PNG') }}" alt="immovr" class="imgPreview center">
								</p>
								<br>
								<div class="wrapButton">
									<div>
										{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')) !!}
										<input type="text" name="image" value="{{$joins[$i]->id}}" hidden>
										{!! Form::button( trans('photoindex.alertconfirm') , ['class'=>'btn btn-red', 'type'=>'submit', 'value' => $exp->id]) !!}
										{!! Form::close() !!}
									</div>
									<div>
										<button data-remodal-action="cancel" class="btn btn-grey">{{trans('photoindex.cancel')}}</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endfor
				</div>
			</div>
		</div>

		@endsection


		<script>

		window.onload = function() {
			if (window.jQuery) {
				$("#file").change(function (){
					var fileName = $(this).val();
					//alert(fileName);
					$('#buttonSendFile').css("display", 'inline');
				});


				// Script for the preview of input file images

				$(document).ready(function() {
					$(".inputfile").on('change', function() {
						//Get count of selected files
						var countFiles = $(this)[0].files.length;
						var imgPath = $(this)[0].value;
						var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
						var image_holder = $("#image-holder");
						image_holder.empty();
						if (extn == "mp4" || extn == "png" || extn == "jpg" || extn == "jpeg") {
							if (typeof(FileReader) != "undefined") {
								//loop for each file selected for uploaded.
								for (var i = 0; i < countFiles; i++)
								{
									var reader = new FileReader();
									reader.onload = function(e) {
										$("<img />", {
											"src": e.target.result,
											"class": "thumbImage"
										}).appendTo(image_holder);
									}
									image_holder.show();
									reader.readAsDataURL($(this)[0].files[i]);
								}
							} else {
								alert("The browser does not support this format");
							}
						} else {
							alert("Please select a picture / video");
						}
					});
				});

			} else {
				// jQuery is not loaded
				alert("Doesn't Work");
			}
		}
		</script>
