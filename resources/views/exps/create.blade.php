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
                    <li><a href="">création</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ======= /2.01 Page Title Area ====== -->

<div class="cartArea secPdngB">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="availableDomain clearfix  animated">
                    <div class="aDomainLeft clearfix">
                        <div class="DomainName">
                            <div class="h3">Nouvelle expérience</div>
                        </div>
                    </div>
                    <div class="domainBtn clearfix">
                        {{ link_to_route('exp.index', 'Retour', null, ['class' => 'btnBuy Btn']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="bill">Veuillez remplir les informations</div>

                    <!-- <form id="ajax-contact" action="mail.php" method="post" class="contactForm"> -->
                    {!! Form::open(array('route' => 'exp.store','method'=>'POST', 'class' => ' col-md-12 contactForm')) !!}
                    <div class="form-group col-sm-12">
                        <!-- {!! Form::label('name', 'Titre') !!} -->
                        Titre
                        {!! Form::text('name', null, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        Informations
                        <!-- {!! Form::label('about', 'informations', ['class' => 'inputTitle']) !!} -->
                        {!! Form::textarea('about', null, ['class' =>'form-control contactInput','maxlength' => '50', 'rows'=> '3' ]) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        Prix
                        <!-- {!! Form::label('price', 'prix', ['class' => 'contactInput']) !!} -->
                        {!! Form::text('price', null, ['class' =>'form-control contactInput']) !!}
                    </div>
                    <div class="col-sm-12">
                        <!-- <div class="form-group"> -->
                            <!-- {!! Form::label('adress', 'adresse', ['class' => 'contactInput']) !!} -->
                        Adresse
                        {!! Form::textarea('adress', null, ['class' =>'form-control contactInput','maxlength' => '250', 'rows'=> '3' ]) !!}
                    </div>
                    <div class="col-sm-12">
                        Propriétaire
                        <!-- {!! Form::label('name_owner', 'propriétaire', ['class' => 'contactInput']) !!} -->
                        {!! Form::text('name_owner', null, ['class' =>'form-control contactInput']) !!}
                    </div>
                    <div class="col-sm-12">
                        Selectionner une ville
                        <select class="contactSelect" name="ville"  onChange="affiche_ville(this.value)"><option value="" label="ville"> </option>
                            <option value='01'>01 - Ain</option>
                            <option value='02'>02 - Aisne</option>
                            <option value='03'>03 - Allier</option>
                            <option value='04'>04 - Alpes de Haute Provence</option>
                            <option value='05'>05 - Alpes (Hautes)</option>
                            <option value='06'>06 - Alpes Maritimes</option>
                            <option value='07'>07 - Ard&egrave;che</option>
                            <option value='08'>08 - Ardennes</option>
                            <option value='09'>09 - Ari&egrave;ge</option>
                            <option value='10'>10 - Aube</option>
                            <option value='11'>11 - Aude</option>
                            <option value='12'>12 - Aveyron</option>
                            <option value='13'>13 - Bouches du Rh&ocirc;ne</option>
                            <option value='14'>14 - Calvados</option>
                            <option value='15'>15 - Cantal</option>
                            <option value='16'>16 - Charente</option>
                            <option value='17'>17 - Charente Maritime</option>
                            <option value='18'>18 - Cher</option>
                            <option value='19'>19 - Corr&egrave;ze</option>
                            <option value='20'>20 - Corse</option>
                            <option value='21'>21 - C&ocirc;te d&acute;Or</option>
                            <option value='22'>22 - C&ocirc;tes d&acute;Armor</option>
                            <option value='23'>23 - Creuse</option>
                            <option value='24'>24 - Dordogne</option>
                            <option value='25'>25 - Doubs</option>
                            <option value='26'>26 - Dr&ocirc;me</option>
                            <option value='27'>27 - Eure</option>
                            <option value='28'>28 - Eure et Loir</option>
                            <option value='29'>29 - Finist&egrave;re</option>
                            <option value='30'>30 - Gard</option>
                            <option value='31'>31 - Garonne (Haute)</option>
                            <option value='32'>32 - Gers</option>
                            <option value='33'>33 - Gironde</option>
                            <option value='34'>34 - H&eacute;rault</option>
                            <option value='35'>35 - Ille et Vilaine</option>
                            <option value='36'>36 - Indre</option>
                            <option value='37'>37 - Indre et Loire</option>
                            <option value='38'>38 - Is&egrave;re</option>
                            <option value='39'>39 - Jura</option>
                            <option value='40'>40 - Landes</option>
                            <option value='41'>41 - Loir et Cher</option>
                            <option value='42'>42 - Loire</option>
                            <option value='43'>43 - Loire (Haute)</option>
                            <option value='44'>44 - Loire Atlantique</option>
                            <option value='45'>45 - Loiret</option>
                            <option value='46'>46 - Lot</option>
                            <option value='47'>47 - Lot et Garonne</option>
                            <option value='48'>48 - Loz&egrave;re</option>
                            <option value='49'>49 - Maine et Loire</option>
                            <option value='50'>50 - Manche</option>
                            <option value='51'>51 - Marne</option>
                            <option value='52'>52 - Marne (Haute)</option>
                            <option value='53'>53 - Mayenne</option>
                            <option value='54'>54 - Meurthe et Moselle</option>
                            <option value='55'>55 - Meuse</option>
                            <option value='56'>56 - Morbihan</option>
                            <option value='57'>57 - Moselle</option>
                            <option value='58'>58 - Ni&egrave;vre</option>
                            <option value='59'>59 - Nord</option>
                            <option value='60'>60 - Oise</option>
                            <option value='61'>61 - Orne</option>
                            <option value='62'>62 - Pas de Calais</option>
                            <option value='63'>63 - Puy de D&ocirc;me</option>
                            <option value='64'>64 - Pyr&eacute;n&eacute;es Atlantiques</option>
                            <option value='65'>65 - Pyr&eacute;n&eacute;es (Hautes)</option>
                            <option value='66'>66 - Pyr&eacute;n&eacute;es Orientales</option>
                            <option value='67'>67 - Rhin (Bas)</option>
                            <option value='68'>68 - Rhin (Haut)</option>
                            <option value='69'>69 - Rh&ocirc;ne</option>
                            <option value='70'>70 - Sa&ocirc;ne (Haute)</option>
                            <option value='71'>71 - Sa&ocirc;ne et Loire</option>
                            <option value='72'>72 - Sarthe</option>
                            <option value='73'>73 - Savoie</option>
                            <option value='74'>74 - Savoie (Haute)</option>
                            <option value='75'>75 - Paris (Dept.)</option>
                            <option value='76'>76 - Seine Maritime</option>
                            <option value='77'>77 - Seine et Marne</option>
                            <option value='78'>78 - Yvelines</option>
                            <option value='79'>79 - S&egrave;vres (Deux)</option>
                            <option value='80'>80 - Somme</option>
                            <option value='81'>81 - Tarn</option>
                            <option value='82'>82 - Tarn et Garonne</option>
                            <option value='83'>83 - Var</option>
                            <option value='84'>84 - Vaucluse</option>
                            <option value='85'>85 - Vend&eacute;e</option>
                            <option value='86'>86 - Vienne</option>
                            <option value='87'>87 - Vienne (Haute)</option>
                            <option value='88'>88 - Vosges</option>
                            <option value='89'>89 - Yonne</option>
                            <option value='90'>90 - Belfort (Territoire de)</option>
                            <option value='91'>91 - Essonne</option>
                            <option value='92'>92 - Hauts de Seine</option>
                            <option value='93'>93 - Seine Saint Denis</option>
                            <option value='94'>94 - Val de Marne</option>
                            <option value='95'>95 - Val d&acute;Oise</option>
                            <option value='98'>98 - Mayotte</option>
                            <option value='9A'>9A - Guadeloupe</option>
                            <option value='9B'>9B - Guyane</option>
                            <option value='9C'>9C - Martinique</option>
                            <option value='9D'>9D - R&eacute;union</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    Surface(m²) {!! Form::selectRange('surface', 1, 9999)!!}
                    | Pièce  {!! Form::selectRange('rooms', 1, 20)!!}
                    | Etage  {!! Form::selectRange('level', 1, 20)!!}
                    | Parking  {{ Form::select('parking', array('1' => 'oui', '0' => 'non'), '0') }}
                    | Ascensseur  {{ Form::select('lift', array('1' => 'oui', '0' => 'non'), '0') }}
                    | Chauf Electrique {{ Form::select('electricity', array('1' => 'oui', '0' => 'non'), '1') }}
                    | Classe energie {!! Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                    | Classe gaz {!! Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                    | Dispo  {{ Form::select('availability', array('1' => 'oui', '0' => 'non'), '1')  }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <!-- ======= 3.02 Domain cta Area ====== -->
    <div class="domainCtaArea  animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="domainCta">
                        <button class="ctaBtn Btn">Envoyer</button>
                        {!! Form::close() !!}
                        <!-- {{ link_to_route('exp.index', 'Retour', ['class' => 'btn btn-primary']) }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================ test ============== -->

<div class="cartArea secPdngB">
    <div class="container">
        <div class="col-md-12 animated">
            <div class="availableDomain clearfix  animated">
                <div class="aDomainLeft clearfix">
                    <div class="DomainName">
                        <div class="h3">Nouvelle expérience</div>
                    </div>
                </div>
                <div class="domainBtn clearfix">
                    {{ link_to_route('exp.index', 'Retour', null, ['class' => 'btnBuy Btn']) }}
                </div>
            </div>
            <div class="contactArea secPdng animated">
        		<div class="container">
        			<div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="bill">Veuillez remplir les informations</div>
                        </div>

                        {!! Form::open(array('route' => 'exp.store','method'=>'POST', 'files'=>true)) !!}
                        <div class="form-group col-sm-12">
                            {!! Form::label('name', 'Titre', ['class' => 'contactForm']) !!}
                            {!! Form::text('name', null, ['class' =>'form-control contactInput','maxlength' => '20']) !!}
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('about', 'informations', ['class' => 'inputTitle']) !!}
                                {!! Form::textarea('about', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'prix', ['class' => 'inputTitle']) !!}
                                {!! Form::text('price', null, ['class' =>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('adress', 'adresse', ['class' => 'inputTitle']) !!}
                                {!! Form::textarea('adress', null, ['class' =>'form-control','maxlength' => '250', 'rows'=> '3' ]) !!}
                            </div>
                            <select class="contactSelect" name="ville"  onChange="affiche_ville(this.value)"><option value="" label="ville"> </option>
                                <option value='01'>01 - Ain</option>
                                <option value='02'>02 - Aisne</option>
                                <option value='03'>03 - Allier</option>
                                <option value='04'>04 - Alpes de Haute Provence</option>
                                <option value='05'>05 - Alpes (Hautes)</option>
                                <option value='06'>06 - Alpes Maritimes</option>
                                <option value='07'>07 - Ard&egrave;che</option>
                                <option value='08'>08 - Ardennes</option>
                                <option value='09'>09 - Ari&egrave;ge</option>
                                <option value='10'>10 - Aube</option>
                                <option value='11'>11 - Aude</option>
                                <option value='12'>12 - Aveyron</option>
                                <option value='13'>13 - Bouches du Rh&ocirc;ne</option>
                                <option value='14'>14 - Calvados</option>
                                <option value='15'>15 - Cantal</option>
                                <option value='16'>16 - Charente</option>
                                <option value='17'>17 - Charente Maritime</option>
                                <option value='18'>18 - Cher</option>
                                <option value='19'>19 - Corr&egrave;ze</option>
                                <option value='20'>20 - Corse</option>
                                <option value='21'>21 - C&ocirc;te d&acute;Or</option>
                                <option value='22'>22 - C&ocirc;tes d&acute;Armor</option>
                                <option value='23'>23 - Creuse</option>
                                <option value='24'>24 - Dordogne</option>
                                <option value='25'>25 - Doubs</option>
                                <option value='26'>26 - Dr&ocirc;me</option>
                                <option value='27'>27 - Eure</option>
                                <option value='28'>28 - Eure et Loir</option>
                                <option value='29'>29 - Finist&egrave;re</option>
                                <option value='30'>30 - Gard</option>
                                <option value='31'>31 - Garonne (Haute)</option>
                                <option value='32'>32 - Gers</option>
                                <option value='33'>33 - Gironde</option>
                                <option value='34'>34 - H&eacute;rault</option>
                                <option value='35'>35 - Ille et Vilaine</option>
                                <option value='36'>36 - Indre</option>
                                <option value='37'>37 - Indre et Loire</option>
                                <option value='38'>38 - Is&egrave;re</option>
                                <option value='39'>39 - Jura</option>
                                <option value='40'>40 - Landes</option>
                                <option value='41'>41 - Loir et Cher</option>
                                <option value='42'>42 - Loire</option>
                                <option value='43'>43 - Loire (Haute)</option>
                                <option value='44'>44 - Loire Atlantique</option>
                                <option value='45'>45 - Loiret</option>
                                <option value='46'>46 - Lot</option>
                                <option value='47'>47 - Lot et Garonne</option>
                                <option value='48'>48 - Loz&egrave;re</option>
                                <option value='49'>49 - Maine et Loire</option>
                                <option value='50'>50 - Manche</option>
                                <option value='51'>51 - Marne</option>
                                <option value='52'>52 - Marne (Haute)</option>
                                <option value='53'>53 - Mayenne</option>
                                <option value='54'>54 - Meurthe et Moselle</option>
                                <option value='55'>55 - Meuse</option>
                                <option value='56'>56 - Morbihan</option>
                                <option value='57'>57 - Moselle</option>
                                <option value='58'>58 - Ni&egrave;vre</option>
                                <option value='59'>59 - Nord</option>
                                <option value='60'>60 - Oise</option>
                                <option value='61'>61 - Orne</option>
                                <option value='62'>62 - Pas de Calais</option>
                                <option value='63'>63 - Puy de D&ocirc;me</option>
                                <option value='64'>64 - Pyr&eacute;n&eacute;es Atlantiques</option>
                                <option value='65'>65 - Pyr&eacute;n&eacute;es (Hautes)</option>
                                <option value='66'>66 - Pyr&eacute;n&eacute;es Orientales</option>
                                <option value='67'>67 - Rhin (Bas)</option>
                                <option value='68'>68 - Rhin (Haut)</option>
                                <option value='69'>69 - Rh&ocirc;ne</option>
                                <option value='70'>70 - Sa&ocirc;ne (Haute)</option>
                                <option value='71'>71 - Sa&ocirc;ne et Loire</option>
                                <option value='72'>72 - Sarthe</option>
                                <option value='73'>73 - Savoie</option>
                                <option value='74'>74 - Savoie (Haute)</option>
                                <option value='75'>75 - Paris (Dept.)</option>
                                <option value='76'>76 - Seine Maritime</option>
                                <option value='77'>77 - Seine et Marne</option>
                                <option value='78'>78 - Yvelines</option>
                                <option value='79'>79 - S&egrave;vres (Deux)</option>
                                <option value='80'>80 - Somme</option>
                                <option value='81'>81 - Tarn</option>
                                <option value='82'>82 - Tarn et Garonne</option>
                                <option value='83'>83 - Var</option>
                                <option value='84'>84 - Vaucluse</option>
                                <option value='85'>85 - Vend&eacute;e</option>
                                <option value='86'>86 - Vienne</option>
                                <option value='87'>87 - Vienne (Haute)</option>
                                <option value='88'>88 - Vosges</option>
                                <option value='89'>89 - Yonne</option>
                                <option value='90'>90 - Belfort (Territoire de)</option>
                                <option value='91'>91 - Essonne</option>
                                <option value='92'>92 - Hauts de Seine</option>
                                <option value='93'>93 - Seine Saint Denis</option>
                                <option value='94'>94 - Val de Marne</option>
                                <option value='95'>95 - Val d&acute;Oise</option>
                                <option value='98'>98 - Mayotte</option>
                                <option value='9A'>9A - Guadeloupe</option>
                                <option value='9B'>9B - Guyane</option>
                                <option value='9C'>9C - Martinique</option>
                                <option value='9D'>9D - R&eacute;union</option>
                            </select>
                            Selectionner une ville
                            <div class="form-group">
                                {!! Form::label('name_owner', 'propriétaire', ['class' => 'inputTitle']) !!}
                                {!! Form::text('name_owner', null, ['class' =>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                Surface(m²) {!! Form::selectRange('surface', 1, 9999)!!}
                                | Pièce  {!! Form::selectRange('rooms', 1, 20)!!}
                                | Etage  {!! Form::selectRange('level', 1, 20)!!}
                                | Parking  {{ Form::select('parking', array('1' => 'oui', '0' => 'non'), '0') }}
                                | Ascensseur  {{ Form::select('lift', array('1' => 'oui', '0' => 'non'), '0') }}
                                | Chauf Electrique {{ Form::select('electricity', array('1' => 'oui', '0' => 'non'), '1') }}
                                | Classe energie {!! Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                                | Classe gaz {!! Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                                | Dispo  {{ Form::select('availability', array('1' => 'oui', '0' => 'non'), '1')  }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <!-- ======= 3.02 Domain cta Area ====== -->
    <div class="domainCtaArea  animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="domainCta">
                        <button class="ctaBtn Btn">Envoyer</button>
                        {!! Form::close() !!}
                        <!-- {{ link_to_route('exp.index', 'Retour', ['class' => 'btn btn-primary']) }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================original======================================== -->


<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Nouvelle expérience</div>
            <div class="panel-body">
                {!! Form::open(array('route' => 'exp.store','method'=>'POST', 'files'=>true)) !!}
                <div class="form-group col-sm-12">
                    {!! Form::label('name', 'Titre') !!}
                    {!! Form::text('name', null, ['class' =>'form-control','maxlength' => '20']) !!}
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('about', 'informations') !!}
                        {!! Form::textarea('about', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', 'prix') !!}
                        {!! Form::text('price', null, ['class' =>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('adress', 'adresse') !!}
                        {!! Form::textarea('adress', null, ['class' =>'form-control','maxlength' => '250', 'rows'=> '3' ]) !!}
                    </div>
                    <select name="ville"  onChange="affiche_ville(this.value)"><option value="" label="ville"> </option>
                        <option value='01'>01 - Ain</option>
                        <option value='02'>02 - Aisne</option>
                        <option value='03'>03 - Allier</option>
                        <option value='04'>04 - Alpes de Haute Provence</option>
                        <option value='05'>05 - Alpes (Hautes)</option>
                        <option value='06'>06 - Alpes Maritimes</option>
                        <option value='07'>07 - Ard&egrave;che</option>
                        <option value='08'>08 - Ardennes</option>
                        <option value='09'>09 - Ari&egrave;ge</option>
                        <option value='10'>10 - Aube</option>
                        <option value='11'>11 - Aude</option>
                        <option value='12'>12 - Aveyron</option>
                        <option value='13'>13 - Bouches du Rh&ocirc;ne</option>
                        <option value='14'>14 - Calvados</option>
                        <option value='15'>15 - Cantal</option>
                        <option value='16'>16 - Charente</option>
                        <option value='17'>17 - Charente Maritime</option>
                        <option value='18'>18 - Cher</option>
                        <option value='19'>19 - Corr&egrave;ze</option>
                        <option value='20'>20 - Corse</option>
                        <option value='21'>21 - C&ocirc;te d&acute;Or</option>
                        <option value='22'>22 - C&ocirc;tes d&acute;Armor</option>
                        <option value='23'>23 - Creuse</option>
                        <option value='24'>24 - Dordogne</option>
                        <option value='25'>25 - Doubs</option>
                        <option value='26'>26 - Dr&ocirc;me</option>
                        <option value='27'>27 - Eure</option>
                        <option value='28'>28 - Eure et Loir</option>
                        <option value='29'>29 - Finist&egrave;re</option>
                        <option value='30'>30 - Gard</option>
                        <option value='31'>31 - Garonne (Haute)</option>
                        <option value='32'>32 - Gers</option>
                        <option value='33'>33 - Gironde</option>
                        <option value='34'>34 - H&eacute;rault</option>
                        <option value='35'>35 - Ille et Vilaine</option>
                        <option value='36'>36 - Indre</option>
                        <option value='37'>37 - Indre et Loire</option>
                        <option value='38'>38 - Is&egrave;re</option>
                        <option value='39'>39 - Jura</option>
                        <option value='40'>40 - Landes</option>
                        <option value='41'>41 - Loir et Cher</option>
                        <option value='42'>42 - Loire</option>
                        <option value='43'>43 - Loire (Haute)</option>
                        <option value='44'>44 - Loire Atlantique</option>
                        <option value='45'>45 - Loiret</option>
                        <option value='46'>46 - Lot</option>
                        <option value='47'>47 - Lot et Garonne</option>
                        <option value='48'>48 - Loz&egrave;re</option>
                        <option value='49'>49 - Maine et Loire</option>
                        <option value='50'>50 - Manche</option>
                        <option value='51'>51 - Marne</option>
                        <option value='52'>52 - Marne (Haute)</option>
                        <option value='53'>53 - Mayenne</option>
                        <option value='54'>54 - Meurthe et Moselle</option>
                        <option value='55'>55 - Meuse</option>
                        <option value='56'>56 - Morbihan</option>
                        <option value='57'>57 - Moselle</option>
                        <option value='58'>58 - Ni&egrave;vre</option>
                        <option value='59'>59 - Nord</option>
                        <option value='60'>60 - Oise</option>
                        <option value='61'>61 - Orne</option>
                        <option value='62'>62 - Pas de Calais</option>
                        <option value='63'>63 - Puy de D&ocirc;me</option>
                        <option value='64'>64 - Pyr&eacute;n&eacute;es Atlantiques</option>
                        <option value='65'>65 - Pyr&eacute;n&eacute;es (Hautes)</option>
                        <option value='66'>66 - Pyr&eacute;n&eacute;es Orientales</option>
                        <option value='67'>67 - Rhin (Bas)</option>
                        <option value='68'>68 - Rhin (Haut)</option>
                        <option value='69'>69 - Rh&ocirc;ne</option>
                        <option value='70'>70 - Sa&ocirc;ne (Haute)</option>
                        <option value='71'>71 - Sa&ocirc;ne et Loire</option>
                        <option value='72'>72 - Sarthe</option>
                        <option value='73'>73 - Savoie</option>
                        <option value='74'>74 - Savoie (Haute)</option>
                        <option value='75'>75 - Paris (Dept.)</option>
                        <option value='76'>76 - Seine Maritime</option>
                        <option value='77'>77 - Seine et Marne</option>
                        <option value='78'>78 - Yvelines</option>
                        <option value='79'>79 - S&egrave;vres (Deux)</option>
                        <option value='80'>80 - Somme</option>
                        <option value='81'>81 - Tarn</option>
                        <option value='82'>82 - Tarn et Garonne</option>
                        <option value='83'>83 - Var</option>
                        <option value='84'>84 - Vaucluse</option>
                        <option value='85'>85 - Vend&eacute;e</option>
                        <option value='86'>86 - Vienne</option>
                        <option value='87'>87 - Vienne (Haute)</option>
                        <option value='88'>88 - Vosges</option>
                        <option value='89'>89 - Yonne</option>
                        <option value='90'>90 - Belfort (Territoire de)</option>
                        <option value='91'>91 - Essonne</option>
                        <option value='92'>92 - Hauts de Seine</option>
                        <option value='93'>93 - Seine Saint Denis</option>
                        <option value='94'>94 - Val de Marne</option>
                        <option value='95'>95 - Val d&acute;Oise</option>
                        <option value='98'>98 - Mayotte</option>
                        <option value='9A'>9A - Guadeloupe</option>
                        <option value='9B'>9B - Guyane</option>
                        <option value='9C'>9C - Martinique</option>
                        <option value='9D'>9D - R&eacute;union</option>
                    </select>
                    Ville
                    <div class="form-group">
                        {!! Form::label('name_owner', 'propriétaire') !!}
                        {!! Form::text('name_owner', null, ['class' =>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        Surface(m²) {!! Form::selectRange('surface', 1, 9999)!!}
                        | Pièce  {!! Form::selectRange('rooms', 1, 20)!!}
                        | Etage  {!! Form::selectRange('level', 1, 20)!!}
                        | Parking  {{ Form::select('parking', array('1' => 'oui', '0' => 'non'), '0') }}
                        | Ascensseur  {{ Form::select('lift', array('1' => 'oui', '0' => 'non'), '0') }}
                        | Chauf Electrique {{ Form::select('electricity', array('1' => 'oui', '0' => 'non'), '1') }}
                        | Classe energie {!! Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | Classe gaz {!! Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E')!!}
                        | Dispo  {{ Form::select('availability', array('1' => 'oui', '0' => 'non'), '1')  }}
                    </div>
                </div>

                <div class="col-sm-12">
                    <!-- ======= 3.02 Domain cta Area ====== -->
                    <div class="domainCtaArea  animated">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="domainCta">
                                        <button class="ctaBtn Btn">Envoyer</button>
                                        {!! Form::close() !!}
                                        {{ link_to_route('exp.index', 'Retour', ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if($errors->has())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
</div>
</div>

@endsection
