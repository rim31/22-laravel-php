<?php $__env->startSection('content'); ?>

    <!-- ======= 2.01 Page Title Area ====== -->
    <div class="pageTitleArea animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="h3">Expérience</div>
                    <ul class="pageIndicate">
                        <li><a href="">home</a></li>
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
                <div class="sectionTitle animated">
                    <div class="h2">Trouver votre expérience ici</div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1 clearfix">
                <form action="domainSearch.html" class="domainSearchForm  animated" method="get">
                    <div class="domainInput">
                        <input class="serach" type="search" name="search" value="immoVR.com">
                        <input class="submit" type="submit" name="submit" value="Chercher">
                    </div>
<!--                     <div class="domainCheck">
                        <span class="com"><input type="checkbox" id="com" name="com" value="com"> .com ($9.00)<label for="com"></label></span>
                        <span class="net"><input type="checkbox" id="net" name="net" value="net"> .net ($8.49)<label for="net"></label></span>
                        <span class="org"><input type="checkbox" id="org" name="org" value="org"> .org ($10.00)<label for="org"></label></span>
                        <span class="in"><input type="checkbox" id="in" name="in" value="in"> .in ($8.49)<label for="in"></label></span>
                    </div> -->
                </form>
            </div>
            <div class="col-md-12">
                <ul class="domains">
                    <li class="availableDomain clearfix  animated">
                        <div class="aDomainLeft clearfix">
                            <div class="checkIcon"><i class="icofont icofont-verification-check"></i></div>
                            <div class="DomainName">
                                <div class="h3">Vos expériences</div>
                                <span>cliquer sur le nom ou la photo !</span>
                            </div>
                        </div>
                        <div class="domainBtn clearfix">
                        <?php echo e(link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'btnCart Btn add'])); ?>

                        </div>

                    </li>
                        <?php foreach($users as $user): ?>
                        <?php if($user->id_user == Auth::user()->id): ?>
                        <?php foreach($exps as $exp): ?>
                        <?php if($user->id_exp == $exp->id AND $exp->delete != 1): ?>
                        <li class="singleDomain  animated">
                            <div class="h4">
                            <div><?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></div>
                                <?php if($exp->photo): ?>
                                <a href="<?php echo e(route('exp.photo.index',[$exp->id])); ?>"> <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>"
                                    alt="<?php echo e($exp->photo); ?>" style="width:200px;height:100px;" /></a>
                                <?php else: ?>
                                <?php echo e(link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'cartBtn add'])); ?>

                                <?php endif; ?>
                            <div class="singleDomainRight">
                                <?php echo Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')); ?>

                                <?php echo e(link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btnBuy Btn add'])); ?>

                                <?php echo Form::button('Supprimer', ['class'=>'btnCart Btn added', 'type'=>'submit']); ?>

                                <?php echo Form::close(); ?>

                                <!-- <h4 class="price"><?php echo e(link_to_route('exp.photo.index', 'Exporter', [$exp->id], ['class' => 'price'])); ?></h4> -->
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- pagination-->
                        <?php echo e($exps->links()); ?>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /3.01 Domain Area ====== -->


    <!-- ======= 3.02 Domain cta Area ====== -->
    <div class="domainCtaArea  animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="domainCta">
                        <div class="h2">Créer votre une nouvelle expérience</div>
                        <?php echo e(link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'ctaBtn Btn'])); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /3.02 Domain cta Area ====== -->


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Experiences</div>
                    <?php if(Session::has('message')): ?>
                    <div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
                    <?php endif; ?>
                    <div class="panel-body">
                        <?php echo e(link_to_route('exp.create', '+ Nouvelle expérience', null, ['class' => 'btn btn-success'])); ?>

                        <br>
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Editer</th>
                                <th>Gallerie</th>
                                <th>Lien</th>
                            </tr>
                            <?php foreach($users as $user): ?>
                            <?php if($user->id_user == Auth::user()->id): ?>
                            <?php foreach($exps as $exp): ?>
                            <tr>
                              <?php if($user->id_exp == $exp->id AND $exp->delete != 1): ?>
                              <td><?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></td>
                              <td>
                                <?php echo Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')); ?>

                                <?php echo e(link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btn btn-primary'])); ?>

                                |
                                <?php echo Form::button('Supprimer', ['class'=>'btn btn-danger', 'type'=>'submit']); ?>

                                <?php echo Form::close(); ?>

                            </td>
                            <td>
                                <?php if($exp->photo): ?>
                                <a href="<?php echo e(route('exp.photo.index',[$exp->id])); ?>"> <img src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>"
                                    alt="<?php echo e($exp->photo); ?>" style="width:200px;height:100px;" /></a>

                                    <?php else: ?>
                                    <?php echo e(link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'btn btn-info'])); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                   <?php echo e(link_to_route('exp.photo.index', 'Exporter', [$exp->id], ['class' => 'btn btn-success'])); ?>

                               </td>
                               <?php endif; ?>
                           </tr>
                           <?php endforeach; ?>
                           <?php endif; ?>
                           <?php endforeach; ?>
                       </table>

                       <!-- pagination-->
                       <?php echo e($exps->links()); ?>


                   </div>
               </div>
           </div>
       </div>
   </div>




   <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>