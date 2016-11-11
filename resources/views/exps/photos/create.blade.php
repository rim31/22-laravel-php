@extends('layouts.app')

@section('content')

<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">Photo</div>
                <ul class="pageIndicate">
                    <li><a href="">expérience</a></li>
                    <li><a href="">photo</a></li>
                    <li><a href="">ajouter</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if($errors->has())
<ul class="aler alert-danger">
    @foreach($errors->all() as $error)
    <li>{{ $error}}</li>
    @endforeach
</ul>
@endif
<!-- ======= /2.01 Page Title Area ====== -->

<div class="stepArea secPdng animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sectionTitle">
                    <div class="h2">Ajouter une photo à votre expérience.
                        <br>puis <span>envoyer</span> pour terminer.</div>
                    </div>
                </div>
            </div>


            <form action="{{ route('exp.photo.store', $exp->id)}}" method="post" 
                enctype="multipart/form-data">
                <div class="fileInput">
                    <span class="fileTxt">Glisser et déposer ou</span>
                    <span class="fileSpan">
                        <input type="file" name="file" id="file" class="inputfile">
                        <label for="file">importer</label>
                        <input type="text" name="id" value="{{$exp->id}}" hidden>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </span>
                    <span class="fileTxt">votre image ici</span>
                    
                </div>
                <div class="captcha" data-toggle="tooltip" data-placement="top" title="Active Me!"><span></span> I am not a robot</div>
                <input type="submit" value="envoyer" class="btnCart Btn add">
                {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btnCart Btn added']) }}
            </form>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter exp.photo</div>

                    <h1>{{$exp->name}}</h1>
                    <form action="{{ route('exp.photo.store', $exp->id)}}" method="post" 
                        enctype="multipart/form-data">
                        <input type="file" name="file" id="file">
                        <input type="text" name="id" value="{{$exp->id}}" hidden>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="envoyer" class="btn btn-success">
                    </form>
                    {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-secondary']) }}

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
