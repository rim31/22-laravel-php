<?php $__env->startSection('content'); ?>

<!-- ======= 2.01 Page Title Area ====== -->
<div class="pageTitleArea animated">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="h3">Expérience</div>
				<ul class="pageIndicate">
					<li><a href="">photo</a></li>
					<li><a href="">index</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php if(Session::has('message')): ?>
<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<!-- ======= 3.01 Domain Area ====== -->
<div class="domainSearchArea secPdng">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			</div>
			<div class="col-md-10 col-md-offset-1 clearfix">

			</div>
			<div class="col-md-12">
				<ul class="domains">
					<li class="availableDomain clearfix  animated">
						<div class="aDomainLeft clearfix">
							<div class="DomainName">
								<div class="h3"> Vos photos : <?php echo e(link_to_route('exp.photo.hotspot.index', $exp->name, [$exp->id, 0])); ?></div>
								<span><?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'cartBtn Btn add'])); ?></span>
							</div>
						</div>
						<div class="domainBtn clearfix">         
							<?php if($exp->photo): ?>
							<?php echo e(link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btnCart Btn'])); ?>

							<?php else: ?>
							favoris d'abord
							<?php endif; ?>

							<?php echo e(link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default'])); ?>

						</div>

					</li>
					<?php for($i = 0; $i < sizeOf($joins); $i++): ?>
					<?php if($joins[$i]->delete != 1): ?>
					<li class="singleDomain  animated">
						<div class="h4">
								<a href="">
									<img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG')); ?>" alt="immovr" class="photo" style="width:199px;height:99px;">
								</a>
								<?php echo e(link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'cartBtn add'])); ?>

							<div class="singleDomainRight">
								<span>
									<?php if($joins[$i]->id == $exp->photo): ?>
									<i class="fa fa-star" aria-hidden="true"></i> favoris
									<?php else: ?>
									<?php echo Form::open(array('route'=>['cover'])); ?>

									<input type="text" name="exp" value="<?php echo e($exp->id); ?>" hidden>
									<input type="text" name="name" value="<?php echo e($exp->name); ?>" hidden>
									<input type="text" name="id" value="<?php echo e($joins[$i]->id); ?>" hidden>
									<?php echo Form::button('Choix  <i class="fa fa-star-o" aria-hidden="true"></i>', ['class'=>'btn btn-default', 'type'=>'submit']); ?>

									<?php echo Form::close(); ?>

									<?php endif; ?>
	<!-- <?php echo e(link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info'])); ?> -->
								</span>
								<span>
									<?php echo Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')); ?>

									<input type="text" name="image" value="<?php echo e($joins[$i]->id); ?>" hidden>
									<?php echo Form::button('Effacer la photo', ['class'=>'btnCart Btn added', 'type'=>'submit']); ?>

									<?php echo Form::close(); ?>

								</span>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div>
		</div

		
<!-- ======= /3.01 Domain Area ====== -->

    <div class="sectionBar"></div>






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
								<div class="col-sm-8">
									<?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'btn btn-success'])); ?>

								</div>
								<div class="col-sm-2">
									<?php if($exp->photo): ?>
									<?php echo e(link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btn btn-success'])); ?>

									<?php else: ?>
									favoris d'abord
									<?php endif; ?>
								</div>
								<div class="col-sm-2">
									<?php echo e(link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default'])); ?>

								</div>

								<table class="table">
									<tr>
										<th>Photo</th>
										<th>Editer</th>
										<th>Action</th>
										<th>Favoris</th>
<!-- 									<th>Gallerie</th>
-->								<tr>
<?php for($i = 0; $i < sizeOf($joins); $i++): ?>
<?php if($joins[$i]->delete != 1): ?>
<td>
	<img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG')); ?>"
	alt="immovr" class="photo" style="width:100px;height:50px;">

</td>
<td>
	<?php echo e(link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-primary'])); ?>

</td>
<td><?php echo Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')); ?>

	<input type="text" name="image" value="<?php echo e($joins[$i]->id); ?>" hidden>
	<?php echo Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

</td>
<?php echo Form::close(); ?>

<td>
	<?php if($joins[$i]->id == $exp->photo): ?>
	favoris
	<?php else: ?>
	<?php echo Form::open(array('route'=>['cover'])); ?>

	<input type="text" name="exp" value="<?php echo e($exp->id); ?>" hidden>
	<input type="text" name="name" value="<?php echo e($exp->name); ?>" hidden>
	<input type="text" name="id" value="<?php echo e($joins[$i]->id); ?>" hidden>
	<?php echo Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']); ?>

	<?php echo Form::close(); ?>

	<?php endif; ?>
</td>
<!-- 									<td>
										<?php echo e(link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info'])); ?>

									</td> -->
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