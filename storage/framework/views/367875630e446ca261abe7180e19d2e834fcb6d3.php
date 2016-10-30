<link rel="stylesheet" href="<?php echo e(URL::asset('css/homePage.css')); ?>" />
<?php $__env->startSection('content'); ?>
<body>
	<main>
		<div class="container">

		</div>
		<div class="container-fluid">
			<iframe width="100%" height="550" src="https://www.youtube.com/embed/EHZH-VJ5L8w" frameborder="0" allowfullscreen></iframe>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-4"><div class="carreau2"><img src="<?php echo e(URL::asset('/img/ville6.jpg')); ?>" alt="immovr" class="photo"></div></div>
				<div class="col-md-8"><img src="<?php echo e(URL::asset('/img/ville5.jpg')); ?>" alt="immovr" class="photo carreau2"></div>
			</div>
			<div class="row">
				<div class="col-md-4"><div class="carreau2"><img src="<?php echo e(URL::asset('/img/ville2.jpg')); ?>" alt="immovr" class="photo"></div></div>
				<div class="col-md-4"><div class="carreau2"><img src="<?php echo e(URL::asset('/img/ville3.jpg')); ?>" alt="immovr" class="photo"></div></div>
				<div class="col-md-4"><div class="carreau2"><img src="<?php echo e(URL::asset('/img/ville4.jpg')); ?>" alt="immovr" class="photo"></div></div>
			</div>
			<div class="row">
				<div class="col-md-8"><img src="<?php echo e(URL::asset('/img/ville8.jpg')); ?>" alt="immovr" class="photo carreau2"></div>
				<div class="col-md-4"><img src="<?php echo e(URL::asset('/img/ville7.jpg')); ?>" alt="immovr" class="photo carreau3"></div>
			</div>
			<div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2629.6320511233143!2d1.98263288269402!3d48.7698225503926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e683ecfbdd90b3%3A0x401dda97667bc71!2s3+Rue+des+Bleuets%2C+78190+Trappes!5e0!3m2!1sen!2sfr!4v1476969554766" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</main>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>