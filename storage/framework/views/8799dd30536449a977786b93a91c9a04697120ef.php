

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />
<div class="parent">

  <body id="app-layout">
    <div class="3dPhoto">

      <main>
        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">

              <div class="container">
                <br>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <?php for($i = 0; $i < sizeOf($joinexpimages); $i++): ?>
                    <!-- <div class="item <?php if($i ==0): ?> active <?php endif; ?>"> -->
                    <?php if($i == 0): ?>
                    <div class="item  active">
                    <?php else: ?>
                    <div class="item">
                    <?php endif; ?>
                      <img src="/img/<?php echo e($exp->id); ?>/<?php echo e($joinexpimages[$i]->image_id); ?>.JPG" alt="/img/<?php echo e($exp->id); ?>/<?php echo e($joinexpimages[$i]->image_id); ?>.JPG">
                    </div>
                    <?php endfor; ?>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>



                            <DIV class="panel-heading"><?php echo e($exp->name); ?></DIV>

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
                                    Surface <?php echo e($exp->surface); ?>m²
                                    | Room <?php echo e($exp->room); ?>

                                    | Level <?php echo e($exp->level); ?>

                                    |
                                    <?php if(!$exp->parking): ?>
                                        no
                                        <?php endif; ?>
                                    Parking
                                    <?php if(!$exp->elevator): ?>
                                        no
                                    <?php endif; ?>
                                    | Elevator
                                    |
                                    | Heat <?php if(!$exp->electicity): ?>
                                      Gas
                                    <?php else: ?>
                                      Electricity
                                    <?php endif; ?>
                                    | Class energy <?php echo e($exp->class_nrj); ?>

                                    | Class gaz <?php echo e($exp->class_gaz); ?>

                                    |
                                    <?php if(!$exp->availability): ?>
                                        no
                                    <?php endif; ?>
                                    available

                                <button class="btn btn-primary">Envoyer</button>
                                <?php echo Form::close(); ?>


                            </DIV>



                <!-- JavaScripts -->

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/carousel.js')); ?>"></script>

              </div>
            </div>
          </nav>

          <?php echo $__env->yieldContent('content'); ?>

        </main>
      </div>

    </body>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>