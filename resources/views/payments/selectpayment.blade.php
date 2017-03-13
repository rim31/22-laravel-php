@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/payment') }}">
                    {!! csrf_field() !!}

                    <div class="form-group col-sm-12">
                        <h1>package</h1>
                        <select id="packageSku" type="text"  class="form-control inputForm left" name="packageSku"><option value="1" label="basic 50€/month ht"> </option>
                            <option value='2'>premium 80€/month ht </option>
                            <option value='3'>Excellium 150€/month ht</option>
                            <option value='4'>Lorem ipsum 300€/month ht</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <h2>Duration</h2>
                        <select id="packageQuantity" type="text"  class="form-control inputForm left" name="packageQuantity"><option value="1" label="1 month"> </option>
                            <option value='2'>2 months </option>
                            <option value='3'>3 months </option>
                            <option value='4'>4 months </option>
                            <option value='5'>5 months </option>
                            <option value='6'>6 months </option>
                            <option value='7'>7 months </option>
                            <option value='8'>8 months </option>
                            <option value='9'>9 months </option>
                            <option value='10'>10 months </option>
                            <option value='11'>11 months </option>
                            <option value='12'>12 months </option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input value="Payment" class="btn btn-primary" type="submit">
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <a href={{ url('/')}}><button class="btn btn-primary">home</button></a>
                </div>
            </div>
        </div>
    </div>


@endsection
{{--<div class="col-md-12">--}}
{{--<div class="form-group">--}}
{{--<input id="packageName" type="text" class="form-control inputForm left" name="packageName" value="basic" placeholder="name" maxlength="30">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-12">--}}
{{--<div class="form-group">--}}
{{--<label for="">n° du package (SKU)</label>--}}
{{--<input id="packageSku" type="text" class="form-control inputForm left" name="packageSku" value="1">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-12">--}}
{{--<div class="form-group">--}}
{{--<label for="">months quantity</label>--}}
{{--<input id="packageQuantity" type="text" class="form-control inputForm left" name="packageQuantity" value="1" >--}}
{{--</div>--}}
{{--</div>--}}