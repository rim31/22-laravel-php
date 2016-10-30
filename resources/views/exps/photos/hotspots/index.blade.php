@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
<DIV class="parent">

  <body id="app-layout">
    <DIV class="3dPhoto">

      <main>
        <nav class="navbar navbar-default navbar-static-top">
          <DIV class="container">
            <DIV class="navbar-header">

              <DIV class="container">
                <br>
                <DIV id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                  <!-- Wrapper for slides -->
                  <DIV class="carousel-inner" role="listbox">
                    @for ($i = 0; $i < sizeOf($joinexpimages); $i++)
                    <!-- <DIV class="item @if($i ==0) active @endif"> -->
                    @if ($i == 0)
                    <DIV class="item  active">
                    @else
                    <DIV class="item">
                    @endif
                    @if (!$joinexpimages[$i]->delete)
                      <img src="{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}" alt="immovr" class="photo">
                    @endif
                  </DIV>
                    @endfor
                </DIV>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </DIV>



                <!-- //imgae from storage -->
                <!--<DIV class="item">
                      {{$path = storage_path().'\ville.jpg'}}
                      <img src="{{ URL::asset($path) }}" >

                  </DIV> -->




                            <DIV class="panel-heading">{{ $exp->name}}</DIV>

                            <DIV class="panel-body">
                                Informations : </BR>
                                <h2>{{ $exp->about }}</h2>

                                address : </BR>
                                <h2>{{ $exp->adress }}</h2>

                                <DIV class="panel-body">
                                price :    </BR>
                                {{ $exp->price }} €
                                </DIV>
                                <DIV class="panel-body">
                                owner :    </BR>
                                {{ $exp->name_owner }}
                                </DIV>
                                <DIV class="form-group">
                                <DIV class="col-sm-10">
                                    Surface {{ $exp->surface }}m²
                                    | Room {{ $exp->room}}
                                    | Level {{ $exp->level}}
                                    |
                                    @if(!$exp->parking)
                                        no
                                        @endif
                                    Parking
                                    @if(!$exp->elevator)
                                        no
                                    @endif
                                    | Elevator
                                    |
                                    | Heat @if(!$exp->electicity)
                                      Gas
                                    @else
                                      Electricity
                                    @endif
                                    | Class energy {{ $exp->class_nrj}}
                                    | Class gaz {{ $exp->class_gaz }}
                                    |
                                    @if(!$exp->availability)
                                        no
                                    @endif
                                    available
                                </DIV>
                                <!-- <button class="btn btn-primary">Envoyer</button> -->
                                <DIV class="col-sm-2">
        							{{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info']) }}
        						</DIV>
                                {!! Form::close() !!}
                            </DIV>



                <!-- JavaScripts -->

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/carousel.js') }}"></script>

            </DIV>
        </DIV>
          </nav>

          @yield('content')

        </main>
    </DIV>

    </body>

    @endsection
