

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspot.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspotArea.css')); ?>" />
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h5><?php echo e($exp->name); ?></h5></div>

        <!--================= boutons generaux ================-->
          <div class="col-md-8"><h4>Placer votre hotspot sur l'image</h4>
          </div>
          <div class="col-md-4">
          <table>

  <!--           <th>
              <?php echo Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')); ?>

              <input type="text" name="image" value="<?php echo e($image->id); ?>" hidden>
              <?php echo Form::button('ajouter hotspot', ['class'=>'btn btn-primary', 'type'=>'submit']); ?>

            </th> -->
            <?php echo Form::close(); ?>

            <th>
              <?php echo Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')); ?>

              <input type="text" name="image" value="<?php echo e($image->id); ?>" hidden>
              <?php echo Form::button('supprimer les hotspots', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

              <?php echo Form::close(); ?>

            </th>
            <th>
              <?php echo Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')); ?>

              <input type="text" name="image" value="<?php echo e($image->id); ?>" hidden>
              <?php echo Form::button('Retour gallerie', ['class'=>'btn btn-secondary', 'type'=>'submit']); ?>

              <?php echo Form::close(); ?>

            </th>
          </table>
          </div>

        <div class="panel-body">
          <div>
          </div>
          <!-- ======================== test clic ================================ -->
<!--           <div>
            <p class="displayOffset"></p>
          </div> -->
          <div id="Hospot" class="photo hotspotArea">
            <div class="hotspotTarget"></div>
            <!--           onclick="showCoords(event)" onclick="getCoords(event)">-->
            <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$photo.'.JPG')); ?>" alt="immovr" class="photo">

          </div>
          <!-- ====================miniature selectionnable en ====================== -->

          <div class="row selectLink "><h3>Selectionner la destination</h3>
            <form action="<?php echo e(route('exp.photo.hotspot.store', [$exp->id, $id])); ?>" method="post">
              <div class="btn-group col-md-12" data-toggle="buttons" >
                <!--on parcours notre table de jointure et on affiche les image_id sauf celle en grand :-P -->
                <?php for($i = 0; $i < sizeOf($joinexpimages); $i++): ?>
                <?php if($joinexpimages[$i]->image_id != $id AND $joinexpimages[$i]->delete != 1): ?><!--  && $images[$joinexpimages[$i]->image_id]->delete != 1 -->
                <label class="btn btn-primary col-md-3">
                  <input type="radio" name="image_link" value=<?php echo e($joinexpimages[$i]->image_id); ?> autocomplete="off">
                  <div>
                    <input type="radio" name="imageArrive" id=<?php echo e($joinexpimages[$i]->image_id); ?> value=<?php echo e($joinexpimages[$i]->image_id); ?>><br>
                    <a href="#" class="pop miniature">
                      <?php echo e($joinexpimages[$i]->image_id); ?>

                      <img class="toto" id="link_id" value=<?php echo e($joinexpimages[$i]->image_id); ?>

                      src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG')); ?>"
                      width="100%">
                    </a>
                  </div>
                </label>
                <?php endif; ?>
                <?php endfor; ?>
              </div>
              <!-- pagination -->
              <?php echo e($joinexpimages->links()); ?>

            </div>

            <!-- preview image d'arrivée imagepreview -->
            <div id="hospotLink" class="photo">
              <div class="hotspotTarget2">
              </div>
              <p>
                <h4>Placer votre point d'arrivée</h4>
              </p>
              <img src="" alt="immovr" id="photoLink">
            </div>

            <!-- ========== bouton test save =============-->

            <div class="panel-body hotspotSave">

              <select id="single">
                <option>petit</option>
                <option>moyen</option>
                <option>grand</option>
              </select>
              <input id="media_id" name="media_id" type="text" value="" placeholder="Nom">
              <p></p>
              <input id="shift_x" type="text" name="shift_x" value="" hidden>
              <input id="shift_y" type="text" name="shift_y" value="" hidden>
              <input id="shift_z" type="text" name="shift_z" value="" hidden>
              <input id="position_x" type="text" name="position_x" value="" hidden>
              <input id="position_y" type="text" name="position_y" value="" hidden>
              <input id="position_z" type="text" name="position_z" value="" hidden>
              <input id="depth" type="text" name="depth" value="" hidden>
              <input id="latitude" type="text" name="latitude" value="" hidden>
              <input id="longitude" type="text" name="longitude" value="" hidden>
              <input id="exp_id" type="text" name="exp_id" value=<?php echo e($exp->id); ?> hidden>
              <input id="image_id" type="text" name="image_id" value=<?php echo e($id); ?> hidden>
              <input id="description" type="text" name="description" value="" hidden>
              <input id="image_idX" type="text" name="image_idX" value="" hidden>
              <input id="image_idY" type="text" name="image_idY" value="" hidden>
              <input id="image_linkX" type="text" name="image_linkX" value="" hidden>
              <input id="image_linkY" type="text" name="image_linkY" value="" hidden>
              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

              <input type="submit" name="submit" value="OK" class="btn btn-success">

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- script -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>

  <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/dragndrop.js')); ?>"></script>

  <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/functions.js')); ?>"></script>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>