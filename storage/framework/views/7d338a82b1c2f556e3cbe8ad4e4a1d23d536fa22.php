<?php $__env->startSection('content'); ?>
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
    <?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'Btn btn btn-default'])); ?>

</div>
</div>
<div class="aboutArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="aboutContent">
                    <div class="aboutCell">
                       <h3>Nom :<?php echo e($exp->name); ?></h3>
                       <div class="aboutTxt">
                        <h2>Info : <?php echo e($exp->about); ?>  <br>Adresse : <?php echo e($exp->adress); ?>

                           <br>Prix : <?php echo e($exp->price); ?>  <br>Ville :                            <?php if($exp->ville == '01'): ?>
                           01 - Ain
                           <?php elseif($exp->ville == '02'): ?>
                           02 - Aisne
                           <?php elseif($exp->ville == '03'): ?>
                           03 - Allier
                           <?php elseif($exp->ville == '04'): ?>
                           04 - Alpes de Haute Provence
                           <?php elseif($exp->ville == '05'): ?>
                           05 - Alpes (Hautes)
                           <?php elseif($exp->ville == '06'): ?>
                           06 - Alpes Maritimes
                           <?php elseif($exp->ville == '07'): ?>
                           07 - Ard&egrave;che
                           <?php elseif($exp->ville == '08'): ?>
                           08 - Ardennes
                           <?php elseif($exp->ville == '09'): ?>
                           09 - Ari&egrave;ge
                           <?php elseif($exp->ville == '10'): ?>
                           10 - Aube
                           <?php elseif($exp->ville == '11'): ?>
                           11 - Aude
                           <?php elseif($exp->ville == '12'): ?>
                           12 - Aveyron
                           <?php elseif($exp->ville == '13'): ?>
                           13 - Bouches du Rh&ocirc;ne
                           <?php elseif($exp->ville == '14'): ?>
                           14 - Calvados
                           <?php elseif($exp->ville == '15'): ?>
                           15 - Cantal
                           <?php elseif($exp->ville == '16'): ?>
                           16 - Charente
                           <?php elseif($exp->ville == '17'): ?>
                           17 - Charente Maritime
                           <?php elseif($exp->ville == '18'): ?>
                           18 - Cher
                           <?php elseif($exp->ville == '19'): ?>
                           19 - Corr&egrave;ze
                           <?php elseif($exp->ville == '20'): ?>
                           20 - Corse
                           <?php elseif($exp->ville == '21'): ?>
                           21 - C&ocirc;te d&acute;Or
                           <?php elseif($exp->ville == '22'): ?>
                           22 - C&ocirc;tes d&acute;Armor
                           <?php elseif($exp->ville == '23'): ?>
                           23 - Creuse
                           <?php elseif($exp->ville == '24'): ?>
                           24 - Dordogne
                           <?php elseif($exp->ville == '25'): ?>
                           25 - Doubs
                           <?php elseif($exp->ville == '26'): ?>
                           26 - Dr&ocirc;me
                           <?php elseif($exp->ville == '27'): ?>
                           27 - Eure
                           <?php elseif($exp->ville == '28'): ?>
                           28 - Eure et Loir
                           <?php elseif($exp->ville == '29'): ?>
                           29 - Finist&egrave;re
                           <?php elseif($exp->ville == '30'): ?>
                           30 - Gard
                           <?php elseif($exp->ville == '31'): ?>
                           31 - Garonne (Haute)
                           <?php elseif($exp->ville == '32'): ?>
                           32 - Gers
                           <?php elseif($exp->ville == '33'): ?>
                           33 - Gironde
                           <?php elseif($exp->ville == '34'): ?>
                           34 - H&eacute;rault
                           <?php elseif($exp->ville == '35'): ?>
                           35 - Ille et Vilaine
                           <?php elseif($exp->ville == '36'): ?>
                           36 - Indre
                           <?php elseif($exp->ville == '37'): ?>
                           37 - Indre et Loire
                           <?php elseif($exp->ville == '38'): ?>
                           38 - Is&egrave;re
                           <?php elseif($exp->ville == '39'): ?>
                           39 - Jura
                           <?php elseif($exp->ville == '40'): ?>
                           40 - Landes
                           <?php elseif($exp->ville == '41'): ?>
                           41 - Loir et Cher
                           <?php elseif($exp->ville == '42'): ?>
                           42 - Loire
                           <?php elseif($exp->ville == '43'): ?>
                           43 - Loire (Haute)
                           <?php elseif($exp->ville == '44'): ?>
                           44 - Loire Atlantique
                           <?php elseif($exp->ville == '45'): ?>
                           45 - Loiret
                           <?php elseif($exp->ville == '46'): ?>
                           46 - Lot
                           <?php elseif($exp->ville == '47'): ?>
                           47 - Lot et Garonne
                           <?php elseif($exp->ville == '48'): ?>
                           48 - Loz&egrave;re
                           <?php elseif($exp->ville == '49'): ?>
                           49 - Maine et Loire
                           <?php elseif($exp->ville == '50'): ?>
                           50 - Manche
                           <?php elseif($exp->ville == '51'): ?>
                           51 - Marne
                           <?php elseif($exp->ville == '52'): ?>
                           52 - Marne (Haute)
                           <?php elseif($exp->ville == '53'): ?>
                           53 - Mayenne
                           <?php elseif($exp->ville == '54'): ?>
                           54 - Meurthe et Moselle
                           <?php elseif($exp->ville == '55'): ?>
                           55 - Meuse
                           <?php elseif($exp->ville == '56'): ?>
                           56 - Morbihan
                           <?php elseif($exp->ville == '57'): ?>
                           57 - Moselle
                           <?php elseif($exp->ville == '58'): ?>
                           58 - Ni&egrave;vre
                           <?php elseif($exp->ville == '59'): ?>
                           59 - Nord
                           <?php elseif($exp->ville == '60'): ?>
                           60 - Oise
                           <?php elseif($exp->ville == '61'): ?>
                           61 - Orne
                           <?php elseif($exp->ville == '62'): ?>
                           62 - Pas de Calais
                           <?php elseif($exp->ville == '63'): ?>
                           63 - Puy de D&ocirc;me
                           <?php elseif($exp->ville == '64'): ?>
                           64 - Pyr&eacute;n&eacute;es Atlantiques
                           <?php elseif($exp->ville == '65'): ?>
                           65 - Pyr&eacute;n&eacute;es (Hautes)
                           <?php elseif($exp->ville == '66'): ?>
                           66 - Pyr&eacute;n&eacute;es Orientales
                           <?php elseif($exp->ville == '67'): ?>
                           67 - Rhin (Bas)
                           <?php elseif($exp->ville == '68'): ?>
                           68 - Rhin (Haut)
                           <?php elseif($exp->ville == '69'): ?>
                           69 - Rh&ocirc;ne
                           <?php elseif($exp->ville == '70'): ?>
                           70 - Sa&ocirc;ne (Haute)
                           <?php elseif($exp->ville == '71'): ?>
                           71 - Sa&ocirc;ne et Loire
                           <?php elseif($exp->ville == '72'): ?>
                           72 - Sarthe
                           <?php elseif($exp->ville == '73'): ?>
                           73 - Savoie
                           <?php elseif($exp->ville == '74'): ?>
                           74 - Savoie (Haute)
                           <?php elseif($exp->ville == '75'): ?>
                           75 - Paris (Dept.)
                           <?php elseif($exp->ville == '76'): ?>
                           76 - Seine Maritime
                           <?php elseif($exp->ville == '77'): ?>
                           77 - Seine et Marne
                           <?php elseif($exp->ville == '78'): ?>
                           78 - Yvelines
                           <?php elseif($exp->ville == '79'): ?>
                           79 - S&egrave;vres (Deux)
                           <?php elseif($exp->ville == '80'): ?>
                           80 - Somme
                           <?php elseif($exp->ville == '81'): ?>
                           81 - Tarn
                           <?php elseif($exp->ville == '82'): ?>
                           82 - Tarn et Garonne
                           <?php elseif($exp->ville == '83'): ?>
                           83 - Var
                           <?php elseif($exp->ville == '84'): ?>
                           84 - Vaucluse
                           <?php elseif($exp->ville == '85'): ?>
                           85 - Vend&eacute;e
                           <?php elseif($exp->ville == '86'): ?>
                           86 - Vienne
                           <?php elseif($exp->ville == '87'): ?>
                           87 - Vienne (Haute)
                           <?php elseif($exp->ville == '88'): ?>
                           88 - Vosges
                           <?php elseif($exp->ville == '89'): ?>
                           89 - Yonne
                           <?php elseif($exp->ville == '90'): ?>
                           90 - Belfort (Territoire de)
                           <?php elseif($exp->ville == '91'): ?>
                           91 - Essonne
                           <?php elseif($exp->ville == '92'): ?>
                           92 - Hauts de Seine
                           <?php elseif($exp->ville == '93'): ?>
                           93 - Seine Saint Denis
                           <?php elseif($exp->ville == '94'): ?>
                           94 - Val de Marne
                           <?php elseif($exp->ville == '95'): ?>
                           95 - Val d&acute;Oise
                           <?php elseif($exp->ville == '98'): ?>
                           98 - Mayotte
                           <?php elseif($exp->ville == '9A'): ?>
                           9A - Guadeloupe
                           <?php elseif($exp->ville == '9B'): ?>
                           9B - Guyane
                           <?php elseif($exp->ville == '9C'): ?>
                           9C - Martinique
                           <?php elseif($exp->ville == '9D'): ?>
                           9D - R&eacute;union
                           <?php endif; ?><br>
                           Propriétaire : <?php echo e($exp->owner); ?></h2>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="aboutImg">
    <?php if($exp->photo): ?>
    <a href="<?php echo e(route('exp.photo.index',[$exp->id])); ?>"> <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>"
        alt="<?php echo e($exp->photo); ?>" /></a>
        <?php else: ?>
        <?php echo e(link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'cartBtn Btn add'])); ?>

        <?php endif; ?>
    </div>
</div>

<!-- ======= 2.03 Page Service Area ====== -->

<div class="aboutServiceArea secPdng ">
    <div class="container animated">
        <div class="row">
            <div class="col-md-12">
                <div class="sectionTitle">
                    <div class="h2">Informations complémentaires :   <?php if(!$exp->availability): ?>
                      pas
                      <?php endif; ?>
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
                 <div class="aServiceTitle h4"><?php echo e($exp->rooms); ?> chambre(s)</div>
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
          <div class="aServiceTitle h4"><?php echo e($exp->surface); ?> m²</div>
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
       <div class="aServiceTitle h4"><?php if(!$exp->parking): ?>
          pas de
          <?php endif; ?>
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
       <div class="aServiceTitle h4"><?php echo e($exp->level); ?>e étage
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
       <div class="aServiceTitle h4"><?php if(!$exp->elevator): ?>
          pas d'
          <?php endif; ?>
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
       <div class="aServiceTitle h4">Chauffage <?php if(!$exp->electicity): ?>
        Gaz
        <?php else: ?>
        Electricité
        <?php endif; ?></div>
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
       <div class="aServiceTitle h4">Class energy <?php echo e($exp->class_nrj); ?>

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
       <div class="aServiceTitle h4">Class gaz <?php echo e($exp->class_gaz); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>