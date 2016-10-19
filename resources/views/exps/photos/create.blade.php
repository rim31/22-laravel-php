@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ajouter exp.photo</div>

                <h1>{{$exp->id}}</h1>

                    <div class="panel-body">
                        <form action="{{ route('exp.photo.store', $exp->id)}}" method="post" enctype="multipart/form-data">
                            <label>PHOTO</label>
                            <input type="file" name="file" id="file">
                            <input type="submit" name="submit" value="upload">
                            <input type="text" name="id" value="{{$exp->id}}" hidden>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>


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
