<?php $__env->startSection('content'); ?>
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />-->
<link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspotArea.css')); ?>" />

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><?php echo e($exp->name); ?></h5></div>
            <div class="panel-body">
                <div>
                    <h4>vos hotspots</h4>
                </div>
                <!-- ======================== afficher l'image ================================ -->
                <button id="displayHotspot" type="button" class="btn btn-success">Afficher les hotspots</button>
                <DIV  id="Hospot" class="photo hotspotArea">
                    <div class="hotspotTarget"></div>
                    <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$id.'.JPG')); ?>" alt="immovr" class="photo">
                </DIV>
                <DIV class="col-sm-10">
                </DIV>
                <DIV class="col-sm-2">
                    <?php echo e(link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info'])); ?>

                </DIV>
                <?php echo Form::close(); ?>

            </DIV>

            <!-- JavaScripts -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!-- <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/carousel.js')); ?>"></script> -->
            <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

            <script>
                $('#displayHotspot').click(function(e) {
                var H = $('.hotspotArea').height();
                var W = $('.hotspotArea').width();
                var spotX = 0;
                var spotY = 0;
                // récupération des positions
                <?php for($spot = 0; $spot < sizeOf($hotspots); $spot++): ?>
                    spotX = W * (('<?php echo e($hotspots[$spot]->longitude); ?>' + 180) / 360);
                    spotY = H * (('<?php echo e($hotspots[$spot]->latitude); ?>' - 90 ) / (-180));
                    console.log('<?php echo e($hotspots[$spot]->longitude); ?>' ,' => ', spotY, '<?php echo e($hotspots[$spot]->latitude); ?>' ,' => ', spotX);//'<?php echo e($hotspots[$spot]); ?>'
                $('.hotspotTarget').addClass('circleLarge').offset({ top: spotY, left:spotX});
                <?php endfor; ?>
             });

            // // ajax
            // $("button").click(function(){
            //     $.ajax({url: "http://localhost/ivr/resources/exps/photos/hotspots/show.blade.php", success: function(result){
            //         console.log(result);
            //         var test = JSON.parse(result);
            //         for (var i = 0; i < test.length; i++) {
            //             console.log(test[i]);
            //         };
            //     }});
            // });

            </script>
    </DIV>
</DIV>
</DIV>
</nav>

<?php echo $__env->yieldContent('content'); ?>

</main>

</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>