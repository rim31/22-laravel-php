<?php $__env->startSection('content'); ?>
<!-- <link rel="stylesheet" href="<?php echo e(URL::asset('css/custom/exp.css')); ?>">
 --><!-- ======= 2.01 Page Title Area ====== -->
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
<!-- ======= /2.01 Page Title Area ====== -->

<!-- ======= 3.01 Domain Area ====== -->
<div class="domainSearchArea secPdng">
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-10 col-md-offset-1 clearfix">
               <form action="domainSearch.html" class="domainSearchForm  animated" method="get">
                     <div class="domainInput">
                        <input class="serach" type="search" name="search" value="immoVR.com">
                        <input class="submit" type="submit" name="submit" value="Chercher">
                    </div>
                    <div class="domainCheck">
                        <span class="com"><input type="checkbox" id="com" name="com" value="com"> .com ($9.00)<label for="com"></label></span>
                        <span class="net"><input type="checkbox" id="net" name="net" value="net"> .net ($8.49)<label for="net"></label></span>
                        <span class="org"><input type="checkbox" id="org" name="org" value="org"> .org ($10.00)<label for="org"></label></span>
                        <span class="in"><input type="checkbox" id="in" name="in" value="in"> .in ($8.49)<label for="in"></label></span>
                    </form>
                </div> -->
            </div>
            <div class="col-md-12">
                <ul class="domains">
                    <li class="availableDomain clearfix animated">
                        <div class="aDomainLeft clearfix">
                            <div class="checkIcon"><i class="icofont icofont-verification-check"></i></div>
                            <div class="DomainName">
                                <h1 class="titleExp">Vos expériences</h1>
                                <h3 class="h3 grey">Cliquez sur le <span class="green">nom</span> ou la <span class="green">photo</span>
                                    !</h3>
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
                        <li class="singleDomain animated">
                            <div class="h4 experiencesList">
                                <?php if($exp->photo): ?>
                                <a href="<?php echo e(route('exp.photo.index',[$exp->id])); ?>"> <img class="imgIndex" src="<?php echo e(URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG')); ?>"
                                    alt="<?php echo e($exp->photo); ?>"/> </a>
                                    <?php else: ?>
                                    <div class="buttonPhoto">
                                        <?php echo e(link_to_route('exp.photo.index', 'Ajouter photos', [$exp->id], ['class' => 'btnCart Btn greenButton'])); ?>

                                    </div>
                                    <?php endif; ?>
                                    <div class="expName"><h3><?php echo e(link_to_route('exp.show', $exp->name, [$exp->id])); ?></h3></div>
                                    <div class="singleDomainRight editRemoveExp">
                                        <?php echo Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')); ?>

                                        <div class="buttonPhoto">
                                            <?php echo e(link_to_route('exp.edit', 'Editer', [$exp->id], ['class' => 'btnCart Btn add'])); ?>

                                        </div>
                                        <div class="buttonPhoto">
                                            <?php echo Form::button('Supprimer', ['class'=>'btnCart Btn added',
                                             'onclick'=>"return(confirm('Etes-vous sûr de vouloir supprimer cette expérience ?'));",
                                             'type'=>'submit']); ?>

                                        </div>
                                        <?php echo Form::close(); ?>

                                        <!-- <h4 class="price"><?php echo e(link_to_route('exp.photo.index', 'Exporter', [$exp->id], ['class' => 'price'])); ?></h4> -->
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sectionBar"></div>

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
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>