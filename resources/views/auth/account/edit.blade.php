@extends('layouts.app')

@section('content')
<head>
	<link rel="stylesheet" href="{{ URL::asset('remodal/remodal.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('remodal/remodal-default-theme.css') }}">
</head>

<div class="headerBanner"></div>
	<ul class="breadcrumbNav">
		<a class="breadcrumb1" href="">{{ trans('account.home')}}</a>
		<a class="breadcrumb2" href="{{ url('/') }}">{{ trans('account.myaccount')}}</a>
		<a class="breadcrumb3">{{ trans('account.edition') }}</a>
	</ul>
	<div class="container headerExp">
		<div class="row">
			<div class="col-md-12 text-center" data-animate-effect="fadeIn">
				<div class="col-md-12">
				</div>
			</div>
			<!-- ===========message success / alert =============== -->
			@if(Session::has('message'))
			<div class="alert alert-success">{{ Session::get('message') }}</div>
			@endif
			@if($errors->has())
			<ul class="aler alert-danger">
				@foreach($errors->all() as $error)
				<li>{{ $error}}</li>
				@endforeach
			</ul>
			@endif

			<div class="container">
				<div class="row expBloc">
					<div class="col-xs-12 col-sm-6 ">
						<h1 class="blueTitle">{{ trans('account.change') }}</h1>
						{!! Form::model($users, array('route' => ['account.update', $users[0]->id], 'method'=>'PUT')) !!}
						<div class="form-group col-sm-12">
							<p>{{ trans('account.name') }}</p>
							{!! Form::text('name', $users[0]->name, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.email') }}</p>
							{!! Form::email('email', $users[0]->email, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.phone') }}</p>
							{!! Form::text('phone', $users[0]->phone, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.society') }}</p>
							{!! Form::text('society', $users[0]->society, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.adress') }}</p>
							{!! Form::text('adress', $users[0]->adress, ['class' =>'form-control contactInput ','maxlength' => '255']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>City</p>
							{!! Form::text('town', $users[0]->town, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.country') }}</p>
							{!! Form::text('country', $users[0]->country, ['class' =>'form-control contactInput ','maxlength' => '50']) !!}
						</div>
						<div class="form-group col-sm-12">
							<p>{{ trans('account.iban') }}</p>
							{!! Form::text('iban', $users[0]->iban, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
						</div>
						<div class="col-md-12 col-sm-6">
							<div class="wrapButton mBot15">
								<div class="center mBot15">
									<button class="btn btn-blue">{{ trans('account.modify') }}</button>
									{!! Form::close() !!}
								</div>
								<div class="col-md-1"></div>
								<div class="center">
									<a data-remodal-target="modal-{{$users[0]->id}}" class="btn btn-red"><span>{{ trans('account.delete') }}</span></a>

									<!-- //////////////////RE-MODAL////////////////    -->
									<div class="remodal" data-remodal-id="modal-{{$users[0]->id}}"
										data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

										<button data-remodal-action="close" class="remodal-close"></button>
										<p>
											{{ trans('account.alert') }} {{$users[0]->name}} ?
										</p>
										<br>
										<div class="wrapButton">
											<div>
												{!! Form::open(array('route'=>['account.destroy', $users[0]->id], 'method'=>'DELETE')) !!}
												{!! Form::button(trans('account.alertconfirm'), ['class'=>'btn btn-blue', 'type'=>'submit', 'value' => $users[0]->id]) !!}
												{!! Form::close() !!}
											</div>
											<div>
												<button data-remodal-action="cancel" class="btn btn-red">{{ trans('account.cancel') }}</button>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 ">
						<!-- ========================== Package =========================== -->
						<div class="col-md-12 packageSection">
							<h1 class="whiteTitle">{{ trans('account.package') }}</h1>
							<p>{{ trans('account.date') }} {{$mytime}}</p>
							<p>{{ trans('account.number') }} {{$nbexps}}</p>
							<p>{{ trans('account.maxepx') }} {{$maxexp}}</p>
							<p>{{ trans('account.currentpack') }} {{$nbexps}}</p>
						</div>
						<!-- ========================== /Package =========================== -->

						<div class="col-md-12 packageSection mTop15 mBot15" data-animate-effect="fadeIn">
							<h1 class="whiteTitle">{{ trans('account.packembed') }}</h1>
							<p class="wrapButton"><a href="{{ url('/contact') }}" class="btn btn-blue">Contact Me</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection
