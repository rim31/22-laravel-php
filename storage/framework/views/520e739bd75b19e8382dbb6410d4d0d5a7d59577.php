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
								<div class="h3"> Vos photos : <?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></div>
								<span><?php echo e(link_to_route('exp.photo.create', 'Ajouter photo', [$exp->id], ['class' => 'cartBtn Btn add'])); ?></span>
							</div>
						</div>
						<div class="domainBtn clearfix flexButton"> 
							<div>
								<?php if($exp->photo): ?>
								<?php echo e(link_to_route('exp.photo.hotspot.show', 'Visite Virtuelle', [$exp->id, $exp->photo, $exp->photo], ['class' => 'btn btn-success'])); ?>

							</div>
							<div>									<!-- =====test Quartz===== -->	
								<?php echo Form::open(array('route'=>['quartz'])); ?>

								<input type="text" name="exp" value="<?php echo e($exp->id); ?>" hidden>
								<input type="text" name="name" value="<?php echo e($exp->name); ?>" hidden>
								<input type="text" name="id" value="<?php echo e($exp->photo); ?>" hidden>
								<?php echo Form::button('Quartz  <i class="fa fa-video-camera fa-1x" aria-hidden="true"></i>', ['class'=>'Btn', 'type'=>'submit']); ?>

								<!-- =====/test Quartz===== -->	
								<?php echo Form::close(); ?>

							</div>
							<div>
								<?php else: ?>
								favoris d'abord
								<?php endif; ?>

								<?php echo e(link_to_route('exp.index', 'Retour', [$exp->id], ['class' => 'btn btn-default'])); ?>

							</div>



						</div>

					</li>
					<?php for($i = 0; $i < sizeOf($joins); $i++): ?>
					<?php if($joins[$i]->delete != 1): ?>
					<li class="singleDomain  animated">
						<div class="h4">
							<a href="">
								<img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$joins[$i]->id.'.PNG')); ?>" alt="immovr" class="photo" style="width:199px;height:99px;">
							</a>
							<?php echo e(link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $joins[$i]->id], ['class' => 'btn btn-success'])); ?>

							<div class="singleDomainRight">
								<span>
									<?php if($joins[$i]->id == $exp->photo): ?>
									<i class="fa fa-star fa-1x" aria-hidden="true"></i> favoris
									<?php else: ?>
									<?php echo Form::open(array('route'=>['cover'])); ?>

									<input type="text" name="exp" value="<?php echo e($exp->id); ?>" hidden>
									<input type="text" name="name" value="<?php echo e($exp->name); ?>" hidden>
									<input type="text" name="id" value="<?php echo e($joins[$i]->id); ?>" hidden>
									<div>
										<?php echo Form::button('Choix  <i class="fa fa-star-o fa-1x" aria-hidden="true"></i>', ['class'=>'btn btn-default', 'type'=>'submit']); ?>

										<?php echo Form::close(); ?>

									</div>
									<!-- =====test Quartz===== 	
									<?php echo Form::open(array('route'=>['quartz'])); ?>

									<input type="text" name="exp" value="<?php echo e($exp->id); ?>" hidden>
									<input type="text" name="name" value="<?php echo e($exp->name); ?>" hidden>
									<input type="text" name="id" value="<?php echo e($joins[$i]->id); ?>" hidden>
									<?php echo Form::button('Quartz  <i class="fa fa-video-camera fa-1x" aria-hidden="true"></i>', ['class'=>'Btn', 'type'=>'submit']); ?>

									 =====/test Quartz===== 
									 <?php echo Form::close(); ?> -->	

									 <?php endif; ?>
	<!-- 								<?php echo e(link_to_route('exp.photo.hotspot.show', 'SHOW test', [$exp->id, $joins[$i]->id, $exp->photo], ['class' => 'btn btn-info'])); ?>

-->
</span>
<div>
	<?php echo Form::open(array('route'=>['exp.photo.destroy', $exp->id, $joins[$i]->id], 'method'=>'DELETE')); ?>

	<input type="text" name="image" value="<?php echo e($joins[$i]->id); ?>" hidden>
	<?php echo Form::button('Effacer la photo', ['class'=>'btnCart Btn added', 'type'=>'submit']); ?>

	<?php echo Form::close(); ?>

</div>
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
<!-- ==========upoload photo ============ -->
<div class="domainCtaArea  animated">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="domainCta">
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
						<input type="submit" value="envoyer la photo" class="btn btn-success">
						<?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btnCart Btn added'])); ?>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ==========/upoload photo ============ -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>