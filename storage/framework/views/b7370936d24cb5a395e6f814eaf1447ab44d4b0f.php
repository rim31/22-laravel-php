<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Gallerie photos</div>
				<?php if(Session::has('message')): ?>
				<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
				<?php endif; ?>
				<div class="panel-body">
					<h1><?php echo e(link_to_route('exp.photo.hotspot.index', $exp->name, [$exp->id, 0])); ?></h1><?php echo e($exp->adress); ?><BR>
					<BR>
					<?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success'])); ?>

                     <table class="table">
                        <tr>
                            <th>Photo</th>
                            <th>Action</th>
                            <th>Editer</th>
                            <th>Photo de couverture</th>
                        </tr>
                        <tr>
							<BR>
							<?php foreach($joins as $join): ?>
							<?php if($exp->id == $join->exp_id): ?>
							<?php foreach($images as $image): ?>
								<?php if($image->id == $join->image_id): ?>
		 						<td><img src="/img/<?php echo e($exp->id); ?>/<?php echo e($image->name); ?>" alt="/img/<?php echo e($exp->id); ?>/<?php echo e($image->name); ?>" style="width:200px;height:100px;"/> </td>
								<!-- <td><a class="btn btn-info" href="<?php echo e(url('hotspot')); ?>"> Editer hotspot</a> </td> -->
		                        <td><?php echo e(link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $image->id], ['class' => 'btn btn-info'])); ?></td>

								<td><?php echo Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'DELETE')); ?>

							    <input type="text" name="image" value="<?php echo e($image->id); ?>" hidden>
								<?php echo Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']); ?> </td>
								<?php echo Form::close(); ?>

								</td>
								<td>
									<?php echo Form::open(array('route'=>['cover', $exp->id, $image->id])); ?>

									<?php echo Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']); ?>

									<?php echo Form::close(); ?>

									<?php echo e(link_to_route('exp.photo.hotspot.index', 'gallerie', [$exp->id, $image->id], ['class' => 'btn btn-info'])); ?>

								</td>
								</tr>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							<?php endforeach; ?>


				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>