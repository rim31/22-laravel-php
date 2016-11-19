<?php $__env->startSection('content'); ?>

<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">Photo</div>
                <ul class="pageIndicate">
                    <li><a href="">expérience</a></li>
                    <li><a href="">photo</a></li>
                    <li><a href="">ajouter</a></li>
                </ul>
            </div>
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
<!-- ======= /2.01 Page Title Area ====== -->

<div class="stepArea secPdng animated">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sectionTitle">
                    <div class="h2">Ajouter une photo à votre expérience.
                        <br>puis <span>envoyer</span> pour terminer.
                    </div>
                </div>
            </div>
        </div>


        <form action="<?php echo e(route('exp.photo.store', $exp->id)); ?>" method="post" 
            enctype="multipart/form-data">
            <div class="fileInput">
                <span class="fileTxt">Glisser et déposer ou</span>
                <span class="fileSpan">
                    <input type="file" name="file" id="file" class="inputfile">
                    <label for="file">importer</label>
                    <input type="text" name="id" value="<?php echo e($exp->id); ?>" hidden>
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                </span>
                <span class="fileTxt">votre image ici</span>
                
            </div>
            <div class="captcha" data-toggle="tooltip" data-placement="top" title="Active Me!"><span></span> I am not a robot</div>
            <input type="submit" value="envoyer" class="btnCart Btn add">
            <?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btnCart Btn added'])); ?>

        </form>
    </div>
</div>

<div class="sectionBar"></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>