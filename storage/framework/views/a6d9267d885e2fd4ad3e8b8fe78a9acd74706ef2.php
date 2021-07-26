

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Résultats de votre recherche pour:
            <small><?php echo e($recherche); ?></small>
        </h1>

        <div class="pomgos container">
            <div class="row justify-content-center" id="pomgos">
                <?php $__currentLoopData = $pomgos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pomgo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pomgo col-md-5 d-flex flex-column shadow m-3 bg-body rounded text-center">
                    <?php if(Auth::user()->id == $pomgo->user_id): ?>
                    <a class="m-3 btn btn-info" href="<?php echo e(route('pomgo.edit', $pomgo)); ?>">Modifier le pomgo</a>
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
                            <?php if(Auth::user()->id == $comment->user_id || Auth::user()->id == $pomgo->user_id): ?>
                            <a class="col-md-5 mb-3 btn btn-info h5" href="<?php echo e(route('comment.edit', $comment)); ?>">Modifier le commentaire</a>

                            <form method="POST" action="<?php echo e(route('comment.destroy', $comment)); ?>">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <button class="col-md-5 mb-1 btn btn-danger" type="submit">Supprimer le commentaire</button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/search.blade.php ENDPATH**/ ?>