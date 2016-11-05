<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ajouter exp.photo</div>

                <h1><?php echo e($exp->id); ?></h1>

<!--                     <div class="panel-body">
                        <form action="<?php echo e(route('exp.photo.store', $exp->id)); ?>" method="post" enctype="multipart/form-data">
                            <label>PHOTO</label>
                            <input type="file" name="file" id="file">
                            <input type="submit" name="submit" value="upload">
                            <input type="text" name="id" value="<?php echo e($exp->id); ?>" hidden>
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        </form>
                    </div>
 -->
                <form action="<?php echo e(route('exp.photo.store', $exp->id)); ?>" method="post" 
                enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="text" name="id" value="<?php echo e($exp->id); ?>" hidden>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="submit" value="envoyer" class="btn btn-success">
                </form>

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