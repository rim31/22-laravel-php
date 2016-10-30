<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>

                <div class="panel-body">
                    <?php echo Form::open(array('route' => 'exp.store')); ?>



                   Nouvelle expérience
                    <div class="form-group">
                        <?php echo Form::label('name', 'Title'); ?>

                        <?php echo Form::text('name', null, ['class' =>'form-control']); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('adress', 'adress'); ?>

                        <?php echo Form::textarea('adress', null, ['class' =>'form-control']); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('price', 'price'); ?>

                        <?php echo Form::text('price', null, ['class' =>'form-control']); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('name_owner', 'propriétaire'); ?>

                        <?php echo Form::text('name_owner', null, ['class' =>'form-control']); ?>

                    </div>

                    <div class="form-group">
                        Surface(m²) <?php echo Form::selectRange('surface', 1, 9999); ?>

                        | Room <?php echo Form::selectRange('room', 1, 20); ?>

                        | Level <?php echo Form::selectRange('level', 1, 20); ?>

                        | Parking<?php echo e(Form::checkbox('parking', '1')); ?>

                        | Elevator<?php echo e(Form::checkbox('lift', '1')); ?>

                        | Heat electricity<?php echo e(Form::checkbox('electricity', '1')); ?>

                        | Class energy <?php echo Form::select('class_nrj', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E'); ?>

                        | Class gaz <?php echo Form::select('class_gaz', array('A' => 'A', 'B' => 'B','C' => 'C','D' => 'D','E' => 'E',), 'E'); ?>

                        | dispo<?php echo e(Form::checkbox('availability', '1')); ?>


                    </div>
                    <div class="form-group">
                        Photo<?php echo Form::file('image'); ?>

                    </div>
                    <div class="form-group">
                        video<?php echo Form::file('video'); ?>

                    </div>

                    <button class="btn btn-primary">Envoyer</button>
                    <?php echo Form::close(); ?>


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