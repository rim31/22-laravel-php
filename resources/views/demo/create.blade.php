@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
<div class="parent">
  <div id="spot" class="draggable">
    <p>placer</BR>hotspot
    </p>
  </div>  

  <div class="container draggable">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">{{Auth::user()->name}}</div>
          <div class="panel-body">
            <form action="" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="url"> Ajouter un hotspot</label>
                <input type="text" name"url" id="url" placeholder="nom du spot" class="form-control">
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Ajouter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>

<script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/dragndrop.js') }}"></script>

<script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/functions.js') }}"></script>

@endsection
