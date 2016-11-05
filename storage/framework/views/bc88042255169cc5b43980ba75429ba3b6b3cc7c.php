<?php $__env->startSection('content'); ?>
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />
 --><link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspotArea.css')); ?>" />

<DIV class="parent">

  <body id="app-layout">
     <main>
        <nav class="navbar navbar-default navbar-static-top">
          <DIV class="container">
            <DIV class="navbar-header">
              <DIV class="container">

               <div  id="Hospot" class="hotspotArea col-md-12">
                <div class="hotspotTarget">
                  <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$id.'.PNG')); ?>" alt="immovr" class="photo">
                  <!-- <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>" alt="immovr" class="photo"> -->
                </div>
              </div>
            </DIV>
            <DIV class="panel-heading">
              <?php echo e($exp->name); ?>

            </DIV>

            <DIV class="panel-body">
              Informations : </BR>
              <h2><?php echo e($exp->about); ?></h2>
              address : </BR>
              <h2><?php echo e($exp->adress); ?></h2>
              <DIV class="panel-body">
                price :    </BR>
                <?php echo e($exp->price); ?> €
              </DIV>
              <DIV class="panel-body">
                owner :    </BR>
                <?php echo e($exp->name_owner); ?>

              </DIV>
              <DIV class="form-group">
                <DIV class="col-sm-10">
                  Surface <?php echo e($exp->surface); ?>m²
                  | Room <?php echo e($exp->room); ?>

                  | Level <?php echo e($exp->level); ?>

                  |
                  <?php if(!$exp->parking): ?>
                  pas de
                  <?php endif; ?>
                  Parking
                  <?php if(!$exp->elevator): ?>
                  pas d'
                  <?php endif; ?>
                  ascensseur
                  |
                  | chauf <?php if(!$exp->electicity): ?>
                  gaz
                  <?php else: ?>
                  Electrique
                  <?php endif; ?>
                  | Class energetique <?php echo e($exp->class_nrj); ?>

                  | Class gaz <?php echo e($exp->class_gaz); ?>

                  |
                  <?php if(!$exp->availability): ?>
                  pas
                  <?php endif; ?>
                  disponible
                </DIV>
                <DIV class="col-sm-2">
                  <?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info'])); ?>

                </DIV>
              </DIV>
            </DIV>

            <!-- JavaScripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--               <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/hotspot.js')); ?>"></script> -->
            <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
          </DIV>
        </DIV>
      </nav>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Pièce suivante</h4>
      </div>
      <div class="modal-body">
        <img id="image_link" src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>" alt="immovr" class="photo" href="">
      </div>
      <div class="modal-footer">
    <!--    <?php echo e(link_to_route('exp.photo.hotspot.index', 'gallerie', [$exp->id, $id], ['class' => 'btn btn-info'])); ?> -->
        <div id="bouttonLink"></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Supprimer le hotspot</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

      <?php echo $__env->yieldContent('content'); ?>

    </main>
</body>
</DIV>

<script>
$(document).ready(function(e) 
{
  var H = $('.hotspotArea').height();
  var W = $('.hotspotArea').width();
  // récupération des positions
  <?php for($spot = 0; $spot < sizeOf($hotspots); $spot++): ?>
  var x = '<?php echo e($hotspots[$spot]->position_x); ?>';
  var y = '<?php echo e($hotspots[$spot]->position_y); ?>';
  //CALCUL CONVERSION longitude lattitude POUR OLIVIA
  //=================================================
  var posx = Number(W) * Number(x);
  var posy = Number(H) * Number(y);
  $('.hotspotTarget').append('<div id="'+'<?php echo e($hotspots[$spot]->id); ?>'+'" data-link="'+<?php echo e($hotspots[$spot]->image_link); ?>+'" class="circleSmall" style="background-color:red;position:absolute;width:20px;top:'+posy+';left:'+posx+';" onclick="myFunction(this.id)" data-toggle="modal" data-target="#myModal"></div>');
  console.log(posx, posy, x, y);
  <?php endfor; ?>
  });

  function myFunction(id) {
  document.getElementById("image_link").setAttribute("src",'/img/'+<?php echo e($exp->id); ?>+'/'+$('#'+id).data("link")+'.PNG');
  document.getElementById("image_link").setAttribute("href",'url(exp.<?php echo e(1); ?>.image.<?php echo e(1); ?>.hotspot.index)');
   $('#bouttonLink').html('<a href="/exp/'+<?php echo e($exp->id); ?>+'/photo/'+$('#'+id).data("link")+'/hotspot" class="btn btn-success">Go !</a>');
  }


</script>
<?php $__env->stopSection(); ?>

<!-- ("div").data("data-link") -->

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>