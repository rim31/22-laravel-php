@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">ajouter photo</div>



            </div>
             @if($errors->has())
                <ul class="aler alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul>
             @endif
        </div>
    </div>
</div>
@endsection
