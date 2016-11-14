@extends('layouts.app')

@section('content')

<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">Expérience</div>
                <ul class="pageIndicate">
                    <li><a href="">home</a></li>
                    <li><a href="">index</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ======= /2.01 Page Title Area ====== -->

<!-- ======= 3.01 Domain Area ====== -->
<div class="domainSearchArea secPdng">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sectionTitle animated">
                    <div class="h2">Trouver votre expérience ici</div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1 clearfix">
                <form action="domainSearch.html" class="domainSearchForm  animated" method="get">
                    <div class="domainInput">
                        <input class="serach" type="search" name="search" value="immoVR.com">
                        <input class="submit" type="submit" name="submit" value="Chercher">
                    </div>
<!--                     <div class="domainCheck">
                        <span class="com"><input type="checkbox" id="com" name="com" value="com"> .com ($9.00)<label for="com"></label></span>
                        <span class="net"><input type="checkbox" id="net" name="net" value="net"> .net ($8.49)<label for="net"></label></span>
                        <span class="org"><input type="checkbox" id="org" name="org" value="org"> .org ($10.00)<label for="org"></label></span>
                        <span class="in"><input type="checkbox" id="in" name="in" value="in"> .in ($8.49)<label for="in"></label></span>
                    </div> -->
                </form>
            </div>
            <div class="col-md-12">
                <ul class="domains">
                    <li class="availableDomain clearfix  animated">
                        <div class="aDomainLeft clearfix">
                            <div class="checkIcon"><i class="icofont icofont-verification-check"></i></div>
                            <div class="DomainName">
                                <div class="h3">Vos expériences</div>
                                <span>cliquer sur le nom ou la photo !</span>
                            </div>
                        </div>
                        <div class="domainBtn clearfix">
                        {{ link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'btnCart Btn add']) }}
                        </div>

                    </li>
                        @foreach($users as $user)
                        @if($user->id_user == Auth::user()->id)
                        @foreach($exps as $exp)
                        @if($user->id_exp == $exp->id AND $exp->delete != 1)
                        <li class="singleDomain  animated">
                            <div class="h4">
                            <div>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</div>
                                @if($exp->photo)
                                <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}"
                                    alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>
                                @else
                                {{ link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'cartBtn add']) }}
                                @endif
                            <div class="singleDomainRight">
                                {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                {{ link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btnBuy Btn add']) }}
                                {!! Form::button('Supprimer', ['class'=>'btnCart Btn added', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                                <!-- <h4 class="price">{{ link_to_route('exp.photo.index', 'Exporter', [$exp->id], ['class' => 'price']) }}</h4> -->
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        <!-- pagination-->
                        {{ $exps->links() }}

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /3.01 Domain Area ====== -->


    <!-- ======= 3.02 Domain cta Area ====== -->
    <div class="domainCtaArea  animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="domainCta">
                        <div class="h2">Créer votre une nouvelle expérience</div>
                        {{ link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'ctaBtn Btn']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /3.02 Domain cta Area ====== -->


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Experiences</div>
                    @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <div class="panel-body">
                        {{ link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'btn btn-success']) }}
                        <br>
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Editer</th>
                                <th>Gallerie</th>
                                <th>Lien</th>
                            </tr>
                            @foreach($users as $user)
                            @if($user->id_user == Auth::user()->id)
                            @foreach($exps as $exp)
                            <tr>
                              @if($user->id_exp == $exp->id AND $exp->delete != 1)
                              <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                              <td>
                                {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                {{ link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btn btn-primary']) }}
                                |
                                {!! Form::button('Supprimer', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                @if($exp->photo)
                                <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}"
                                    alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>

                                    @else
                                    {{ link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'btn btn-info']) }}
                                    @endif
                                </td>
                                <td>
                                   {{ link_to_route('exp.photo.index', 'Exporter', [$exp->id], ['class' => 'btn btn-success']) }}
                               </td>
                               @endif
                           </tr>
                           @endforeach
                           @endif
                           @endforeach
                       </table>

                       <!-- pagination-->
                       {{ $exps->links() }}

                   </div>
               </div>
           </div>
       </div>
   </div>




   @endsection
