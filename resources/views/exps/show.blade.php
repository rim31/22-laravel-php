@extends('layouts.app')

@section('content')
<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">Expérience</div>
                <ul class="pageIndicate">
                    <li><a href="">expérience</a></li>
                    <li><a href="">show</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ======= /2.01 Page Title Area ====== -->

<!-- ======= 2.02 Page About Area ====== -->
<div class="availableDomain clearfix  animated">
   <div class="aDomainLeft clearfix">
       <div class="DomainName">
           <div class="h3">Votre expérience</div>
       </div>
   </div>
   <div class="domainBtn clearfix">
    {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'Btn btn btn-default']) }}
</div>
</div>
<div class="aboutArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="aboutContent">
                    <div class="aboutCell">
                       <h3>Nom :{{ $exp->name}}</h3>
                       <div class="aboutTxt">
                        <h2>Info : {{ $exp->about}}  <br>Adresse : {{ $exp->adress}}
                           <br>Prix : {{ $exp->price}}  <br>Ville :                            @if ($exp->ville == '01')
                           01 - Ain
                           @elseif ($exp->ville == '02')
                           02 - Aisne
                           @elseif ($exp->ville == '03')
                           03 - Allier
                           @elseif ($exp->ville == '04')
                           04 - Alpes de Haute Provence
                           @elseif ($exp->ville == '05')
                           05 - Alpes (Hautes)
                           @elseif ($exp->ville == '06')
                           06 - Alpes Maritimes
                           @elseif ($exp->ville == '07')
                           07 - Ard&egrave;che
                           @elseif ($exp->ville == '08')
                           08 - Ardennes
                           @elseif ($exp->ville == '09')
                           09 - Ari&egrave;ge
                           @elseif ($exp->ville == '10')
                           10 - Aube
                           @elseif ($exp->ville == '11')
                           11 - Aude
                           @elseif ($exp->ville == '12')
                           12 - Aveyron
                           @elseif ($exp->ville == '13')
                           13 - Bouches du Rh&ocirc;ne
                           @elseif ($exp->ville == '14')
                           14 - Calvados
                           @elseif ($exp->ville == '15')
                           15 - Cantal
                           @elseif ($exp->ville == '16')
                           16 - Charente
                           @elseif ($exp->ville == '17')
                           17 - Charente Maritime
                           @elseif ($exp->ville == '18')
                           18 - Cher
                           @elseif ($exp->ville == '19')
                           19 - Corr&egrave;ze
                           @elseif ($exp->ville == '20')
                           20 - Corse
                           @elseif ($exp->ville == '21')
                           21 - C&ocirc;te d&acute;Or
                           @elseif ($exp->ville == '22')
                           22 - C&ocirc;tes d&acute;Armor
                           @elseif ($exp->ville == '23')
                           23 - Creuse
                           @elseif ($exp->ville == '24')
                           24 - Dordogne
                           @elseif ($exp->ville == '25')
                           25 - Doubs
                           @elseif ($exp->ville == '26')
                           26 - Dr&ocirc;me
                           @elseif ($exp->ville == '27')
                           27 - Eure
                           @elseif ($exp->ville == '28')
                           28 - Eure et Loir
                           @elseif ($exp->ville == '29')
                           29 - Finist&egrave;re
                           @elseif ($exp->ville == '30')
                           30 - Gard
                           @elseif ($exp->ville == '31')
                           31 - Garonne (Haute)
                           @elseif ($exp->ville == '32')
                           32 - Gers
                           @elseif ($exp->ville == '33')
                           33 - Gironde
                           @elseif ($exp->ville == '34')
                           34 - H&eacute;rault
                           @elseif ($exp->ville == '35')
                           35 - Ille et Vilaine
                           @elseif ($exp->ville == '36')
                           36 - Indre
                           @elseif ($exp->ville == '37')
                           37 - Indre et Loire
                           @elseif ($exp->ville == '38')
                           38 - Is&egrave;re
                           @elseif ($exp->ville == '39')
                           39 - Jura
                           @elseif ($exp->ville == '40')
                           40 - Landes
                           @elseif ($exp->ville == '41')
                           41 - Loir et Cher
                           @elseif ($exp->ville == '42')
                           42 - Loire
                           @elseif ($exp->ville == '43')
                           43 - Loire (Haute)
                           @elseif ($exp->ville == '44')
                           44 - Loire Atlantique
                           @elseif ($exp->ville == '45')
                           45 - Loiret
                           @elseif ($exp->ville == '46')
                           46 - Lot
                           @elseif ($exp->ville == '47')
                           47 - Lot et Garonne
                           @elseif ($exp->ville == '48')
                           48 - Loz&egrave;re
                           @elseif ($exp->ville == '49')
                           49 - Maine et Loire
                           @elseif ($exp->ville == '50')
                           50 - Manche
                           @elseif ($exp->ville == '51')
                           51 - Marne
                           @elseif ($exp->ville == '52')
                           52 - Marne (Haute)
                           @elseif ($exp->ville == '53')
                           53 - Mayenne
                           @elseif ($exp->ville == '54')
                           54 - Meurthe et Moselle
                           @elseif ($exp->ville == '55')
                           55 - Meuse
                           @elseif ($exp->ville == '56')
                           56 - Morbihan
                           @elseif ($exp->ville == '57')
                           57 - Moselle
                           @elseif ($exp->ville == '58')
                           58 - Ni&egrave;vre
                           @elseif ($exp->ville == '59')
                           59 - Nord
                           @elseif ($exp->ville == '60')
                           60 - Oise
                           @elseif ($exp->ville == '61')
                           61 - Orne
                           @elseif ($exp->ville == '62')
                           62 - Pas de Calais
                           @elseif ($exp->ville == '63')
                           63 - Puy de D&ocirc;me
                           @elseif ($exp->ville == '64')
                           64 - Pyr&eacute;n&eacute;es Atlantiques
                           @elseif ($exp->ville == '65')
                           65 - Pyr&eacute;n&eacute;es (Hautes)
                           @elseif ($exp->ville == '66')
                           66 - Pyr&eacute;n&eacute;es Orientales
                           @elseif ($exp->ville == '67')
                           67 - Rhin (Bas)
                           @elseif ($exp->ville == '68')
                           68 - Rhin (Haut)
                           @elseif ($exp->ville == '69')
                           69 - Rh&ocirc;ne
                           @elseif ($exp->ville == '70')
                           70 - Sa&ocirc;ne (Haute)
                           @elseif ($exp->ville == '71')
                           71 - Sa&ocirc;ne et Loire
                           @elseif ($exp->ville == '72')
                           72 - Sarthe
                           @elseif ($exp->ville == '73')
                           73 - Savoie
                           @elseif ($exp->ville == '74')
                           74 - Savoie (Haute)
                           @elseif ($exp->ville == '75')
                           75 - Paris (Dept.)
                           @elseif ($exp->ville == '76')
                           76 - Seine Maritime
                           @elseif ($exp->ville == '77')
                           77 - Seine et Marne
                           @elseif ($exp->ville == '78')
                           78 - Yvelines
                           @elseif ($exp->ville == '79')
                           79 - S&egrave;vres (Deux)
                           @elseif ($exp->ville == '80')
                           80 - Somme
                           @elseif ($exp->ville == '81')
                           81 - Tarn
                           @elseif ($exp->ville == '82')
                           82 - Tarn et Garonne
                           @elseif ($exp->ville == '83')
                           83 - Var
                           @elseif ($exp->ville == '84')
                           84 - Vaucluse
                           @elseif ($exp->ville == '85')
                           85 - Vend&eacute;e
                           @elseif ($exp->ville == '86')
                           86 - Vienne
                           @elseif ($exp->ville == '87')
                           87 - Vienne (Haute)
                           @elseif ($exp->ville == '88')
                           88 - Vosges
                           @elseif ($exp->ville == '89')
                           89 - Yonne
                           @elseif ($exp->ville == '90')
                           90 - Belfort (Territoire de)
                           @elseif ($exp->ville == '91')
                           91 - Essonne
                           @elseif ($exp->ville == '92')
                           92 - Hauts de Seine
                           @elseif ($exp->ville == '93')
                           93 - Seine Saint Denis
                           @elseif ($exp->ville == '94')
                           94 - Val de Marne
                           @elseif ($exp->ville == '95')
                           95 - Val d&acute;Oise
                           @elseif ($exp->ville == '98')
                           98 - Mayotte
                           @elseif ($exp->ville == '9A')
                           9A - Guadeloupe
                           @elseif ($exp->ville == '9B')
                           9B - Guyane
                           @elseif ($exp->ville == '9C')
                           9C - Martinique
                           @elseif ($exp->ville == '9D')
                           9D - R&eacute;union
                           @endif<br>
                           Propriétaire : {{ $exp->owner}}</h2>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="aboutImg">
    @if($exp->photo)
    <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}"
        alt="{{$exp->photo}}" /></a>
        @else
        {{ link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'cartBtn Btn add']) }}
        @endif
    </div>
</div>

<!-- ======= 2.03 Page Service Area ====== -->

<div class="aboutServiceArea secPdng ">
    <div class="container animated">
        <div class="row">
            <div class="col-md-12">
                <div class="sectionTitle">
                    <div class="h2">Informations complémentaires :   @if(!$exp->availability)
                      pas
                      @endif
                      disponible
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6">
             <div class="singleAboutService">
                 <div class="aServiceIcon">
                    <i class="fa fa-bed fa-2x" aria-hidden="true"></i>
                </div>
                <div class="aServiceContent">
                 <div class="aServiceTitle h4">{{ $exp->rooms}} chambre(s)</div>
                 <div class="aServiceTxt">
                     <p><br></p>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-3 col-sm-6">
      <div class="singleAboutService">
          <div class="aServiceIcon">
             <i class="fa fa-home fa-2x" aria-hidden="true"></i>
         </div>
         <div class="aServiceContent">
          <div class="aServiceTitle h4">{{ $exp->surface}} m²</div>
          <div class="aServiceTxt">
              <p><br></p>
          </div>
      </div>
  </div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-car fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">@if(!$exp->parking)
          pas de
          @endif
          Parking</div>
          <div class="aServiceTxt">
              <p><br></p>
          </div>
      </div>
  </div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-building-o fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">{{$exp->level}}e étage
       </div>
       <div class="aServiceTxt">
          <p><br></p>
      </div>
  </div>
</div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-caret-square-o-up fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">@if(!$exp->elevator)
          pas d'
          @endif
          ascensseur</div>
          <div class="aServiceTxt">
              <p><br></p>
          </div>
      </div>
  </div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-fire fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">Chauffage @if(!$exp->electicity)
        Gaz
        @else
        Electricité
        @endif</div>
        <div class="aServiceTxt">
          <p><br></p>
      </div>
  </div>
</div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-bolt fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">Class energy {{ $exp->class_nrj}}
       </div>
       <div class="aServiceTxt">
        <p><br></p>
    </div>
</div>
</div>
</div>
<div class="col-md-3 col-sm-6">
   <div class="singleAboutService">
       <div class="aServiceIcon">
          <i class="fa fa-cloud fa-2x" aria-hidden="true"></i>
      </div>
      <div class="aServiceContent">
       <div class="aServiceTitle h4">Class gaz {{ $exp->class_gaz }}
       </div>
       <div class="aServiceTxt">
        <p><br></p>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>



<!-- ======= /2.03 Page Service Area ====== -->

@endsection
