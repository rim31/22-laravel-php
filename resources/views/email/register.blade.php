<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ trans('login.registration3') }}</title>
</head>
<body>
	<h1>{{ trans('login.registration3') }}</h1>

	<div>
		{{ trans('login.registration5') }}
		<br>
		<a href="{{ url('/') . '/user/activation/' }}{{$token}}">
			<button>{{ trans('login.registration4') }}</button>
		</a>

	</div>

	<!-- =============== Quartz presentation =========== -->

	<!-- <div class="fh5co-cta"  style="background-color: none;"> -->
	<div class="fh5co-cta">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 ctaCol">
					<div class="ctaLeft ctaTxt">
						<div class="ctaCell">
							<h2 class="fh5co-heading white">{{ trans('login.registration6') }}</h2>
							<br>
							<p>{{ trans('login.registration7') }}<br>
							<a href="{{ url('/') }}" class="exempleQwartz"><p>{{ trans('login.registration8') }}</p></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ===============/Quartz presentation =========== -->
</body>
</html>
