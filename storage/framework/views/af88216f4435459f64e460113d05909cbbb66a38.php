<?php $__env->startSection('content'); ?>
<div class="container-fluid bg-image d-flex justify-content-center align-items-center flex-column">
    <div class="row mb-5">
        <h1 class="h1 text-primary bg-white col-md-12 rounded">Pomgo, le réseau social du moment</h1>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 panel-group text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <!-- Editing the HREF from original -->
                        <button class="col-md-12 btn btn-primary" data-toggle="collapse" href="#collapse">Publier un Pomgo</button>
                    </h4>
                </div>
                <?php if(!empty(session('image'))): ?>
                <div id="collapse" class="panel-collapse collapse show">
                    <?php else: ?>
                    <div id="collapse" class="panel-collapse collapse">
                        <?php endif; ?>

                        <?php if(empty(session('image'))): ?>
                        <form class="shadow m-3 bg-body rounded" action="<?php echo e(route('image.upload.post')); ?>" method="POST" enctype="multipart/form-data">

                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Je valide l'image</button>
                                </div>

                            </div>
                        </form>
                        <?php endif; ?>

                        <form class="shadow p-3 bg-body rounded bg-opacity" method="POST" action="<?php echo e(route('pomgo.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="">
                                <input type="text" class="m-2 form-control" id="pomgo_text" name="pomgo_text" placeholder="Quoi de neuf ?">
                                <input type="text" class="m-2 form-control col-md-4" id="pomgo_tags" name="pomgo_tags" placeholder="Écrivez vos pomgotags">
                                <div class="imgcontainer">
                                    <?php if(session('image')): ?>
                                    <input type="hidden" class="m-2 form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" value="<?php echo e(session('image')); ?>">
                                    <img src="<?php echo e(asset('images')); ?>/<?php echo e(session('image')); ?>" alt="pomgoimage" class="img-thumbnail col-md-3">
                                    <?php else: ?>
                                    <input type="text" class="m-2 form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" placeholder="Merci de télécharger votre image ci-dessus">
                                    <?php endif; ?>
                                </div>

                                <button class="m-2 btn btn-success" type="submit">Je valide mon pomgo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a class="col-md-12 btn btn-primary" href="#pomgos">Découvrir les pomgos</a>
        </div>
    </div>

    <div class="pomgos container">
        <div class="row justify-content-center" id="pomgos">
            <?php $__currentLoopData = $pomgos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pomgo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pomgo col-md-12 d-flex flex-column shadow m-3 bg-body rounded text-center">
                <?php if(Auth::user()->id == $pomgo->user_id): ?>
                <a class="m-3 btn btn-danger" href="<?php echo e(route('pomgo.edit', $pomgo)); ?>">Modifier</a>
                <?php endif; ?>
                <img src="<?php echo e(asset('images')); ?>/<?php echo e($pomgo->image); ?>" class="img-thumbnail" alt="">
                <p><?php echo e($pomgo->content); ?></p>
                <p>Tags: <?php echo e($pomgo->tags); ?></p>
                <p>Pomgo ajouté par <?php echo e($pomgo->user->pomgoname); ?> - <?php echo e($pomgo->created_at); ?> </p>

                <div class="shadow m-1 rounded">
                    <?php $__currentLoopData = $pomgo->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="shadow rounded">
                        <p><?php echo e($comment->content); ?></p>
                        <p><?php echo e($comment->username); ?></p>
                        <p class="text-right"><?php echo e($comment->user->pomgoname); ?> le <?php echo e($comment->created_at); ?></p>
                        <?php if(Auth::user()->id == $comment->user_id): ?>
                        <a class="col-md-5 mb-3 btn btn-danger" href="<?php echo e(route('comment.edit', $comment)); ?>">Modifier</a>

                        <form method="POST" action="<?php echo e(route('comment.destroy', $comment)); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button class="col-md-5 mb-1 btn btn-danger" type="submit">Supprimer</button>
                        </form>

                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <form enctype="multipart/form-data" class="m-1 d-flex align-items-center mb-3" method="POST" action="<?php echo e(route('comment.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <input name="pomgo-id-comment" type="hidden" value="<?php echo e($pomgo->id); ?>">
                        <textarea name="comment-content" class="ml-1 col-md-8" type="text" placeholder="Ecrivez votre commentaire"></textarea>
                        <div class="col-md-4 m-2">
                            <input type="file" name="image_comment" class="mb-2 form-control">
                            <button class=" btn btn-success" type="submit">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/home.blade.php ENDPATH**/ ?>