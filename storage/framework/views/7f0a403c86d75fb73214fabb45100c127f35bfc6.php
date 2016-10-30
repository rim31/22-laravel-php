<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>
                <?php if(Session::has('message')): ?>
                    <div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
                <?php endif; ?>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                            <th>Hotspot</th>

                        </tr>
                        <?php foreach($exps as $exp): ?>
                        <tr>
                            <td><?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></td>
                            <td>
                                <?php echo Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')); ?>

                                     <?php echo e(link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary'])); ?>

                                |
                                    <?php echo Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

                                <?php echo Form::close(); ?>

                            </td>
                            <td><a class="btn btn-info" href="<?php echo e(url('hotspot')); ?>"> Hotspot</a></td>
                        </tr>
                        <?php endforeach; ?> 
                    </table>            
                </div>
            </div>
            <?php echo e(link_to_route('exp.create', 'Add new experience', null, ['class' => 'btn btn-success'])); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>