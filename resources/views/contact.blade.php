@extends('layouts.app')
@section('content')

<div class="headerMap">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.225837406204!2d2.227936716088351!3d48.87297117928893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e664d92ff348fd%3A0x63df663e06384a84!2s22+Rue+Edouard+Nieuport%2C+92150+Suresnes!5e0!3m2!1sen!2sfr!4v1486568413357" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<div class="container">
  <div class="row contactForm">
    <div class="col-md-12">
      <div class="col-md-3">
        <ul class="contact-info">
          <li><i class="icon-map"></i>{{ trans('contact.adress')}}</li>
          <li><i class="icon-phone"></i>{{ trans('contact.tel')}}</li>
          <li><i class="icon-envelope"></i><a href="">{{ trans('contact.mail')}}</a></li>
          <li><i class="icon-globe"></i><a href="">{{ trans('contact.site')}}</a></li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="row">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/contact') }}">
            {{ csrf_field() }}
            <div class="col-md-12">
              <div class="form-group">
                <input id="name" type="name" class="form-control inputForm left" name="name" value="{{ old('name') }}" placeholder={{ trans('contact.name')}} maxlength="30">
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input id="email" type="email" class="form-control inputForm left" name="email" value="{{ old('email') }}" placeholder="{{ trans('contact.email')}}" maxlength="30">
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea id="message" type="textarea" class="form-control inputForm left" name="message" value="{{ old('message') }}" placeholder="{{ trans('contact.message')}}" cols="30" rows="7" maxlength="99"></textarea>
                @if ($errors->has('message'))
                <span class="help-block">
                  <strong>{{ $errors->first('message') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-blue" name="button">{{ trans('contact.sendmessage')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <table class="table mBot15">
        <thead>
          <tr class="success">
            <th><b>{{ trans('contact.option_1')}}</b></th>
            <th><b>{{ trans('contact.month')}}</b></th>
            <th><b>{{ trans('contact.year')}}</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><p>{{ trans('contact.basic')}} :</p>{{ trans('contact.10exp')}}</td>
            <td>{{ trans('contact.50e')}}</td>
            <td>{{ trans('contact.600e')}}</td>
          </tr>
          <tr class="active">
            <td><p>{{ trans('contact.prenium')}} :</p>{{ trans('contact.20exp')}}</td>
            <td>{{ trans('contact.80e')}}</td>
            <td>{{ trans('contact.960e')}}</td>
          </tr>
          <tr>
            <td><p>{{ trans('contact.excellium')}} :</p>{{ trans('contact.50exp')}}</td>
            <td>{{ trans('contact.150e')}}</td>
            <td>{{ trans('contact.1800e')}}</td>
          </tr>
          <tr class="active">
            <td><p>{{ trans('contact.ultimium')}} :</p>{{ trans('contact.100exp')}}</td>
            <td>{{ trans('contact.300e')}}</td>
            <td>{{ trans('contact.3600e')}}</td>
          </tr>
          <tr>
            <td>{{ trans('contact.more')}}</td>
            <td>-</td>
            <td>-</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <table class="table mBot15">
        <thead>
          <tr class="success">
            <th><b>{{ trans('contact.option_2')}}</b></th>
            <th><b>{{ trans('contact.pack_2a')}}</b>{{ trans('contact.pack_2b')}}</th>
            <th><b>{{ trans('contact.month')}}</b></th>
            <th><b>{{ trans('contact.year')}}</b></th>
          </tr>
        </thead>
        <tbody>
          <tr class="active">
            <td>{{ trans('contact.name')}}</td>
            <td>{{ trans('contact.pack_player')}}</td>
            <td>-</td>
            <td>-</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <table class="table mBot15">
        <thead>
          <tr class="success">
            <th><b>{{ trans('contact.equipment')}}</b>{{ trans('contact.packageVR')}}</th>
            <th><b>{{ trans('contact.price')}}</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><p>- {{ trans('contact.samsunggear')}}</p>
              <p>- {{ trans('contact.tripod')}}</p>
              <p>- {{ trans('contact.manuel')}}</p>
            </td>
            <td>- </td>
          </tr>
          <tr class="active">
            <td><p>- {{ trans('contact.samsungs6')}}</p>
              <p>- {{ trans('contact.samsunggear')}}</p>
              <p>- {{ trans('contact.tripod')}}</p>
              <p>- {{ trans('contact.manuel')}}</p>
            </td>
            <td>- </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
