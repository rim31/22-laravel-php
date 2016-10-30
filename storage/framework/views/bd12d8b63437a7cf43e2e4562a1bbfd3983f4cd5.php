

<?php $__env->startSection('content'); ?>
<DIV class="container">
    <DIV class="row">
        <DIV class="col-md-10 col-md-offset-1">
            <DIV class="panel panel-default">
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


                    </DIV>
                    <DIV class="form-group">
                        Photo<?php echo Form::file('image'); ?>

                    </DIV>
                    <DIV class="form-group">
                        video<?php echo Form::file('video'); ?>

                    </DIV>

                    <button class="btn btn-primary">Envoyer</button>
                    <?php echo Form::close(); ?>


                </DIV>
            </DIV>

        </DIV>
    </DIV>
</DIV>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>