

<?php $__env->startSection('content'); ?>
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />-->
<link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspotArea.css')); ?>" />

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
           <div class="panel-heading">
             <h5><?php echo e($exp->name); ?></h5>
           </div>
           <div class="panel-body">
            <h4>vos hotspots</h4>
           <!-- ======================== afficher l'image ================================ -->
           <div  id="Hospot" class="hotspotArea col-md-12">
            <div class="hotspotTarget">
             <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$id.'.PNG')); ?>" alt="immovr" class="photo">
            </div>
           </div>
            <div class="col-sm-3">
              <?php echo Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, 0], 'method'=>'DELETE')); ?>

              <input type="text" name="image" value="<?php echo e($id); ?>" hidden>
              <input type="text" name="combien" value="tous" hidden>
              <?php echo Form::button('supprimer les hotspots', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

              <?php echo Form::close(); ?>

          </div>
          <div class="col-sm-2">
              <?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info'])); ?>

              <?php echo Form::close(); ?>

          </div>
          </div>
        </div>
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
        <div id="bouttonLink"></div>
        <?php echo Form::open(array('route'=>['exp.photo.hotspot.show', $exp->id, $id, $id], 'method'=>'GET')); ?>

        <input id="idLinkIndex" type="text" name="spot" value="" hidden>
        <input type="text" name="combien" value="unique" hidden>
        <?php echo Form::button('GO !', ['class'=>'btn btn-info', 'type'=>'submit']); ?>

        <?php echo Form::close(); ?>


        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php echo Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, $id], 'method'=>'DELETE')); ?>

        <input id="idLinkDel" type="text" name="spot" value="" hidden>
        <input type="text" name="combien" value="unique" hidden>
        <?php echo Form::button('supprimer le hotspot', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>
  <!-- JavaScripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/carousel.js')); ?>"></script> -->
  <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

  <script>
  $(document).ready(function(e) {
    // $('#displayHotspot').click(function(e) {
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
      // alert(id);
      console.log($('#'+id).data("link"), id);
      document.getElementById("image_link").setAttribute("src",'/img/'+<?php echo e($exp->id); ?>+'/'+$('#'+id).data("link")+'.PNG');
      document.getElementById("idLinkDel").setAttribute("value", id);
      document.getElementById("idLinkIndex").setAttribute("value", $('#'+id).data("link"));
      $( "#idLinkDel" ).$("input").val( id);
}
  </script>
    </div>
    <?php echo $__env->yieldContent('content'); ?>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>