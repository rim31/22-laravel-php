

<?php $__env->startSection('content'); ?>
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />-->
<link rel="stylesheet" href="<?php echo e(URL::asset('css/hotspotArea.css')); ?>" />

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <!-- <div class="panel-heading"><h5><?php echo e($exp->name); ?></h5></div>
                <div class="panel-body"> -->
                    <!-- <div>
                        <h4>vos hotspots</h4>
                    </div> -->
                    <!-- ======================== afficher l'image ================================ -->
                    <DIV  id="Hospot" class="hotspotArea">
                        <div class="hotspotTarget">
                            <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$id.'.JPG')); ?>" alt="immovr" class="photo">
                        </div>
                    </DIV>
                    <DIV class="col-sm-10">
                        <button id="displayHotspot" type="button" class="btn btn-success">Afficher les hotspots</button>
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
                // récupération des positions
                <?php for($spot = 0; $spot < sizeOf($hotspots); $spot++): ?>
                var x = '<?php echo e($hotspots[$spot]->position_x); ?>';
                var y = '<?php echo e($hotspots[$spot]->position_y); ?>';
                //CALCUL CONVERSION longitude lattitude POUR OLIVIA
                //=================================================
                                // var x = 0;
                                // var y = 0;
                // x = '<?php echo e($hotspots[$spot]->longitude); ?>';
                // y = '<?php echo e($hotspots[$spot]->latitude); ?>';
                // var xx = Number(x);
                // var spotX = (xx + 180) * H / 360;
                // var yy = Number(y);
                // var spotY = (90 - yy) * (W / 180);
                // console.log('<?php echo e($hotspots[$spot]->longitude); ?>' ,' => ', spotX, '<?php echo e($hotspots[$spot]->latitude); ?>' ,' => ', spotY);//'<?php echo e($hotspots[$spot]); ?>'
                // // $('.hotspotTarget').append('<div id="'+x+'" class="circleLarge" style="position:absolute top:"'+spotX+'" left:"'+spotY+'" width:20px;"></div>');
                // //attention inversion X Y ou  Longitude et latitude mais bonne position
                // $('.hotspotTarget').append('<div id="'+<?php echo e($hotspots[$spot]->id); ?>+'" class="circleLarge" style="background-color:hotpink;position:abolute;width:20px;top:'+spotX+';left:'+spotY+';"></div>');
                // // $('.hotspotTarget').append('<div id="'+x+'" style="background-color:"red" position:"abolute" witdh:"20px"  top:"'+spotY+'"left:"'+spotY+'";"></div>');

                var posx = Number(W) * Number(x);
                var posy = Number(H) * Number(y);
                $('.hotspotTarget').append('<div id="'+<?php echo e($hotspots[$spot]->id); ?>+'" class="circleSmall" style="background-color:red;position:abolute;width:20px;top:'+posy+';left:'+posx+';"></div>');
                <?php endfor; ?>
            });
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