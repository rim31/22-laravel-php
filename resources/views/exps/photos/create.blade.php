@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ajouter photo</div>



                    <div class="panel-body">
                        <!-- <form action="{{ URL::to('upload')}}" method="post" enctype="multipart/form-data"> -->
                        <form action="{{ URL::to('upload')}}" method="post" enctype="multipart/form-data">
                            <label>up une photo</label>
                            <input type="file" name="file" id="file">
                            <input type="submit" name="submit" value="upload">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                    <!-- {!! Form::model($exp, array('route' => ['exp.photo.store', $exp->id], 'method'=>'POST')) !!}
                    <label for="">Photo</label>{!! Form::file('image') !!}
                    {!! Form::close() !!} -->


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
