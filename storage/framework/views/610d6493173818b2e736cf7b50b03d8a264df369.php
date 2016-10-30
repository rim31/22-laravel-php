<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Editer votre experience</div>

                <div class="panel-body">
                    <label>gallerie photos</label>
                    <?php echo e(link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info'])); ?>

                    <?php echo Form::model($exp, array('route' => ['exp.update', $exp->id], 'method'=>'PUT')); ?>

                    <div class="form-group col-sm-12">
                        <?php echo Form::label('name', 'Titre'); ?>

                        <?php echo Form::text('name', null, ['class' =>'form-control']); ?>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('about', 'informations'); ?>

                            <?php echo Form::textarea('about', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('price', 'prix'); ?>

                            <?php echo Form::text('price', null, ['class' =>'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('adress', 'adresse'); ?>

                            <?php echo Form::textarea('adress', null, ['class' =>'form-control','maxlength' => '50', 'rows'=> '3' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('name_owner', 'propriétaire'); ?>

                            <?php echo Form::text('name_owner', null, ['class' =>'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-12">
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
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="photo">PHOTO</label> (obligatoire)<?php echo Form::file('photo'); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="video">VIDEO</label> (optionnel)<?php echo Form::file('video'); ?>

                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-success">Envoyer</button>
                        <?php echo Form::close(); ?>

                        <?php echo e(link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-danger'])); ?>

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