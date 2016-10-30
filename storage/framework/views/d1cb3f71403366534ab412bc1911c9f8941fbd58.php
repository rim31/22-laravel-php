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
					<h2><?php echo e(link_to_route('exp.photo.hotspot.index', $exp->name, [$exp->id, 0])); ?></h2><?php echo e($exp->adress); ?><BR>
						<BR>
							<div class="col-sm-10">
								<?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success'])); ?>

							</div>
							<div class="col-sm-2">
								<?php echo e(link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default'])); ?>

							</div>

							<table class="table">
								<tr>
									<th>Photo</th>
									<th>Action</th>
									<th>Editer</th>
									<th>Photo de couverture</th>
								</tr>
								<tr>
									<?php for($i = 0; $i < sizeOf($joins); $i++): ?>
									<?php if($joins[$i]->delete != 1): ?>
									<td>
										/img/<?php echo e($exp->id); ?>/<?php echo e($joins[$i]->id); ?>.JPG
										<img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.JPG')); ?>"
										alt="immovr" class="photo" style="width:200px;height:100px;">
									</td>
									<td>
										<?php echo e(link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-info'])); ?>

									</td>
									<td><?php echo Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')); ?>

										<input type="text" name="image" value="<?php echo e($joins[$i]->id); ?>" hidden>
										<?php echo Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

									</td>
									<?php echo Form::close(); ?>

									<td>
										<?php echo Form::open(array('route'=>['cover', $exp->id, $joins[$i]->id])); ?>

										<?php echo Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']); ?>

										<?php echo Form::close(); ?>

										<?php echo e(link_to_route('exp.photo.hotspot.index', 'gallerie', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-info'])); ?>

									</td>
									<?php endif; ?>
								</tr>
								<?php endfor; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>