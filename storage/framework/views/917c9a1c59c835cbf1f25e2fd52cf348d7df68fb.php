

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>

                <div class="panel-body">
                    <?php echo Form::open(array('route' => 'exp.store','method'=>'POST', 'files'=>true)); ?>



                    Nouvelle expérience
                    <div class="form-group">
                        <?php echo Form::label('name', 'Titre'); ?>

                        <?php echo Form::text('name', null, ['class' =>'form-control']); ?>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('about', 'informations'); ?>

                            <?php echo Form::textarea('about', null, ['class' =>'form-control','maxlength' => '250', 'rows'=> '3' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('price', 'prix'); ?>

                            <?php echo Form::text('price', null, ['class' =>'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('adress', 'adresse'); ?>

                            <?php echo Form::textarea('adress', null, ['class' =>'form-control','maxlength' => '250', 'rows'=> '3' ]); ?>

                        </div>

                        <select name="dep"  onChange="affiche_ville(this.value)"><option value=""> </option>
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
                            <?php echo Form::label('name_owner', 'propriétaire'); ?>

                            <?php echo Form::text('name_owner', null, ['class' =>'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            Surface(m²) <?php echo Form::selectRange('surface', 1, 9999); ?>

                            | Pièce  <?php echo Form::selectRange('room', 1, 20); ?>

                            | Etage  <?php echo Form::selectRange('level', 1, 20); ?>

                            | Parking  <?php echo e(Form::checkbox('parking', '1')); ?>

                            | Ascensseur  <?php echo e(Form::checkbox('lift', '1')); ?>

                            | Chauf Electrique <?php echo e(Form::checkbox('electricity', '1')); ?>

                            | Classe energie <?php echo Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E'); ?>

                            | Classe gaz <?php echo Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E'); ?>

                            | Dispo  <?php echo e(Form::checkbox('availability', '1')); ?>

                        </div>
                    </div>
<!--                     <div class="col-sm-4">
                        <div class="form-group">
                            <label for="photo">PHOTO</label> (obligatoire)<?php echo Form::file('photo'); ?>

                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="video">VIDEO</label> (optionnel)<?php echo Form::file('video'); ?>

                        </div> -->
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary">Suivant</button>
                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
            <?php if($errors->has()): ?>
            <ul class="aler alert-danger">
                <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>