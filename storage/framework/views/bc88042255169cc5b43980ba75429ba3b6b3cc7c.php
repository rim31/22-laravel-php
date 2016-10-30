<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />
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
                    <?php for($i = 0; $i < sizeOf($joinexpimages); $i++): ?>
                    <!-- <DIV class="item <?php if($i ==0): ?> active <?php endif; ?>"> -->
                    <?php if($i == 0): ?>
                    <DIV class="item  active">
                    <?php else: ?>
                    <DIV class="item">
                    <?php endif; ?>
                      <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG')); ?>" alt="immovr" class="photo">
                  </DIV>
                    <?php endfor; ?>
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
                      <?php echo e($path = storage_path().'\ville.jpg'); ?>

                      <img src="<?php echo e(URL::asset($path)); ?>" >

                  </DIV> -->




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
                                <DIV class="col-sm-10">
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
                                </DIV>
                                <!-- <button class="btn btn-primary">Envoyer</button> -->
                                <DIV class="col-sm-2">
        							<?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info'])); ?>

        						</DIV>
                                <?php echo Form::close(); ?>

                            </DIV>



                <!-- JavaScripts -->

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/carousel.js')); ?>"></script>

            </DIV>
        </DIV>
          </nav>

          <?php echo $__env->yieldContent('content'); ?>

        </main>
    </DIV>

    </body>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>