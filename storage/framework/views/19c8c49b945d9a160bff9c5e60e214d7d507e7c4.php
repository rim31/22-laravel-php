<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Photos</div>
				<?php if(Session::has('message')): ?>
				<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
				<?php endif; ?>
				<div class="panel-body">


                        <?php foreach($users as $user): ?>
                            <?php if($user->id_user == Auth::user()->id): ?>
                                <?php foreach($exps as $exp): ?>
                                <tr>
                                  <?php if($user->id_exp == $exp->id): ?>
                                    <td><?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></td>
                                    <td>
                                        <?php echo Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')); ?>

                                        <?php echo e(link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary'])); ?>

                                        |
                                        <?php echo Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                    <td><a class="btn btn-info" href="<?php echo e(url('hotspot')); ?>"> Hotspot</a></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
						
                        <?php foreach($images as $image): ?>
							<?php echo e($image->name); ?>

						<?php endforeach; ?>
                        <?php foreach($joins as $join): ?>
							<?php echo e($join->exp_id); ?> / <?php echo e($join->image_id); ?>

						<?php endforeach; ?>

				</div>
			</div>
			<?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', null, ['class' => 'btn btn-success'])); ?>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>