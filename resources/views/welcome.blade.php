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
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
						<tr>
 						<td>
							<img src="/img/ville1.jpg" href="{{ url('hotspot') }}" alt="immovr paris" style="width:200px;height:200px;"/>
						</td>
						<td>
							<img src="/img/ville2.jpg" href="{{ url('hotspot') }}" alt="immovr paris" style="width:200px;height:200px;"/>
						</td>
						<td>
							<img src="/img/ville3.jpg" href="{{ url('hotspot') }}" alt="immovr paris" style="width:200px;height:200px;"/>
						</td>
						<td>
							<img src="/img/ville4.jpg" href="{{ url('hotspot') }}" alt="immovr paris" style="width:200px;height:200px;"/>
						</td>
						</tr>
						<div class="col-sm-6">
							<img src="/img/ville5.jpg" href="{{ url('hotspot') }}" alt="immovr paris" style="width:400px;height:200px;"/>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
