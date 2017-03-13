@extends('layouts.app')

@section('content')
<head>
  <link rel="stylesheet" href="{{ URL::asset('remodal/remodal.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('remodal/remodal-default-theme.css') }}">
</head>


<div id="best-deal">
  <div class="container headerExp">
    <div class="row">
      <div class="col-md-12 text-center fh5co-heading whiteWallpaper" data-animate-effect="fadeIn">
        <div class="col-md-12">
          <h1>My account</h1>
          <ul class="pageIndicate ">
            <a href="">Home ></a>
            <a href="{{ url('/') }}"> account ></a>
            <a> edition</a>
          </ul>
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
      <!--===========/message success / alert =============== -->

      <!-- ============= main ============ -->
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12 expBloc">
                <div class="bill"><h3>Change informations</h3></div>
                {!! Form::model($users, array('route' => ['account.update', $users[0]->id], 'method'=>'PUT')) !!}
                <div class="form-group col-sm-12">
                  <h4>name </h4>
                  {!! Form::text('name', $users[0]->name, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>email</h4>
                  {!! Form::email('email', $users[0]->email, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>Phone </h4>
                  {!! Form::text('phone', $users[0]->phone, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>Society</h4>
                  {!! Form::text('society', $users[0]->society, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>Adress </h4>
                  {!! Form::text('adress', $users[0]->adress, ['class' =>'form-control contactInput ','maxlength' => '255']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>Town</h4>
                  {!! Form::text('town', $users[0]->town, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>Country </h4>
                  {!! Form::text('country', $users[0]->country, ['class' =>'form-control contactInput ','maxlength' => '50']) !!}
                </div>
                <div class="form-group col-sm-12">
                  <h4>IBAN</h4>
                  {!! Form::text('iban', $users[0]->iban, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
                </div>
                <div class="col-sm-12">
                  <div class="wrapButton">
                    <div>
                      <button class="btn btn-primary">Modify</button>
                      {!! Form::close() !!}
                    </div>
                    <div >
                      <button class="btn btn-alert">reset password</button>
                    </div>
                    <div >
                      <!-- <button class="btn btn-danger">Delete Account</button> -->
                      <!-- //////////////////REMODAL////////////////    -->
                      <a data-remodal-target="modal-{{$users[0]->id}}"><img class="fakeButton deleteButton" src="{{ URL::asset('delete.png') }}"  alt="{{$users[0]->id}}"/></a>
                      <!-- //////////////////RE-MODAL////////////////    -->
                      <div class="remodal" data-remodal-id="modal-{{$users[0]->id}}"
                        data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

                        <button data-remodal-action="close" class="remodal-close"></button>
                        <h1>Delete </h1>
                        <p>
                          {{$users[0]->name}}
                        </p>
                        <br>
                        <div class="wrapButton">
                          <div>
                            <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
                          </div>
                          <div>
                            {!! Form::open(array('route'=>['account.destroy', $users[0]->id], 'method'=>'DELETE')) !!}
                            {!! Form::button('Confirm', ['class'=>'remodal-confirm', 'type'=>'submit', 'value' => $users[0]->id]) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>

                      </div>
                      <!-- //////////////////////////////// -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <h3>_debug style_</h3>
              <!-- ========================== Package =========================== -->
              <div class="col-md-12 whiteWallpaper">
                <h2 class="package wrapButton">Your package</h2>
                <p>DATE : {{$mytime}}</p>
                <p>number of experiences online : {{$nbexps}}</p>
                <p>max exp this month : {{$nbexps}}</p>
                <p>your current package : {{$nbexps}}</p>
              </div>
              <!-- ========================== /Package =========================== -->
              <h2>Offers</h2>
              <h3>Option 1 : Back office, App & embedded</h3>

              <div class="col-md-12 wrapButton">
                <div class="col-md-3 package">
                  <p>10 exp</p>
                  <p>50€/month</p>
                  <button class="btn btn-success">
                    info
                  </button>
                </div>
                <div class="col-md-6 package">
                  <p>20 exp</p>
                  <p>80€/month</p>
                  <button class="btn btn-success">
                    info
                  </button>
                </div>
                <div class="col-md-6 package">
                  <p>50 exp</p>
                  <p>150€/month</p>
                  <button class="btn btn-success">
                    info
                  </button>
                </div>
                <div class="col-md-3 package">
                  <p>100 exp</p>
                  <p>300€/month</p>
                  <button class="btn btn-success">
                    info
                  </button>
                </div>
              </div>

              <h3>Option 2 : No hosting : player Quartz</h3>
              <p>10€/exp + player Quartz price</p>
              <div class="col-md-12 wrapButton">
                <div class="col-md-12 package">
                  <p>10€/exp & 1500€ Quartz player</p>
                  <p>No hosting, export the Quartz player</p>
                  <button class="btn btn-success">
                    info
                  </button>
                </div>
              </div>
              <h3>Equipment</h3>
              <div class="col-md-12 wrapButton">
                <div class="col-md-12 package">
                  <p>Package : camera, mobile, tripod, etc...</p>
                  <button class="btn btn-success">
                    VR-Access
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
