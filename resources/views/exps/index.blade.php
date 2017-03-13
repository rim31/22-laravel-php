@extends('layouts.app')
@section('content')

<head>
  <link rel="stylesheet" href="{{ URL::asset('remodal/remodal.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('remodal/remodal-default-theme.css') }}">
</head>

<div class="headerBanner"></div>
<ul class="breadcrumbNav">
  <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('expindex.home')}}</a>
  <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('expindex.myexp')}}</a>
  <a class="breadcrumb3">{{ trans('expindex.index') }}</a>
</ul>

<div class="container">
  <div class="row">
    <div class="newExpBtnDiv center">{{ link_to_route('exp.create', trans('expindex.newexp'), null, ['class' => 'btn btn-blue']) }}</div>
    <div class="row">

      @foreach($exps as $exp)
      <div class="col-md-3 expCards">
        <div class="cardsContent">
          <!-- ============image=========== -->
          @if($exp->photo)
          <a href="{{route('exp.photo.index',[$exp->id])}}">
            <img src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$exp->photo.'.PNG') }}" alt="{{$exp->photo}}" class="imgExpCard"></a>
            @else
            <a href="{{route('exp.photo.index',[$exp->id])}}">
              <img src="{{ URL::asset('img/images/noPhoto.png') }}" alt="{{$exp->photo}}" class="imgExpCard"></a>
              @endif
              <!-- ============image=========== -->
              <div class="m15">
                <h3 class="cardsTitleExp"><a href="#">{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</a></h3>
                <p class="cardsInfosExp">{{ link_to_route('exp.show', $exp->about, [$exp->id]) }}</p>

                <p class="flexRowSa cardsInfosBtn">
                  <a href="{{route('exp.edit',[$exp->id])}}"> <img class="fakeButton editButton" src="{{ URL::asset('img/images/edit.png') }}"
                    alt="{{$exp->photo}}"/></a>
                    <a href="{{route('exp.photo.index',[$exp->id])}}""> <img class="fakeButton viewButton" src="{{ URL::asset('img/images/view.png') }}" alt="{{$exp->photo}}"/></a>

                    <!-- //////////////////REMODAL////////////////    -->
                    <a data-remodal-target="modal-{{$exp->id}}"><img class="fakeButton deleteButton" src="{{ URL::asset('img/images/delete.png') }}"  alt="{{$exp->photo}}"/></a>
                  </p>
                  <!-- //////////////////RE-MODAL////////////////    -->
                  <div class="remodal" data-remodal-id="modal-{{$exp->id}}"
                    data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

                    <button data-remodal-action="close" class="remodal-close"></button>
                    <p>
                      {{trans('account.alert')}} {{$exp->name}} ?
                    </p>
                    <br>
                    <div class="wrapButton">
                      <div>
                        {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                        {!! Form::button(trans('expindex.alertconfirm'), ['class'=>'btn btn-red', 'type'=>'submit', 'value' => $exp->id]) !!}
                        {!! Form::close() !!}
                      </div>
                      <div>
                        <button data-remodal-action="cancel" class="btn btn-grey">{{ trans('expindex.cancel') }}</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- //////////////////////////////// -->
              </div>
            </div>
            {!! Form::close() !!}
            @endforeach
          </div>
        </div>
      </div>
    </div>



    @endsection
